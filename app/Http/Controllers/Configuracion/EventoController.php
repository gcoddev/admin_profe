<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\ProgramaModalidad;
use App\Models\TipoEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // if (is_null($this->user) || !$this->user->can('configuracion_evento.index')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any role !');
        // }

        $tipos = TipoEvento::where('et_estado', '<>', 'eliminado')->get();
        $modalidades = ProgramaModalidad::where('pm_estado', '<>', 'eliminado')->get();

        return view('backend.pages.configuracion.evento.index', compact('tipos', 'modalidades'));
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
        $request->validate([
            'et_nombre' => 'required|max:255',
        ]);
        $version = new TipoEvento();
        $version->et_nombre = $request->et_nombre;
        $version->save();

        session()->flash('success', 'Tipo creado con exito');
        return redirect()->route('configuracion.evento.index');
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
