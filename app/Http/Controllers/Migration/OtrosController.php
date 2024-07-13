<?php

namespace App\Http\Controllers\Migration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AreaTrabajo;
use App\Imports\AreaTrabajoImport;
use App\Models\MapNivel;
use App\Imports\MapNivelImport;
use App\Models\MapCategoria;
use App\Imports\MapCategoriaImport;
use App\Models\MapSubsistema;
use App\Imports\MapSubsistemaImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class OtrosController extends Controller
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
        $areaTrabajos  = AreaTrabajo::all();
        $niveles  = MapNivel::all();
        $subsistemas  = MapSubsistema::all();
        $categorias  = MapCategoria::all();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.migration.otros.index', compact(['areaTrabajos', 'niveles', 'subsistemas', 'categorias']));
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
    public function areatrabajo(Request $request)
    {
        try {
            $file = $request->file('import_file');
            Excel::import(new AreaTrabajoImport, $file);

            return redirect()->route('migration.otros.index')->with('success', 'La importación se ha realizado con éxito.');

        } catch (QueryException $e) {
            // Capturar la excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function nivel(Request $request)
    {
        try {
            $file = $request->file('import_file');
            Excel::import(new MapNivelImport, $file);

            return redirect()->route('migration.otros.index')->with('success', 'La importación se ha realizado con éxito.');

        } catch (QueryException $e) {
            // Capturar la excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function categoria(Request $request)
    {
        try {
            $file = $request->file('import_file');
            Excel::import(new MapCategoriaImport, $file);

            return redirect()->route('migration.otros.index')->with('success', 'La importación se ha realizado con éxito.');

        } catch (QueryException $e) {
            // Capturar la excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function subsistema(Request $request)
    {
        try {
            $file = $request->file('import_file');
            Excel::import(new MapSubsistemaImport, $file);

            return redirect()->route('migration.otros.index')->with('success', 'La importación se ha realizado con éxito.');

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
