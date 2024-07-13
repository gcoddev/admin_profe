<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProgramaRestriccion;
use App\Models\Programa;
use App\Models\Genero;
use App\Models\MapSubsistema;
use App\Models\MapNivel;
use App\Models\MapEspecialidad;
use App\Models\MapCargo;
use App\Models\MapCategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
class RestriccionController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('configuracion_programa.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }

        $restriccionesQuery = DB::table('programa_restriccion')
            ->join('programa', 'programa_restriccion.pro_id', '=', 'programa.pro_id')
            ->select('programa_restriccion.*', 'programa.pro_nombre');

        $proIds = null;

        // Verificar si hay filtro por pro_ids
        if (!is_null($this->user->pro_ids)) {
            $proIds = json_decode($this->user->pro_ids);
            $restriccionesQuery->whereIn('programa.pro_id', $proIds);
        }

        // Obtener los resultados
        $restricciones = $restriccionesQuery->get();


        return view('backend.pages.configuracion.restriccion.index', compact('restricciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        // Obtener los programas que aún no tienen restricciones asociadas o que corresponden a los pro_ids del usuario
        $programas = Programa::whereNotIn('pro_id', function($query) {
            $query->select('pro_id')->from('programa_restriccion');
        })
        ->when(!is_null($this->user->pro_ids), function ($query) {
            $proIds = json_decode($this->user->pro_ids);
            return $query->whereIn('pro_id', $proIds);
        })
        ->get();
        $generos = Genero::all();
        $subsistemas = MapSubsistema::all();
        $niveles = MapNivel::all();
        $especialidades = MapEspecialidad::all();
        $cargos = MapCargo::all();
        $categorias = MapCategoria::all();

        return view('backend.pages.configuracion.restriccion.create', compact('programas','generos', 'subsistemas', 'niveles', 'especialidades', 'cargos', 'categorias'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'pro_id' => 'required|unique:programa_restriccion,pro_id',
            'res_descripcion' => 'required|string|max:2000'
        ], [
            'pro_id.required' => 'El campo programa es obligatorio.',
            'pro_id.unique' => 'Ya existe una restricción asociada a este programa.',
            'res_descripcion.required' => 'El campo descripción es obligatorio.',
            'res_descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'res_descripcion.max' => 'El campo descripción no puede exceder los :max caracteres.'
        ]);

        // Crear una nueva instancia del modelo ProgramaRestriccion y guardar los datos
        $restriccion = new ProgramaRestriccion();
        $restriccion->res_descripcion = $request->res_descripcion;
        $restriccion->pro_id = $request->pro_id;
        $restriccion->gen_ids = json_encode($request->generos);
        $restriccion->sub_ids = json_encode($request->subsistemas);
        $restriccion->niv_ids = json_encode($request->niveles);
        $restriccion->esp_ids = json_encode($request->especialidades);
        $restriccion->esp_nombres = json_encode($request->espNombres);
        $restriccion->cat_ids = json_encode($request->categorias);
        $restriccion->car_ids = json_encode($request->cargos);
        $restriccion->car_nombres = json_encode($request->carNombres);
        $restriccion->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('configuracion.restriccion.index')->with('success', 'Restricción creada con éxito.');
    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $restriccion = ProgramaRestriccion::findOrFail($id);
        $proIds = json_decode($this->user->pro_ids);

        // Obtener los programas que aún no tienen restricciones asociadas o que corresponden a la restricción actual
        $programas = Programa::when(!is_null($this->user->pro_ids), function ($query) use ($proIds, $restriccion) {
            return $query->whereNotIn('pro_id', function($query) use ($restriccion) {
                $query->select('pro_id')->from('programa_restriccion')->where('pro_id', '!=', $restriccion->pro_id);
            })->whereIn('pro_id', $proIds);
        })->get();

        $turnos = ProgramaTurno::all();

        return view('backend.pages.configuracion.restriccion.edit', compact('restriccion', 'programas', 'turnos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'res_descripcion' => 'required|string|max:255',
            'pro_id' => 'required|unique:programa_restriccion,pro_id,' . $id . ',pr_id',
            'gen_ids' => 'nullable|json',
            'sub_ids' => 'nullable|json',
            'niv_ids' => 'nullable|json',
            'esp_ids' => 'nullable|json',
            'esp_nombres' => 'nullable|json',
            'cat_ids' => 'nullable|json',
            'car_ids' => 'nullable|json',
            'car_cargos' => 'nullable|json',
            'pr_estado' => 'required|in:activo,inactivo,eliminado',
        ]);

        $restriccion = ProgramaRestriccion::findOrFail($id);
        $restriccion->update($request->all());

        return redirect()->route('restricciones.index')->with('success', 'Restricción actualizada con éxito.');
    }

    public function destroy(string $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        $restriccion = ProgramaRestriccion::findOrFail($id);
        $restriccion->delete();

        return redirect()->route('restricciones.index')->with('success', 'Restricción eliminada con éxito.');
    }
}
