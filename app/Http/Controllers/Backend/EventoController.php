<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\ProgramaModalidad;
use App\Models\TipoEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('programa.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún evento!');
        }

        $eventos = Evento::where('eve_estado', '<>', 'eliminado')->get();
        confirmDelete('Eliminar evento', 'Esta seguro de eliminar? Esta acción no se puede deshacer.');

        return view('backend.pages.evento.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('evento.edit')) {
            abort(403, 'Lo siento !! ¡No estas autorizado a editar eventos !');
        }

        $tipoEvento = TipoEvento::where('et_estado', 'activo')->get();
        $modalidades = ProgramaModalidad::where('pm_estado', 'activo')->get();

        return view('backend.pages.evento.create', compact('tipoEvento', 'modalidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eve_nombre' => 'required|string|max:255',
            'eve_descripcion' => 'required|string',
            'eve_banner' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'eve_afiche' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'modalidades' => 'required',
            'eve_fecha' => 'required|date',
            'eve_ins_hora_asis_habilitado' => 'required',
            'eve_ins_hora_asis_deshabilitado' => 'required|after:eve_ins_hora_asis_habilitado',
            'eve_convocatoria' => 'required|string|max:255',
            'et_id' => 'required|exists:tipo_evento,et_id',
        ], [
            'eve_nombre.required' => 'El nombre del evento es obligatorio.',
            'eve_descripcion.required' => 'La descripción del evento es obligatoria.',
            'eve_fecha.required' => 'La fecha del evento es obligatoria.',
            'modalidades.required' => 'La modalidad es obligatoria.',
            'eve_ins_hora_asis_habilitado.required' => 'La hora de asistencia habilitado es obligatoria.',
            'eve_ins_hora_asis_deshabilitado.required' => 'La hora de asistencia deshabilitado es obligatoria.',
            'eve_ins_hora_asis_deshabilitado.after' => 'La hora de asistencia deshabilitado debe ser después de la hora de asistencia habilitado.',
            'eve_convocatoria.required' => 'La convocatoria es obligatoria.',
            'eve_banner.image' => 'El archivo debe ser una imagen.',
            'eve_banner.mimes' => 'El banner debe ser de tipo PNG, JPG o JPEG.',
            'eve_banner.max' => 'El tamaño máximo permitido para el banner es :max kilobytes.',
            'eve_afiche.image' => 'El archivo debe ser una imagen.',
            'eve_afiche.mimes' => 'El afiche debe ser de tipo PNG, JPG o JPEG.',
            'eve_afiche.max' => 'El tamaño máximo permitido para el afiche es :max kilobytes.',
            'et_id.required' => 'El tipo de evento es obligatorio.',
            'et_id.exists' => 'El tipo de evento seleccionado no es válido.',
        ]);

        $bannerPath = $request->file('eve_banner')->store('public/evento_banners');
        $afichePath = $request->file('eve_afiche')->store('public/evento_afiches');

        // Crear el evento en la base de datos
        $evento = new Evento();
        $evento->eve_nombre = $request->eve_nombre;
        $evento->eve_descripcion = $request->eve_descripcion;
        $evento->eve_banner = basename($bannerPath);
        $evento->eve_afiche = basename($afichePath);
        $evento->pm_ids = json_encode($request->modalidades);
        $evento->eve_fecha = $request->eve_fecha;
        $evento->eve_inscripcion = true;
        $evento->eve_ins_hora_asis_habilitado = $request->eve_ins_hora_asis_habilitado;
        $evento->eve_ins_hora_asis_deshabilitado = $request->eve_ins_hora_asis_deshabilitado;
        $evento->eve_convocatoria = $request->eve_convocatoria;
        $evento->eve_total_inscrito = 0;
        $evento->et_id = $request->et_id;

        // Guardar el evento en la base de datos
        $evento->save();

        return redirect()->route('admin.evento.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (is_null($this->user) || !$this->user->can('evento.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $evento = Evento::find($id);

        if (!$evento) {
            abort(404, 'Evento no encontrado.');
        }

        $tipoEvento = TipoEvento::where('et_estado', 'activo')->get();
        $modalidades = ProgramaModalidad::where('pm_estado', 'activo')->get();

        return view('backend.pages.evento.edit', compact('evento', 'modalidades', 'tipoEvento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        if (is_null($this->user) || !$this->user->can('programa.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        // Validación de datos
        $request->validate([
            'eve_nombre' => 'required|string|max:255',
            'eve_descripcion' => 'required|string',
            'eve_banner' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'eve_afiche' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'modalidades' => 'required',
            'eve_fecha' => 'required|date',
            'eve_ins_hora_asis_habilitado' => 'required',
            'eve_ins_hora_asis_deshabilitado' => 'required|after:eve_ins_hora_asis_habilitado',
            'eve_convocatoria' => 'required|string|max:255',
            'et_id' => 'required|exists:tipo_evento,et_id',
        ], [
            'eve_nombre.required' => 'El nombre del evento es obligatorio.',
            'eve_descripcion.required' => 'La descripción del evento es obligatoria.',
            'eve_fecha.required' => 'La fecha del evento es obligatoria.',
            'modalidades.required' => 'La modalidad es obligatoria.',
            'eve_ins_hora_asis_habilitado.required' => 'La hora de asistencia habilitado es obligatoria.',
            'eve_ins_hora_asis_deshabilitado.required' => 'La hora de asistencia deshabilitado es obligatoria.',
            'eve_ins_hora_asis_deshabilitado.after' => 'La hora de asistencia deshabilitado debe ser después de la hora de asistencia habilitado.',
            'eve_convocatoria.required' => 'La convocatoria es obligatoria.',
            'eve_banner.image' => 'El archivo debe ser una imagen.',
            'eve_banner.mimes' => 'El banner debe ser de tipo PNG, JPG o JPEG.',
            'eve_banner.max' => 'El tamaño máximo permitido para el banner es :max kilobytes.',
            'eve_afiche.image' => 'El archivo debe ser una imagen.',
            'eve_afiche.mimes' => 'El afiche debe ser de tipo PNG, JPG o JPEG.',
            'eve_afiche.max' => 'El tamaño máximo permitido para el afiche es :max kilobytes.',
            'et_id.required' => 'El tipo de evento es obligatorio.',
            'et_id.exists' => 'El tipo de evento seleccionado no es válido.',
        ]);

        // Actualizar el evento
        $evento = Evento::find($id);

        // Procesamiento del banner
        if ($request->hasFile('eve_banner')) {
            // Eliminar el banner actual si existe
            if ($evento->eve_banner) {
                Storage::delete('public/evento_banners/' . $evento->eve_banner);
            }
            // Guardar el nuevo banner
            $eveBannerPath = $request->file('eve_banner')->store('public/evento_banners');
            $evento->eve_banner = basename($eveBannerPath);
        }

        // Procesamiento del afiche
        if ($request->hasFile('eve_afiche')) {
            // Eliminar el afiche actual si existe
            if ($evento->eve_afiche) {
                Storage::delete('public/evento_afiches/' . $evento->eve_afiche);
            }
            // Guardar el nuevo afiche
            $eveAfichePath = $request->file('eve_afiche')->store('public/evento_afiches');
            $evento->eve_afiche = basename($eveAfichePath);
        }

        $evento->eve_nombre = $request->eve_nombre;
        $evento->eve_descripcion = $request->eve_descripcion;
        $evento->pm_ids = json_encode($request->modalidades);
        $evento->eve_fecha = $request->eve_fecha;
        $evento->eve_ins_hora_asis_habilitado = $request->eve_ins_hora_asis_habilitado;
        $evento->eve_ins_hora_asis_deshabilitado = $request->eve_ins_hora_asis_deshabilitado;
        $evento->eve_convocatoria = $request->eve_convocatoria;
        // $evento->eve_total_inscrito = 0;
        $evento->et_id = $request->et_id;
        // Asigna otros campos aquí

        if (isset($request->eve_inscripcion)) {
            $evento->eve_inscripcion = true;
        } else {
            $evento->eve_inscripcion = false;
        }

        $evento->save();

        return redirect()->route('admin.evento.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Evento::where('eve_id', $id)->first();

        if (!$evento) {
            abort(404, 'Evento no encontrado.');
        }
        $evento->eve_estado = 'eliminado';
        $evento->save();

        return redirect()->route('admin.evento.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }

    public function estado(string $id)
    {
        $evento = Evento::where('eve_id', $id)->first();
        if ($evento->eve_estado == 'activo') {
            $evento->eve_estado = 'inactivo';
        } else {
            $evento->eve_estado = 'activo';
        }
        $evento->save();

        return back()->with('success', 'Estado actualizado');
    }
}
