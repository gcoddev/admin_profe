<?php

namespace App\Http\Controllers\Migration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MapPersona;
use App\Imports\MapPersonaImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;


class UsuariosController extends Controller
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
        if (is_null($this->user) || !$this->user->can('migracion.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $mapPersonas = DB::table('map_persona')
            ->join('map_especialidad', 'map_persona.esp_id', '=', 'map_especialidad.esp_id')
            ->join('map_cargo', 'map_persona.car_id', '=', 'map_cargo.car_id')
            ->join('map_categoria', 'map_persona.cat_id', '=', 'map_categoria.cat_id')
            ->join('map_subsistema', 'map_persona.sub_id', '=', 'map_subsistema.sub_id')
            ->join('area_trabajo', 'map_persona.area_id', '=', 'area_trabajo.area_id')
            ->join('map_nivel', 'map_persona.niv_id', '=', 'map_nivel.niv_id')
            ->join('genero', 'map_persona.gen_id', '=', 'genero.gen_id')
            ->join('unidad_educativa', 'map_persona.uni_edu_id', '=', 'unidad_educativa.uni_edu_id')
            ->select('map_persona.*', 'map_especialidad.esp_nombre', 'map_cargo.car_nombre',
                        'map_categoria.cat_nombre','map_subsistema.sub_nombre','map_nivel.niv_nombre',
                        'genero.gen_nombre', 'unidad_educativa.uni_edu_nombre','area_trabajo.area_nombre')
                        ->limit(1000)
                        ->get();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.migration.persona.index', compact('mapPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (is_null($this->user) || !$this->user->can('migraciones.migration')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any role !');
        // }
        // $request->validate([
        //     'import_file' => 'required|mimes:csv,xls,xlsx|max:30000',
        // ]);

        try {
            $file = $request->file('import_file');
            Excel::import(new MapPersonaImport, $file);

            return redirect()->route('migration.usuarios.index')->with('success', 'La importación se ha realizado con éxito.');

        } catch (QueryException $e) {
            // Capturar la excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
