<?php

namespace App\Http\Controllers\Migration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Distrito;
use App\Imports\DistritoImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class DistritoController extends Controller
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
        if (is_null($this->user) || !$this->user->can('migracion.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        // Usando Query Builder
        $distritos = DB::table('distrito')
            ->join('departamento', 'distrito.dep_id', '=', 'departamento.dep_id')
            ->select('distrito.*', 'departamento.dep_nombre')
            ->get();
        return view('backend.pages.migration.distrito.index', compact('distritos'));
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
            Excel::import(new DistritoImport, $file);

            return redirect()->route('migration.distrito.index')->with('success', 'La importación se ha realizado con éxito.');

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
