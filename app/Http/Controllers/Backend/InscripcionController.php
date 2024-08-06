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
            ->leftJoin('programa_baucher', 'programa_baucher.pi_id', '=', 'programa_inscripcion.pi_id')
            ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
            ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
            ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
            ->join('programa', 'programa_inscripcion.pro_id', '=', 'programa.pro_id')
            ->join('programa_turno', 'programa_inscripcion.pro_tur_id', '=', 'programa_turno.pro_tur_id')
            ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
            ->join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            ->join('programa_inscripcion_estado', 'programa_inscripcion.pie_id', '=', 'programa_inscripcion_estado.pie_id')
            ->where('sede.sede_id', decrypt($sede_id))
            ->select(
                'programa_inscripcion.pi_id', 
                'programa_inscripcion.pro_id', 
                'programa_inscripcion.updated_at', 
                'map_persona.per_id', 
                'map_persona.gen_id', 
                'map_persona.esp_id', 
                'map_persona.cat_id', 
                'map_persona.car_id', 
                'map_persona.sub_id', 
                'map_persona.niv_id',  
                'map_persona.per_nombre1', 
                'map_persona.per_nombre2', 
                'map_persona.per_apellido1', 
                'map_persona.per_apellido2', 
                'map_persona.per_rda', 
                'map_persona.per_ci', 
                'map_persona.per_fecha_nacimiento', 
                'map_persona.per_celular', 
                'map_persona.per_correo', 
                'map_persona.per_en_funcion', 
                'map_especialidad.esp_nombre', 
                'map_cargo.car_nombre',
                'programa.pro_nombre', 
                'programa.pro_nombre_abre', 
                'programa.pro_costo', 
                'map_subsistema.sub_nombre', 
                'map_nivel.niv_nombre',
                'map_categoria.cat_nombre', 
                'genero.gen_nombre',
                'programa_turno.pro_tur_nombre', 
                'sede.sede_nombre',
                'sede.sede_nombre_abre', 
                'departamento.dep_nombre', 
                'programa_inscripcion_estado.pie_nombre',
                DB::raw('COALESCE(SUM(programa_baucher.pro_bau_monto), 0) AS total_pagado'),
                DB::raw('(programa.pro_costo - COALESCE(SUM(programa_baucher.pro_bau_monto), 0)) AS restante'),
                DB::raw('CASE
                            WHEN COALESCE(SUM(programa_baucher.pro_bau_monto), 0) >= programa.pro_costo THEN "Completado"
                            WHEN COALESCE(SUM(programa_baucher.pro_bau_monto), 0) < programa.pro_costo THEN "Incompleto"
                            ELSE "Desconocido"
                        END AS estado_pago')
            )
            ->groupBy(
                'programa_inscripcion.pi_id', 
                'programa_inscripcion.pro_id', 
                'programa_inscripcion.updated_at', 
                'map_persona.per_id', 
                'map_persona.gen_id', 
                'map_persona.esp_id', 
                'map_persona.cat_id', 
                'map_persona.car_id', 
                'map_persona.sub_id', 
                'map_persona.niv_id', 
                'map_persona.per_nombre1', 
                'map_persona.per_nombre2', 
                'map_persona.per_apellido1', 
                'map_persona.per_apellido2', 
                'map_persona.per_rda', 
                'map_persona.per_ci', 
                'map_persona.per_fecha_nacimiento', 
                'map_persona.per_celular', 
                'map_persona.per_correo', 
                'map_persona.per_en_funcion', 
                'map_especialidad.esp_nombre', 
                'map_cargo.car_nombre',
                'programa.pro_nombre', 
                'programa.pro_nombre_abre', 
                'programa.pro_costo', 
                'map_subsistema.sub_nombre', 
                'map_nivel.niv_nombre',
                'map_categoria.cat_nombre',
                'genero.gen_nombre',
                'programa_turno.pro_tur_nombre', 
                'sede.sede_nombre',
                'sede.sede_nombre_abre', 
                'departamento.dep_nombre', 
                'programa_inscripcion_estado.pie_nombre'
            );
        // $inscripciones = DB::table('programa_inscripcion')
            // ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
            // ->join('map_especialidad', 'map_persona.esp_id', '=', 'map_especialidad.esp_id')
            // ->join('map_cargo', 'map_persona.car_id', '=', 'map_cargo.car_id')
            // ->join('map_nivel', 'map_persona.niv_id', '=', 'map_nivel.niv_id')
            // ->join('programa_baucher', 'programa_baucher.pi_id', '=', 'programa_inscripcion.pi_id')
            // ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
            // ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
            // ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
            // ->join('programa', 'programa_inscripcion.pro_id', '=', 'programa.pro_id')
            // ->join('programa_turno', 'programa_inscripcion.pro_tur_id', '=', 'programa_turno.pro_tur_id')
            // ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
            // ->join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            // ->join('programa_inscripcion_estado', 'programa_inscripcion.pie_id', '=', 'programa_inscripcion_estado.pie_id')
            // ->where('sede.sede_id', decrypt($sede_id))
            // ->select(
            //         'programa_inscripcion.*', 
            //         'map_persona.*', 
            //         'map_especialidad.esp_nombre', 
            //         'map_cargo.car_nombre',
            //         'programa.pro_nombre', 
            //         'programa.pro_nombre_abre', 
            //         'programa.pro_costo', 
            //         'map_subsistema.sub_nombre', 
            //         'map_nivel.niv_nombre',
            //         'map_categoria.cat_nombre', 
            //         'genero.gen_nombre',
            //         'programa_turno.pro_tur_nombre', 
            //         'sede.sede_nombre',
            //         'sede.sede_nombre_abre', 
            //         'departamento.dep_nombre', 
            //         'programa_inscripcion_estado.pie_nombre'
        // );
        
        if (!is_null($this->user->pro_ids)) {
            $proIds = json_decode($this->user->pro_ids);
            if (!empty($proIds)) { // Verifica si $proIds no está vacío
                $inscripciones->whereIn('programa.pro_id', $proIds);
            }
        }
        $inscripciones = $inscripciones->get();
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
        // $baucheres= ProgramaBaucher::all();
        // Contar los baucheres por sede usando el sede_id
        $totalBaucheresPorSede = DB::table('programa_baucher')
            ->join('programa_inscripcion', 'programa_baucher.pi_id', '=', 'programa_inscripcion.pi_id')
            ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
            ->where('sede.sede_id', '=', decrypt($sede_id))
            ->select('sede.sede_nombre', DB::raw('count(programa_baucher.pro_bau_id) as total_baucheres'))
            ->groupBy('sede.sede_nombre')
            ->first();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.inscripcion.index', compact(['inscripciones','sede_id','totalBaucheresPorSede']));
    }
    public function buscadorPersona(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('comunicado.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún inscripcion!');
        }

        $searchTerm = $request->input('search', '');

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
            ->where(function($query) use ($searchTerm) {
                $query->where('map_persona.per_nombre1', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_nombre2', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_apellido1', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_apellido2', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_rda', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_ci', 'like', "%{$searchTerm}%");
            })
            ->select('programa_inscripcion.*', 'map_persona.*', 'map_especialidad.esp_nombre', 'map_cargo.car_nombre',
                    'programa.pro_nombre', 'programa.pro_nombre_abre', 'programa.pro_costo', 'map_subsistema.sub_nombre', 'map_nivel.niv_nombre',
                    'map_categoria.cat_nombre', 'genero.gen_nombre',
                    'programa_turno.pro_tur_nombre', 'sede.sede_nombre', 'sede.sede_nombre_abre', 'departamento.dep_nombre', 'programa_inscripcion_estado.pie_nombre')
            ->when(!is_null($this->user->sede_ids), function($query) {
                $sedeIds = json_decode($this->user->sede_ids);
                if (!empty($sedeIds)) {
                    $query->whereIn('sede.sede_id', $sedeIds);
                }
            })
            ->get();

        // Calcular el monto total y agregarlo a cada inscripción
        $inscripciones = $inscripciones->map(function($inscripcion) {
            $inscripcion->totalMonto = 0; // Asegúrate de calcular el totalMonto según sea necesario
            return $inscripcion;
        });

        // Renderizar la vista con los datos
        return view('backend.pages.inscripcion.buscarpersona', compact('inscripciones'));
    }
    public function buscadorPersona2(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('inscripcion.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ninguna inscripción!');
        }

        $searchTerm = $request->input('search', '');

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
            ->where(function($query) use ($searchTerm) {
                $query->where('map_persona.per_nombre1', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_nombre2', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_apellido1', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_apellido2', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_rda', 'like', "%{$searchTerm}%")
                    ->orWhere('map_persona.per_ci', 'like', "%{$searchTerm}%");
            })
            ->select('programa_inscripcion.*', 'map_persona.*', 'map_especialidad.esp_nombre', 'map_cargo.car_nombre',
                    'programa.pro_nombre', 'programa.pro_nombre_abre', 'programa.pro_costo', 'map_subsistema.sub_nombre', 'map_nivel.niv_nombre',
                    'map_categoria.cat_nombre', 'genero.gen_nombre',
                    'programa_turno.pro_tur_nombre', 'sede.sede_nombre', 'sede.sede_nombre_abre', 'departamento.dep_nombre', 'programa_inscripcion_estado.pie_nombre')
            ->get();

        // Calcular el monto total y agregarlo a cada inscripción
        $inscripciones = $inscripciones->map(function($inscripcion) {
            $inscripcion->totalMonto = 0; // Asegúrate de calcular el totalMonto según sea necesario
            return $inscripcion;
        });

        // Devolver la respuesta JSON
        return response()->json($inscripciones);
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
        if (is_null($this->user) || !$this->user->can('inscripcion.edit')) {
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
        if (is_null($this->user) || !$this->user->can('inscripcion.create') || !$this->user->can('inscripcion.edit')) {
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
       

        // // Obtener todos los programas filtrados por pro_ids del usuario
        // $programa = Programa::when($this->user->pro_ids, function ($query) {
        //     $proIds = json_decode($this->user->pro_ids);
        //     if (!empty($proIds)) { // Verifica si $sedesIds no está vacío
        //         $query->whereIn('pro_id', $proIds);
        //     }
        // })->get();

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
        // Obtener todos los programas filtrados por pro_ids del usuario
        $programa = Programa::where('pro_id', $inscripcion->pro_id)
            ->select('programa.*') // Selecciona los campos necesarios
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
            #'per_celular' => ['required', 'digits:8', 'regex:/^[67]\d{7}$/'],
            #'sede_id' => 'required|exists:sede,sede_id',
            #'pro_id' => 'required|exists:programa,pro_id',
            'pi_doc_digital.*' => 'nullable|file|max:5120|mimes:pdf',
            'pro_tur_id' => 'required',
        ], [
            'per_rda.required' => 'El campo RDA es obligatorio.',
            'per_rda.numeric' => 'El campo RDA debe ser numérico.',
            'sede_id.required' => 'Debe seleccionar una sede válida.',
            'sede_id.exists' => 'La sede seleccionada no es válida.',
            #'pro_id.required' => 'Debe seleccionar un programa válido.',
            #'pro_id.exists' => 'El programa seleccionado no es válido.',
            #'per_celular.required' => 'El número de celular es obligatorio.',
            #'per_celular.digits' => 'El número de celular debe tener exactamente 8 dígitos.',
            #'per_celular.regex' => 'El número de celular debe comenzar con 6 o 7 y tener 8 dígitos en total.',
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
        #$inscripcion->pro_id = $request->pro_id;
        #$inscripcion->pie_id = $request->pie_id;
        #$inscripcion->pi_modulo = $request->pi_modulo;

        if ($request->hasFile('pi_doc_digital')) {
            $documento = $request->file('pi_doc_digital');
            // Generar un nombre único basado en per_rda y la fecha actual
            $nombreDocumento = $persona->per_rda . '_' . now()->format('YmdHis') . '.' . $documento->getClientOriginalExtension();
            
            // Almacenar el documento en la carpeta 'pdfDocumentos' dentro del directorio 'storage/app/public'
            Storage::disk('public')->putFileAs('pdfDocumentos', $documento, $nombreDocumento);
            
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
            'pro_bau_imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            'pro_bau_nro_deposito' => 'required|numeric',
            'pro_bau_monto' => 'required|numeric',
            'pro_bau_fecha' => 'required|date',
            'pro_bau_tipo_pago' => 'required|string|max:255',
        ], [
            'pro_bau_imagen.required' => 'La imagen es obligatoria.',
            'pro_bau_imagen.image' => 'El archivo debe ser una imagen.',
            'pro_bau_imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'pro_bau_imagen.max' => 'La imagen no debe superar los 1048 kilobytes.',
            'pro_bau_nro_deposito.required' => 'El número de depósito es obligatorio si en caso es descuento por planilla coloque 0.',
            'pro_bau_nro_deposito.numeric' => 'El número de depósito debe ser numérico.',
            'pro_bau_monto.required' => 'El monto es obligatorio.',
            'pro_bau_monto.numeric' => 'El monto debe ser numérico.',
            'pro_bau_fecha.required' => 'La fecha es obligatoria.',
            'pro_bau_fecha.date' => 'La fecha debe ser una fecha válida.',
            'pro_bau_tipo_pago.required' => 'El tipo de pago es obligatorio.',
            'pro_bau_tipo_pago.string' => 'El tipo de pago debe ser una cadena de texto.',
            'pro_bau_tipo_pago.max' => 'El tipo de pago no debe superar los 255 caracteres.',
        ]);
        // Verifica si el número de depósito ya existe en la base de datos
        $nro_deposito = $request->input('pro_bau_nro_deposito');
        $pro_bau_tipo_pago = $request->input('pro_bau_tipo_pago');
        
        $existingBaucher = ProgramaBaucher::where('pro_bau_nro_deposito', $nro_deposito)->first();
        if ($existingBaucher && $pro_bau_tipo_pago == "Baucher") {
            // Redirige con un mensaje de error si el número de depósito ya existe
            return redirect()->back()->withErrors(['pro_bau_nro_deposito' => 'El número de depósito ya está registrado en el sistema.'])->withInput();
        }
        
        // Encuentra la inscripción
        $baucher = new ProgramaBaucher();
        $persona = DB::table('programa_inscripcion')
            ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
            ->where('programa_inscripcion.pi_id', $id) // Filtrar por pi_id
            ->select('map_persona.per_rda')
            ->first();
         // Manejo de la imagen
        if ($request->hasFile('pro_bau_imagen')) {
            $image = $request->file('pro_bau_imagen');
            $nro_deposito = $request->input('pro_bau_nro_deposito');
            $extension = $image->getClientOriginalExtension();
            $timestamp = date('Ymd_His'); // Formato de fecha y hora
            if ($pro_bau_tipo_pago == "Descuento por Planilla") {
                $name = $persona->per_rda . '_' . $timestamp . '.' . $extension; // Nombre encriptado
            } else {
                $name = $nro_deposito . '.' . $extension;
            }

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
            'pro_bau_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048', // Validación para imagen
        ], [
            'required' => 'Este campo es obligatorio.',
            'pro_bau_nro_deposito.required' => 'El número de depósito es obligatorio.',
            'pro_bau_nro_deposito.string' => 'El número de depósito debe ser una cadena de texto.',
            'pro_bau_monto.required' => 'El monto es obligatorio.',
            'pro_bau_monto.numeric' => 'El monto debe ser numérico.',
            'pro_bau_fecha.required' => 'La fecha es obligatoria.',
            'pro_bau_fecha.date' => 'La fecha debe ser una fecha válida.',
            'pro_bau_tipo_pago.required' => 'El tipo de pago es obligatorio.',
            'pro_bau_tipo_pago.string' => 'El tipo de pago debe ser una cadena de texto.',
            'pro_bau_imagen.image' => 'El archivo debe ser una imagen.',
            'pro_bau_imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'pro_bau_imagen.max' => 'La imagen no debe superar los 1048 kilobytes.',
        ]);

        // Obtener el baucher específico por ID
        $baucher = ProgramaBaucher::findOrFail($pro_bau_id);

        // Actualizar los campos del baucher
        $baucher->pro_bau_nro_deposito = $request->input('pro_bau_nro_deposito');
        $baucher->pro_bau_monto = $request->input('pro_bau_monto');
        $baucher->pro_bau_fecha = $request->input('pro_bau_fecha');
        $baucher->pro_bau_tipo_pago = $request->input('pro_bau_tipo_pago');
        $pro_bau_tipo_pago = $request->input('pro_bau_tipo_pago');
        $persona = DB::table('programa_inscripcion')
            ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
            ->where('programa_inscripcion.pi_id', $pi_id) // Filtrar por pi_id
            ->select('map_persona.per_rda')
            ->first();
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
            $timestamp = date('Ymd_His'); // Formato de fecha y hora
            if ($pro_bau_tipo_pago == "Descuento por Planilla") {
                $name = $persona->per_rda . '_' . $timestamp . '.' . $extension; // Nombre encriptado
            } else {
                $name = $nro_deposito . '.' . $extension;
            }

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
    public function inscripcionPdf($pi_id)
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
                'programa.pro_id',
                'programa.pro_nombre',
                'programa.pro_costo',
                'programa.pro_carga_horaria',
                'programa.pro_fecha_inicio_clase',
                'programa_duracion.pd_nombre',
                'departamento.dep_nombre',
                'sede.sede_id',
                'sede.sede_nombre',
                'programa_turno.pro_tur_nombre',
                'programa_modalidad.pm_nombre',
                'programa_version.pv_nombre',
                'programa_version.pv_numero',
                'programa_version.pv_gestion',
                'programa_inscripcion.*'
            )
            ->join('programa_turno', 'programa_turno.pro_tur_id', '=', 'programa_inscripcion.pro_tur_id')
            ->join('map_persona', 'map_persona.per_id', '=', 'programa_inscripcion.per_id')
            ->join('programa', 'programa.pro_id', '=', 'programa_inscripcion.pro_id')
            ->join('programa_duracion', 'programa.pd_id', '=', 'programa_duracion.pd_id')
            ->join('sede', 'sede.sede_id', '=', 'programa_inscripcion.sede_id')
            ->join('departamento', 'departamento.dep_id', '=', 'sede.dep_id')
            ->join('programa_version', 'programa_version.pv_id', '=', 'programa.pv_id')
            ->join('programa_tipo', 'programa_tipo.pro_tip_id', '=', 'programa.pro_tip_id')
            ->join('programa_modalidad', 'programa_modalidad.pm_id', '=', 'programa.pm_id')
            // ->where('programa.pro_estado', '=', 2) //INSCRITO
            ->where('programa_inscripcion.pi_id', '=', $pi_id)
            ->first();
        $programaBauchers = ProgramaBaucher::where('pi_id', '=', $pi_id)->get();
        $sedeId = (string) $programaInscripcion->sede_id;
        $responsable = DB::table('admins')
                ->select(
                    'admins.nombre',
                    'admins.apellidos',
                    'admins.cargo',
                    'admins.sede_ids'
                )
                    ->join('model_has_roles', 'admins.id', 'model_has_roles.model_id')
                    ->whereJsonContains('admins.sede_ids', $sedeId)
                    ->where('model_has_roles.role_id', '=', 2)
                    ->first();
        if ($responsable) {
            // Acceder a las propiedades solo si $responsable no es null
            $nombre = $responsable->nombre;
            $apellidos = $responsable->apellidos;
            $cargo = $responsable->cargo;
        } else {
            // Manejar el caso en que no se encontró un registro
            $nombre = 'No encontrado';
            $apellidos = 'No encontrado';
            $cargo = 'No encontrado';
        }
        // $tutor = DB::table('admins')
        //         ->select(
        //             'admins.nombre',
        //             'admins.apellidos',
        //             'admins.cargo'
        //         )
        //         ->join('model_has_roles', 'admins.id', 'model_has_roles.model_id')
        //         ->whereJsonContains('admins.pro_ids', $programaInscripcion->pro_id)
        //         ->where('model_has_roles.role_id', '=', 3)
        //         ->whereJsonContains('admins.sede_ids', $programaInscripcion->sede_id)
        //         ->first();
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

        $datosQr = route('admin.inscripcion.inscripcionpdf', encrypt($pi_id));
        $qr = base64_encode(QrCode::format('svg')->size(180)->errorCorrection('H')->generate($datosQr));

        $pdf = Pdf::loadView(
            'backend/pages/inscripcion/partials/inscripcionPdf',
            compact('logo1', 'logo2', 'fondo', 'icono1', 'icono2', 'qr', 'programaInscripcion', 'programaBauchers', 'responsable')
        );
        // VERTICAL
        $pdf->setPaper('Letter', 'portrait');
        // HORIZONTAL
        // $pdf->setPaper('Letter', 'landscape');
        //
        return $pdf->download('formularioInscripcion' . $programaInscripcion->per_rda . '.pdf');
        // return $pdf->stream('formularioPreinscripcion'.$per_rda.'.pdf');
    }
    public function reporteInscritoPdf($sede_id, $pro_id)
    {
        
        // Desencriptar los IDs
        $sede_id = decrypt($sede_id);
        $pro_id = decrypt($pro_id);

        // dd($sede_id, $pro_id); // Verifica los valores desencriptados
        $inscripciones = DB::table('programa_inscripcion')
            ->join('map_persona', 'programa_inscripcion.per_id', '=', 'map_persona.per_id')
            ->join('map_especialidad', 'map_persona.esp_id', '=', 'map_especialidad.esp_id')
            ->join('map_cargo', 'map_persona.car_id', '=', 'map_cargo.car_id')
            ->join('map_nivel', 'map_persona.niv_id', '=', 'map_nivel.niv_id')
            ->leftJoin('programa_baucher', 'programa_baucher.pi_id', '=', 'programa_inscripcion.pi_id')
            ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
            ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
            ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
            ->join('programa', 'programa_inscripcion.pro_id', '=', 'programa.pro_id')
            ->join('programa_turno', 'programa_inscripcion.pro_tur_id', '=', 'programa_turno.pro_tur_id')
            ->join('sede', 'programa_inscripcion.sede_id', '=', 'sede.sede_id')
            ->join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            ->join('programa_inscripcion_estado', 'programa_inscripcion.pie_id', '=', 'programa_inscripcion_estado.pie_id')
            ->where('sede.sede_id', $sede_id)
            ->where('programa_inscripcion.pro_id', $pro_id)  
            ->select(
                'programa_inscripcion.pi_id', 
                'programa_inscripcion.pro_id', 
                'programa_inscripcion.updated_at', 
                'map_persona.per_id', 
                'map_persona.gen_id', 
                'map_persona.esp_id', 
                'map_persona.cat_id', 
                'map_persona.car_id', 
                'map_persona.sub_id', 
                'map_persona.niv_id',  
                'map_persona.per_nombre1', 
                'map_persona.per_nombre2', 
                'map_persona.per_apellido1', 
                'map_persona.per_apellido2', 
                'map_persona.per_rda', 
                'map_persona.per_ci', 
                'map_persona.per_complemento', 
                'map_persona.per_fecha_nacimiento', 
                'map_persona.per_celular', 
                'map_persona.per_correo', 
                'map_persona.per_en_funcion', 
                'map_especialidad.esp_nombre', 
                'map_cargo.car_nombre',
                'programa.pro_nombre', 
                'programa.pro_nombre_abre', 
                'programa.pro_costo', 
                'map_subsistema.sub_nombre', 
                'map_nivel.niv_nombre',
                'map_categoria.cat_nombre', 
                'genero.gen_nombre',
                'programa_turno.pro_tur_nombre', 
                'sede.sede_nombre',
                'sede.sede_nombre_abre', 
                'departamento.dep_nombre', 
                'programa_inscripcion_estado.pie_nombre',
                DB::raw('COALESCE(SUM(programa_baucher.pro_bau_monto), 0) AS total_pagado'),
                DB::raw('(programa.pro_costo - COALESCE(SUM(programa_baucher.pro_bau_monto), 0)) AS restante'),
                DB::raw('CASE
                            WHEN COALESCE(SUM(programa_baucher.pro_bau_monto), 0) >= programa.pro_costo THEN "Completado"
                            WHEN COALESCE(SUM(programa_baucher.pro_bau_monto), 0) < programa.pro_costo THEN "Incompleto"
                            ELSE "Desconocido"
                        END AS estado_pago')
            )
            ->groupBy(
                'programa_inscripcion.pi_id', 
                'programa_inscripcion.pro_id', 
                'programa_inscripcion.updated_at', 
                'map_persona.per_id', 
                'map_persona.gen_id', 
                'map_persona.esp_id', 
                'map_persona.cat_id', 
                'map_persona.car_id', 
                'map_persona.sub_id', 
                'map_persona.niv_id', 
                'map_persona.per_nombre1', 
                'map_persona.per_nombre2', 
                'map_persona.per_apellido1', 
                'map_persona.per_apellido2', 
                'map_persona.per_rda', 
                'map_persona.per_ci', 
                'map_persona.per_complemento', 
                'map_persona.per_fecha_nacimiento', 
                'map_persona.per_celular', 
                'map_persona.per_correo', 
                'map_persona.per_en_funcion', 
                'map_especialidad.esp_nombre', 
                'map_cargo.car_nombre',
                'programa.pro_nombre', 
                'programa.pro_nombre_abre', 
                'programa.pro_costo', 
                'map_subsistema.sub_nombre', 
                'map_nivel.niv_nombre',
                'map_categoria.cat_nombre',
                'genero.gen_nombre',
                'programa_turno.pro_tur_nombre', 
                'sede.sede_nombre',
                'sede.sede_nombre_abre', 
                'departamento.dep_nombre', 
                'programa_inscripcion_estado.pie_nombre'
            )->get();
        // Obtener responsable
        $sede_id = (string) $sede_id;
        $pro_id = (string) $pro_id;
        $responsable = DB::table('admins')
            ->select(
                'admins.nombre',
                'admins.apellidos',
                'admins.cargo',
                'admins.sede_ids',
                'roles.name'
            )
            ->join('model_has_roles', 'admins.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->whereJsonContains('admins.sede_ids', $sede_id)
            ->where('model_has_roles.role_id', '=', 2)
            ->first();

        // Obtener facilitador
        $facilitador = DB::table('admins')
            ->select(
                'admins.nombre',
                'admins.apellidos',
                'admins.cargo',
                'admins.sede_ids',
                'roles.name'
            )
            ->join('model_has_roles', 'admins.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->whereJsonContains('admins.sede_ids', $sede_id)
            ->whereJsonContains('admins.pro_ids', $pro_id)
            ->where('model_has_roles.role_id', '=', 3)
            ->first();
        // dd($facilitador);
        // Manejar la información del responsable
        if ($responsable) {
            $responsable_nombre = $responsable->nombre;
            $responsable_apellidos = $responsable->apellidos;
            $responsable_cargo = $responsable->name;
        } else {
            $responsable_nombre = 'No encontrado';
            $responsable_apellidos = 'No encontrado';
            $responsable_cargo = 'No encontrado';
        }

        // Manejar la información del facilitador
        if ($facilitador) {
            $facilitador_nombre = $facilitador->nombre;
            $facilitador_apellidos = $facilitador->apellidos;
            $facilitador_cargo = $facilitador->name;
        } else {
            $facilitador_nombre = 'No encontrado';
            $facilitador_apellidos = 'No encontrado';
            $facilitador_cargo = 'No encontrado';
        }
         
        //
        $imagen1 = public_path() . "/img/logos/logominedu.jpg";
        $logo1 = base64_encode(file_get_contents($imagen1));

        $imagen2 = public_path() . "/img/logos/logoprofe.jpg";
        $logo2 = base64_encode(file_get_contents($imagen2));

        $imagen3 = public_path() . "/img/iconos/alerta.png";
        $logo3 = base64_encode(file_get_contents($imagen3));

        $imagen4 = public_path() . "/img/logos/fondo.jpg";
        $fondo = base64_encode(file_get_contents($imagen4));


        $pdf = PDF::loadView('backend.pages.inscripcion.partials.reporteInscritosPdf', compact('inscripciones', 'responsable_nombre', 'responsable_apellidos', 'responsable_cargo',
        'facilitador_nombre', 'facilitador_apellidos', 'facilitador_cargo','logo1', 'logo2', 'logo3', 'fondo'));
        // VERTICAL
        $pdf->setPaper('Letter', 'portrait');
        // HORIZONTAL
        // $pdf->setPaper('Letter', 'landscape');
        //
        return $pdf->stream('Reporte' . $inscripciones[0]->pro_nombre_abre . '.pdf');
        // return $pdf->download('mi-archivo.pdf');
    }
}
