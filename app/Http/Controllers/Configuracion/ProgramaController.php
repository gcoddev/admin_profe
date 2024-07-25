<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProgramaVersion;
use App\Models\ProgramaDuracion;
use App\Models\ProgramaTipo;
use App\Models\ProgramaTurno;
use App\Models\ProgramaModalidad;
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

        $versiones = ProgramaVersion::all();
        $duraciones = ProgramaDuracion::all();
        $tipos = ProgramaTipo::all();
        $modalidades = ProgramaModalidad::all();
        $turnos = ProgramaTurno::all();
        return view('backend.pages.configuracion.programa.index', compact(['versiones','duraciones','tipos','modalidades','turnos']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeVersion(Request $request)
    {
        // Validation Data
        $request->validate([
            'pv_nombre' => 'required|max:100',
            'pv_numero' => 'required|numeric|max:100',
        ]);
        $version = new ProgramaVersion();
        $version->pv_nombre = $request->pv_nombre;
        $version->pv_numero = $request->pv_numero;
        $version->save();
        session()->flash('success', 'Versión creada con exito');
        return redirect()->route('configuracion.programa.index');
    }
    public function updateVersion(Request $request, $pv_id)
    {
        $validator = Validator::make($request->all(), [
            'pv_nombre' => 'required|max:100',
            'pv_numero' => 'required|numeric|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $version = ProgramaVersion::findOrFail($pv_id);
        $version->pv_nombre = $request->pv_nombre;
        $version->pv_numero = $request->pv_numero;
        $version->save();

        return response()->json(['success' => 'Versión actualizada con éxito', 'version' => $version]);
    }

    public function destroyVersion($id)
    {
        $version = ProgramaVersion::findOrFail($id);
        $version->delete();

        return response()->json(['success' => 'Versión eliminada con éxito']);
    }
    public function storeTipo(Request $request)
    {
        // Validation Data
        $request->validate([
            'pro_tip_nombre' => 'required|max:200',
        ]);
        $tipo = new ProgramaTipo();
        $tipo->pro_tip_nombre = $request->pro_tip_nombre;
        $tipo->save();
        session()->flash('success', 'Tipo creada con exito');
        return redirect()->route('configuracion.programa.index');
    }
    public function storeTurno(Request $request)
    {
        // Validation Data
        $request->validate([
            'pro_tur_nombre' => 'required|max:200',
        ]);
        $turno = new ProgramaTurno();
        $turno->pro_tur_nombre = $request->pro_tur_nombre;
        $turno->save();
        session()->flash('success', 'Turno creada con exito');
        return redirect()->route('configuracion.programa.index');
    }
    public function storeDuracion(Request $request)
    {
        // Validation Data
        $request->validate([
            'pd_nombre' => 'required|max:200',
            'pd_semana' => 'required|numeric|max:100',
        ]);
        $duracion = new ProgramaDuracion();
        $duracion->pd_nombre = $request->pd_nombre;
        $duracion->pd_semana = $request->pd_semana;
        $duracion->save();
        session()->flash('success', 'Duración creada con exito');
        return redirect()->route('configuracion.programa.index');
    }
    public function storeModalidad(Request $request)
    {
        // Validation Data
        $request->validate([
            'pm_nombre' => 'required|max:200',
        ]);
        $modalidad = new ProgramaModalidad();
        $modalidad->pm_nombre = $request->pm_nombre;
        $modalidad->save();
        session()->flash('success', 'Modalidad creada con exito');
        return redirect()->route('configuracion.programa.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
