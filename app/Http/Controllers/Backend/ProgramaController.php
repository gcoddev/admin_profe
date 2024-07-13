<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Programa;
use App\Models\ProgramaModalidad;
use App\Models\ProgramaVersion;
use App\Models\ProgramaDuracion;
use App\Models\ProgramaTipo;
use App\Imports\DepartamentoImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class ProgramaController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('programa.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún programa!');
        }
        $programaModalidades  = ProgramaModalidad::all();
        $programaVersiones  = ProgramaVersion::all();
        $programaDuraciones  = ProgramaDuracion::all();
        $programas = DB::table('programa')
            ->join('programa_version', 'programa.pv_id', '=', 'programa_version.pv_id')
            ->join('programa_duracion', 'programa.pd_id', '=', 'programa_duracion.pd_id')
            ->join('programa_modalidad', 'programa.pm_id', '=', 'programa_modalidad.pm_id')
            ->select('programa.*', 'programa_version.*', 'programa_duracion.pd_nombre',
                        'programa_modalidad.pm_nombre')
                        ->get();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.programa.index', compact(['programas']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('programa.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        $programaModalidades  = ProgramaModalidad::all();
        $programaVersiones  = ProgramaVersion::all();
        $programaTipos  = ProgramaTipo::all();
        $programaDuraciones  = ProgramaDuracion::all();
        return view('backend.pages.programa.create', compact('programaModalidades','programaVersiones','programaDuraciones','programaTipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('programa.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        // Validación de datos
        $request->validate([
            'pro_nombre' => 'required|string|max:255',
            'pro_contenido' => 'required|string',
            // 'pro_horario' => 'required|string',
            // 'pro_fecha_inicio_formacion' => 'required|string',
            'pro_carga_horaria' => 'required|integer|min:0|max:1000',
            'pro_costo' => 'required|integer|min:0|max:10000',
            'pro_banner' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'pro_afiche' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            // 'pro_convocatoria' => 'required|image|mimes:png|max:1000',
            'pro_fecha_inicio_inscripcion' => 'required|date|after_or_equal:2023-01-01|before_or_equal:2030-12-31',
            'pro_fecha_fin_inscripcion' => 'required|date|after_or_equal:2023-01-01|before_or_equal:2030-12-31',
            'pro_fecha_inicio_clase' => 'required|date|after_or_equal:2023-01-01|before_or_equal:2030-12-31',
            // Agrega aquí las validaciones para los demás campos
            ], [
                // Mensajes personalizados para cada regla de validación
                'pro_nombre.required' => 'El nombre del programa es obligatorio.',
                'pro_contenido.required' => 'El contenido del programa es obligatorio.',
                'pro_carga_horaria.required' => 'La carga horaria es obligatoria.',
                'pro_carga_horaria.integer' => 'La carga horaria debe ser un número entero.',
                'pro_carga_horaria.min' => 'La carga horaria debe ser como mínimo :min horas.',
                'pro_carga_horaria.max' => 'La carga horaria no puede ser mayor de :max horas.',
                'pro_costo.required' => 'El costo del programa es obligatorio.',
                'pro_costo.integer' => 'El costo debe ser un número entero.',
                'pro_costo.min' => 'El costo no puede ser menor de :min unidades monetarias.',
                'pro_costo.max' => 'El costo no puede ser mayor de :max unidades monetarias.',
                'pro_banner.required' => 'La imagen de banner es obligatoria.',
                'pro_banner.image' => 'El archivo debe ser una imagen.',
                'pro_banner.mimes' => 'El banner debe ser de tipo PNG, JPG o JPEG.',
                'pro_banner.max' => 'El tamaño máximo permitido para el banner es :max kilobytes.',
                'pro_afiche.required' => 'El afiche del programa es obligatorio.',
                'pro_afiche.image' => 'El archivo debe ser una imagen.',
                'pro_afiche.mimes' => 'El afiche debe ser de tipo PNG, JPG o JPEG.',
                'pro_afiche.max' => 'El tamaño máximo permitido para el afiche es :max kilobytes.',
                'pro_fecha_inicio_inscripcion.required' => 'La fecha de inicio de inscripción es obligatoria.',
                'pro_fecha_inicio_inscripcion.date' => 'La fecha de inicio de inscripción debe ser una fecha válida.',
                'pro_fecha_inicio_inscripcion.after_or_equal' => 'La fecha de inicio de inscripción debe ser a partir del :date.',
                'pro_fecha_inicio_inscripcion.before_or_equal' => 'La fecha de inicio de inscripción debe ser antes o igual al :date.',
                'pro_fecha_fin_inscripcion.required' => 'La fecha de fin de inscripción es obligatoria.',
                'pro_fecha_fin_inscripcion.date' => 'La fecha de fin de inscripción debe ser una fecha válida.',
                'pro_fecha_fin_inscripcion.after_or_equal' => 'La fecha de fin de inscripción debe ser a partir del :date.',
                'pro_fecha_fin_inscripcion.before_or_equal' => 'La fecha de fin de inscripción debe ser antes o igual al :date.',
                'pro_fecha_inicio_clase.required' => 'La fecha de inicio de clases es obligatoria.',
                'pro_fecha_inicio_clase.date' => 'La fecha de inicio de clases debe ser una fecha válida.',
                'pro_fecha_inicio_clase.after_or_equal' => 'La fecha de inicio de clases debe ser a partir del :date.',
                'pro_fecha_inicio_clase.before_or_equal' => 'La fecha de inicio de clases debe ser antes o igual al :date.',
                // Agrega aquí mensajes personalizados para los demás campos según sea necesario
            ]
        );
        // Procesamiento de las imágenes
        $proBannerPath = $request->file('pro_banner')->store('public/programa_banners');
        $proAfichePath = $request->file('pro_afiche')->store('public/programa_afiches');

        $programa = new Programa();
        $programa->pro_nombre = $request->pro_nombre;
        $programa->pro_contenido = $request->pro_contenido;
        $programa->pro_horario = NULL;
        $programa->pro_carga_horaria = $request->pro_carga_horaria;
        $programa->pro_costo = $request->pro_costo;
        $programa->pro_banner = basename($proBannerPath); // Guardar solo el nombre del archivo
        $programa->pro_afiche = basename($proAfichePath); // Guardar solo el nombre del archivo
        $programa->pro_convocatoria = NULL; // Guardar solo el nombre del archivo
        $programa->pro_fecha_inicio_inscripcion = $request->pro_fecha_inicio_inscripcion;
        $programa->pro_fecha_fin_inscripcion = $request->pro_fecha_fin_inscripcion;
        $programa->pro_fecha_inicio_clase = $request->pro_fecha_inicio_clase;
        $programa->pd_id = $request->pd_id;
        $programa->pv_id = $request->pv_id;
        $programa->pro_tip_id = $request->pro_tip_id;
        $programa->pm_id = $request->pm_id;
        $programa->pro_estado_inscripcion = TRUE;
        // Asigna otros campos aquí
        $programa->save();
        // session()->flash('success', 'Versión creada con exito');
        // return redirect()->route('configuracion.programa.index');
        // Crear un nuevo programa
        return redirect()->route('admin.programa.index')
            ->with('success', 'Programa creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (is_null($this->user) || !$this->user->can('programa.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $programa = Programa::find($id);

        if (!$programa) {
            abort(404, 'Programa no encontrado.');
        }

        return view('backend.pages.programa.edit', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (is_null($this->user) || !$this->user->can('programa.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        // Validación de datos
        $request->validate([
            'pro_nombre' => 'required|string|max:255',
            'pro_contenido' => 'required|string',
            // Agrega aquí las validaciones para los demás campos
        ]);

        // Actualizar el programa
        $programa = Programa::find($id);

        if (!$programa) {
            abort(404, 'Programa no encontrado.');
        }

        $programa->update($request->all());

        return redirect()->route('programa.index')
            ->with('success', 'Programa actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programa = Programa::find($id);

        if (!$programa) {
            abort(404, 'Programa no encontrado.');
        }

        $programa->delete();
        session()->flash('success', 'User has been deleted !!');
        return back();
    }
}
