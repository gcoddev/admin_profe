<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Añade esta línea para importar la clase Str
use App\Models\Programa;
use App\Models\Sede;
use App\Models\MapPersona;
use App\Models\ProgramaBaucher;
use App\Models\ProgramaInscripcion;
use App\Models\ProgramaModalidad;
use App\Models\ProgramaInscripcionEstado;
use App\Models\ProgramaVersion;
use App\Models\ProgramaRestriccion;
use App\Models\ProgramaTipo;
use App\Imports\DepartamentoImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class InscripcionController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún inscripcion!');
        }

        $sede_id = $request->sede_id;
        $inscripciones = DB::table('programa_inscripcion')
        ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
        ->join('map_especialidad', 'map_persona.esp_id', '=', 'map_especialidad.esp_id')
        ->join('map_cargo', 'map_persona.car_id', '=', 'map_cargo.car_id')
        ->join('map_nivel', 'map_persona.niv_id', '=', 'map_nivel.niv_id')
        ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
        ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
        ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
        ->join('programa', 'programa_inscripcion.pro_id', '=', 'programa.pro_id')
        ->join('programa_turno', 'programa_inscripcion.pro_tur_id', '=', 'programa_turno.pro_tur_id')
        ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
        ->join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
        ->join('programa_inscripcion_estado', 'programa_inscripcion.pie_id', '=', 'programa_inscripcion_estado.pie_id')
        ->where('sede.sede_id', decrypt($sede_id))
        ->select('programa_inscripcion.*', 'map_persona.*', 'map_especialidad.esp_nombre', 'map_cargo.car_nombre',
                    'programa.pro_nombre', 'programa.pro_nombre_abre', 'programa.pro_costo', 'map_subsistema.sub_nombre', 'map_nivel.niv_nombre',
                    'map_categoria.cat_nombre', 'genero.gen_nombre',
                    'programa_turno.pro_tur_nombre', 'sede.sede_nombre','sede.sede_nombre_abre', 'departamento.dep_nombre', 'programa_inscripcion_estado.pie_nombre')
        ->get();
        if (!is_null($this->user->pro_ids)) {
            $proIds = json_decode($this->user->pro_ids);
            if (!empty($proIds)) { // Verifica si $sedesIds no está vacío
                $inscripciones->whereIn('programa.pro_id', $proIds);
            }
        }
        // Agregar verificación de restricciones
        foreach ($inscripciones as $inscripcion) {
            $inscripcion->cumple_restricciones = true; // Inicialmente asumimos que cumple
            $inscripcion->porque_no_cumple = null; // Inicialmente no hay motivo
            $restriccion = ProgramaRestriccion::where('pro_id', $inscripcion->pro_id)->first();
            // Verificar si la restricción existe y realizar las verificaciones
            if ($restriccion) {
                // Verificamos si las propiedades no son null antes de usar in_array()
                if (!is_null($restriccion->gen_ids) && is_array(json_decode($restriccion->gen_ids))) {
                    if (!in_array($inscripcion->gen_id, json_decode($restriccion->gen_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->gen_nombre;
                    }
                }
                if (!is_null($restriccion->sub_ids) && is_array(json_decode($restriccion->sub_ids))) {
                    if (!in_array($inscripcion->sub_id, json_decode($restriccion->sub_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->sub_nombre;
                    }
                }
                if (!is_null($restriccion->niv_ids) && is_array(json_decode($restriccion->niv_ids))) {
                    if (!in_array($inscripcion->niv_id, json_decode($restriccion->niv_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->niv_nombre;
                    }
                }
                if (!is_null($restriccion->cat_ids) && is_array(json_decode($restriccion->cat_ids))) {
                    if (!in_array($inscripcion->cat_id, json_decode($restriccion->cat_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->cat_nombre;
                    }
                }
                if (!is_null($restriccion->esp_ids) && is_array(json_decode($restriccion->esp_ids))) {
                    if (!in_array($inscripcion->esp_id, json_decode($restriccion->esp_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->esp_nombre;
                    }
                }
                if (!is_null($restriccion->esp_nombres) && is_array(json_decode($restriccion->esp_nombres))) {
                    if (!Str::contains($inscripcion->esp_nombre, json_decode($restriccion->esp_nombres))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->esp_nombre;
                    }
                }
                if (!is_null($restriccion->car_ids) && is_array(json_decode($restriccion->car_ids))) {
                    if (!in_array($inscripcion->car_id, json_decode($restriccion->car_ids))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->car_nombre;
                    }
                }
                if (!is_null($restriccion->car_nombres) && is_array(json_decode($restriccion->car_nombres)) && $restriccion->car_nombres !==null) {
                    if (!Str::contains($inscripcion->car_nombre, json_decode($restriccion->car_nombres))) {
                        $inscripcion->cumple_restricciones = false;
                        $inscripcion->porque_no_cumple = $inscripcion->car_nombre;
                    }
                }
            }
        }
        // Agrupar las inscripciones por pro_id
        $baucheres= ProgramaBaucher::all();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.inscripcion.index', compact(['inscripciones','baucheres','sede_id']));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        // Decodificar el parámetro $sede_id
        $decryptedSedeId = decrypt($request->sede_id);

        // Realizar la consulta utilizando el método when para aplicar la condición si es necesario
        // $sede = Sede::where('sede_id', $decryptedSedeId)->first();
        $sede = Sede::join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            ->where('sede.sede_id', $decryptedSedeId)
            ->select('sede.*', 'departamento.dep_nombre') // Selecciona los campos necesarios
            ->first();
        // Obtener todos los programas filtrados por pro_ids del usuario
        $programa = Programa::when($this->user->pro_ids, function ($query) {
            $proIds = json_decode($this->user->pro_ids);
            if (!empty($proIds)) { // Verifica si $sedesIds no está vacío
                $query->whereIn('pro_id', $proIds);
            }
        })->get();

        return view('backend.pages.inscripcion.create', compact('sede','programa'));
    }
    public function getTurnos(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
        try {
            $sedeId = $request->input('sede_id');
            $proId = $request->input('pro_id');

            $turnos = DB::table('programa_sede_turno')
                ->where('sede_id', $sedeId)
                ->where('pro_id', $proId)
                ->where('pst_estado', 'activo')
                ->pluck('pro_tur_ids');

            if ($turnos->isNotEmpty()) {
                $turnoIds = json_decode($turnos[0], true);

                $turnoDetalles = DB::table('programa_turno')
                    ->whereIn('pro_tur_id', $turnoIds)
                    ->where('pro_tur_estado', 'activo')
                    ->get();

                return response()->json($turnoDetalles);
            } else {
                return response()->json([]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching turnos: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function searchRda(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
        $rda = $request->rda;
        $person = MapPersona::where('per_rda', $rda)->first();

        if ($person) {
            return response()->json([
                'success' => true,
                'person' => $person,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Persona no encontrada',
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'per_rda' => 'required|numeric',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'per_celular' => ['required', 'digits:8', 'regex:/^[67]\d{7}$/'],
            'sede_id' => 'required|exists:sede,sede_id',
            'pro_id' => 'required|exists:programa,pro_id',
            'pro_tur_id' => 'required',
        ], [
            'per_rda.required' => 'El campo RDA es obligatorio.',
            'per_rda.numeric' => 'El campo RDA debe ser numérico.',
            'per_id.exists' => 'El valor seleccionado para per_id no es válido.',
            'sede_id.required' => 'Debe seleccionar una sede válida.',
            'sede_id.exists' => 'La sede seleccionada no es válida.',
            'pro_tur_id.required' => 'Debe seleccionar un turno válido.',
            'pro_id.required' => 'Debe seleccionar un programa válido.',
            'pro_id.exists' => 'El programa seleccionado no es válido.',
            'per_celular.required' => 'El número de celular es obligatorio.',
            'per_celular.digits' => 'El número de celular debe tener exactamente 8 dígitos.',
            'per_celular.regex' => 'El número de celular debe comenzar con 6 o 7 y tener 8 dígitos en total.',
        ]);

        // Buscar la persona por per_rda para obtener el per_id
        $persona = MapPersona::where('per_rda', $request->per_rda)->first();

        // Verificar si la persona existe
        if (!$persona) {
            return redirect()->back()->with('error', 'La persona con RDA proporcionado no fue encontrada.');
        }

        if ($persona) {
            // Actualiza el celular si no es nulo en la solicitud
            if (!is_null($request->per_celular)) {
                $persona->per_celular = $request->per_celular;
            }

            // Actualiza el correo si no es nulo en la solicitud
            if (!is_null($request->per_correo)) {
                $persona->per_correo = $request->per_correo;
            }

            // Guarda los cambios en la base de datos
            $persona->save();
        }

        // Crear la inscripción
        $inscripcion = new ProgramaInscripcion();
        $inscripcion->per_id = $persona->per_id; // Asignar el per_id obtenido
        $inscripcion->pro_id = $request->pro_id;
        $inscripcion->pro_tur_id = $request->pro_tur_id;
        $inscripcion->sede_id = $request->sede_id;
        $inscripcion->pie_id = 1;
        // Añadir otros campos según tu estructura de datos

        // Guardar la inscripción
        $inscripcion->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.inscripcion.index', ['sede_id' => encrypt($request->sede_id)])->with('success', 'La inscripción se ha creado correctamente.');
    }
    public function formularioPdf($pi_id)
    {
        $pi_id = decrypt($pi_id);
        // $pp_id = $parametros[0];
        // $per_rda = $parametros[1];

        $programaInscripcion = DB::table('programa_inscripcion')
            ->select(
                'map_persona.per_nombre1',
                'map_persona.per_nombre2',
                'map_persona.per_apellido1',
                'map_persona.per_apellido2',
                'map_persona.per_ci',
                'map_persona.per_rda',
                'map_persona.per_complemento',
                'map_persona.per_celular',
                'map_persona.per_correo',
                'programa_tipo.pro_tip_nombre',
                'programa.pro_nombre',
                'departamento.dep_nombre',
                'sede.sede_nombre',
                'programa_turno.pro_tur_nombre',
                'programa_modalidad.pm_nombre',
                'programa_version.pv_nombre',
                'programa_version.pv_numero',
                'programa_inscripcion.*'
            )
            ->join('programa_turno', 'programa_turno.pro_tur_id', '=', 'programa_inscripcion.pro_tur_id')
            ->join('map_persona', 'map_persona.per_id', '=', 'programa_inscripcion.per_id')
            ->join('programa', 'programa.pro_id', '=', 'programa_inscripcion.pro_id')
            ->join('sede', 'sede.sede_id', '=', 'programa_inscripcion.sede_id')
            ->join('departamento', 'departamento.dep_id', '=', 'sede.dep_id')
            ->join('programa_version', 'programa_version.pv_id', '=', 'programa.pv_id')
            ->join('programa_tipo', 'programa_tipo.pro_tip_id', '=', 'programa.pro_tip_id')
            ->join('programa_modalidad', 'programa_modalidad.pm_id', '=', 'programa.pm_id')
            // ->where('programa.pro_estado', '=', 1)
            ->where('programa_inscripcion.pi_id', '=', $pi_id)
            ->get();

        // dd($programaInscripcion);

        $imagen1 = public_path() . "/img/logos/logominedu.jpg";
        $logo1 = base64_encode(file_get_contents($imagen1));

        $imagen2 = public_path() . "/img/logos/logoprofe.jpg";
        $logo2 = base64_encode(file_get_contents($imagen2));

        $imagen3 = public_path() . "/img/logos/fondo.jpg";
        $fondo = base64_encode(file_get_contents($imagen3));

        $imagen4 = public_path() . "/img/iconos/alerta.png";
        $icono1 = base64_encode(file_get_contents($imagen4));

        $imagen5 = public_path() . "/img/iconos/check.png";
        $icono2 = base64_encode(file_get_contents($imagen5));

        $datosQr = route('admin.inscripcion.formulariopdf', encrypt($pi_id));
        $qr = base64_encode(QrCode::format('svg')->size(180)->errorCorrection('H')->generate($datosQr));

        $pdf = Pdf::loadView(
            'backend/pages/inscripcion/partials/formularioPdf',
            compact('logo1', 'logo2', 'fondo', 'icono1', 'icono2', 'qr', 'programaInscripcion')
        );
        // VERTICAL
        $pdf->setPaper('Letter', 'portrait');
        // HORIZONTAL
        // $pdf->setPaper('Letter', 'landscape');
        //
        return $pdf->download('formularioPreinscripcion' . $programaInscripcion[0]->per_rda . '.pdf');
        // return $pdf->stream('formularioPreinscripcion'.$per_rda.'.pdf');
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
    public function edit(string $pi_id)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $pi_id = decrypt($pi_id);

        // Obtener todas las sedes filtradas por sede_ids del usuario
        // $sede = Sede::when($this->user->sede_ids, function ($query) {
        //     $sedeIds = json_decode($this->user->sede_ids);
        //     if (!empty($sedesIds)) { // Verifica si $sedesIds no está vacío
        //         $query->whereIn('sede_id', $sedeIds);
        //     }
        // })->get();


        // Obtener todos los programas filtrados por pro_ids del usuario
        $programa = Programa::when($this->user->pro_ids, function ($query) {
            $proIds = json_decode($this->user->pro_ids);
            if (!empty($proIds)) { // Verifica si $sedesIds no está vacío
                $query->whereIn('pro_id', $proIds);
            }
        })->get();

        // Obtener las inscripciones filtradas por pi_id
        $inscripcion = DB::table('programa_inscripcion')
            ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
            ->join('map_especialidad', 'map_persona.esp_id', '=', 'map_especialidad.esp_id')
            ->join('map_cargo', 'map_persona.car_id', '=', 'map_cargo.car_id')
            ->join('map_nivel', 'map_persona.niv_id', '=', 'map_nivel.niv_id')
            ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
            ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
            ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
            ->join('programa', 'programa_inscripcion.pro_id', '=', 'programa.pro_id')
            ->join('programa_turno', 'programa_inscripcion.pro_tur_id', '=', 'programa_turno.pro_tur_id')
            ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
            ->join('programa_inscripcion_estado', 'programa_inscripcion.pie_id', '=', 'programa_inscripcion_estado.pie_id')
            ->where('programa_inscripcion.pi_id', $pi_id) // Filtrar por pi_id
            ->select('programa_inscripcion.*', 'map_persona.*', 'map_especialidad.esp_nombre', 'map_cargo.car_nombre',
                'programa.pro_nombre', 'programa.pro_costo', 'map_subsistema.sub_nombre', 'map_nivel.niv_nombre',
                'map_categoria.cat_nombre', 'genero.gen_nombre',
                'programa_turno.pro_tur_nombre', 'sede.sede_nombre', 'programa_inscripcion_estado.pie_nombre')
            ->first();
        $sede = Sede::join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            ->where('sede.sede_id', $inscripcion->sede_id)
            ->select('sede.*', 'departamento.dep_nombre') // Selecciona los campos necesarios
            ->first();
        // Obtener los bauchers relacionados con la inscripción filtrada por pi_id
        $bauchers = ProgramaBaucher::where('pi_id', $pi_id)->get();
        $inscripcionestado = ProgramaInscripcionEstado::all();
        return view('backend.pages.inscripcion.edit', compact('inscripcion', 'programa', 'sede', 'bauchers','inscripcionestado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inscripcionId = decrypt($id); // Asegúrate de que $id sea el ID correcto de la inscripción

        // Validación de los datos del formulario
        $request->validate([
            'per_rda' => 'required|numeric',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'per_celular' => ['required', 'digits:8', 'regex:/^[67]\d{7}$/'],
            'sede_id' => 'required|exists:sede,sede_id',
            'pro_id' => 'required|exists:programa,pro_id',
            'pi_doc_digital.*' => 'nullable|file|max:5120|mimes:pdf',
            'pro_tur_id' => 'required',
        ], [
            'per_rda.required' => 'El campo RDA es obligatorio.',
            'per_rda.numeric' => 'El campo RDA debe ser numérico.',
            'sede_id.required' => 'Debe seleccionar una sede válida.',
            'sede_id.exists' => 'La sede seleccionada no es válida.',
            'pro_id.required' => 'Debe seleccionar un programa válido.',
            'pro_id.exists' => 'El programa seleccionado no es válido.',
            'per_celular.required' => 'El número de celular es obligatorio.',
            'per_celular.digits' => 'El número de celular debe tener exactamente 8 dígitos.',
            'per_celular.regex' => 'El número de celular debe comenzar con 6 o 7 y tener 8 dígitos en total.',
            'pro_tur_id.required' => 'Debe seleccionar un turno válido.',
            'pi_doc_digital.*.file' => 'El archivo adjunto debe ser un archivo.',
            'pi_doc_digital.*.max' => 'El archivo adjunto no debe superar los 5MB.',
            'pi_doc_digital.*.mimes' => 'El archivo adjunto debe ser de tipo PDF.',
        ]);

        // Buscar la persona por per_rda para obtener el per_id
        $persona = MapPersona::where('per_rda', $request->per_rda)->first();

        // Verificar si la persona existe
        if (!$persona) {
            return redirect()->back()->with('error', 'La persona con RDA proporcionado no fue encontrada.');
        }

        // Actualizar el celular si se proporcionó en la solicitud
        $persona->per_celular = $request->per_celular;
        $persona->per_correo = $request->per_correo;
        $persona->save();

        // Actualizar la inscripción
        $inscripcion = ProgramaInscripcion::findOrFail($inscripcionId);
        $inscripcion->sede_id = $request->sede_id;

        $inscripcion->pro_tur_id = $request->pro_tur_id;
        $inscripcion->pro_id = $request->pro_id;
        $inscripcion->pie_id = $request->pie_id;
        $inscripcion->pi_modulo = $request->pi_modulo;

        if ($request->hasFile('pi_doc_digital')) {
            $documento = $request->file('pi_doc_digital');
            // Generar un nombre único basado en per_rda y la fecha actual
            $nombreDocumento = $persona->per_rda . '_' . now()->format('YmdHis') . '.' . $documento->getClientOriginalExtension();

            // Almacenar el documento en la carpeta 'pdfDocumentos' dentro del directorio 'storage/app'
            Storage::disk('local')->putFileAs('pdfDocumentos', $documento, $nombreDocumento);

            // Guardar el nombre del documento en la base de datos junto con la inscripción
            $inscripcion->pi_doc_digital = $nombreDocumento;
        }

        $inscripcion->save();

        // Redireccionar a una ruta adecuada después de editar la inscripción
        return redirect()->route('admin.inscripcion.index', ['sede_id' => encrypt($request->sede_id)])->with('success', 'La inscripción se ha actualizado correctamente.');
    }
    public function baucherpost(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'pro_bau_imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pro_bau_nro_deposito' => 'required|numeric',
            'pro_bau_monto' => 'required|numeric',
            'pro_bau_fecha' => 'required|date',
            'pro_bau_tipo_pago' => 'required|string|max:255',
        ]);
        // Verifica si el número de depósito ya existe en la base de datos
        $nro_deposito = $request->input('pro_bau_nro_deposito');
        $existingBaucher = ProgramaBaucher::where('pro_bau_nro_deposito', $nro_deposito)->first();
        if ($existingBaucher) {
            // Redirige con un mensaje de error si el número de depósito ya existe
            return redirect()->back()->withErrors(['pro_bau_nro_deposito' => 'El número de depósito ya está registrado en el sistema.'])->withInput();
        }

        // Encuentra la inscripción
        $baucher = new ProgramaBaucher();

         // Manejo de la imagen
        if ($request->hasFile('pro_bau_imagen')) {
            $image = $request->file('pro_bau_imagen');
            $nro_deposito = $request->input('pro_bau_nro_deposito');
            $extension = $image->getClientOriginalExtension();
            $name = $nro_deposito . '.' . $extension;

            // Guarda la imagen en storage/app/public/images/bauchers
            $path = $request->file('pro_bau_imagen')->storeAs('public/bauchers', $name);

            // Generar URL Correcta
            $baucher->pro_bau_imagen = str_replace('public/', '', $path);
        }

        // Guarda otros campos
        $baucher->pi_id = $id;
        $baucher->pro_bau_nro_deposito = $request->input('pro_bau_nro_deposito');
        $baucher->pro_bau_monto = $request->input('pro_bau_monto');
        $baucher->pro_bau_fecha = $request->input('pro_bau_fecha');
        $baucher->pro_bau_tipo_pago = $request->input('pro_bau_tipo_pago');

        // Guarda la inscripción
        $baucher->save();
        // Redirecciona a la página de edición con el ID encriptado de la inscripción
        $inscripcionId = encrypt($id); // Asegúrate de que $id sea el ID correcto de la inscripción
        return Redirect::route('admin.inscripcion.edit', ['inscripcion' => $inscripcionId])->with('success', 'El baucher se ha creado correctamente.');
    }
    public function baucherUpdate( $pi_id, $pro_bau_id, Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'pro_bau_nro_deposito' => 'required|string',
            'pro_bau_monto' => 'required|numeric',
            'pro_bau_fecha' => 'required|date',
            'pro_bau_tipo_pago' => 'required|string',
            'pro_bau_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para imagen
        ]);

        // Obtener el baucher específico por ID
        $baucher = ProgramaBaucher::findOrFail($pro_bau_id);

        // Actualizar los campos del baucher
        $baucher->pro_bau_nro_deposito = $request->input('pro_bau_nro_deposito');
        $baucher->pro_bau_monto = $request->input('pro_bau_monto');
        $baucher->pro_bau_fecha = $request->input('pro_bau_fecha');
        $baucher->pro_bau_tipo_pago = $request->input('pro_bau_tipo_pago');

       // Manejar la subida de imagen si se ha proporcionado una nueva
        if ($request->hasFile('pro_bau_imagen')) {
            // Eliminar la imagen anterior si existe
            if ($baucher->pro_bau_imagen && Storage::exists($baucher->pro_bau_imagen)) {
                Storage::delete($baucher->pro_bau_imagen);
            }

            // Guardar la nueva imagen con el mismo nombre basado en pro_bau_nro_deposito
            $image = $request->file('pro_bau_imagen');
            $nro_deposito = $request->input('pro_bau_nro_deposito');
            $extension = $image->getClientOriginalExtension();
            $name = $nro_deposito . '.' . $extension;

            $path = $request->file('pro_bau_imagen')->storeAs('public/bauchers', $name);

            // Generar URL Correcta
            $baucher->pro_bau_imagen = str_replace('public/', '', $path);
        }
        // Guardar los cambios en el baucher
        $baucher->save();

        // Redirecciona a la página de edición con el ID encriptado de la inscripción
        $inscripcionId = encrypt($pi_id);
        return Redirect::route('admin.inscripcion.edit', ['inscripcion' => $inscripcionId])->with('success', 'El baucher se ha actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
