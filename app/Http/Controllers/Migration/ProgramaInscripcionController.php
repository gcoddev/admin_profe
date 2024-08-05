<?php

namespace App\Http\Controllers\Migration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramaInscripcion;
use App\Imports\ProgramaInscripcionImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;


class ProgramaInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        if (is_null($this->user) || !$this->user->can('migracion.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $personaInscritos = DB::table('programa_inscripcion')
            ->join('map_persona', 'map_persona.per_id', '=', 'programa_inscripcion.per_id')
            ->select('map_persona.*', 'programa_inscripcion.*')->get();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.migration.inscripcion.index', compact('personaInscritos'));
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
        //
        try {
            $file = $request->file('import_file');
            Excel::import(new ProgramaInscripcionImport, $file);

            return redirect()->route('migration.inscripciones.index')->with('success', 'La importación se ha realizado con éxito.');

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
