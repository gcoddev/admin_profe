<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProgramaTipo;
use App\Models\Sede;
use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;


class SedeController extends Controller
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
        $sedes = DB::table('sede')
            ->join('departamento', 'sede.dep_id', '=', 'departamento.dep_id')
            ->select('sede.*', 'departamento.dep_nombre')
                        ->get();
        //$mapPersona = MapPersona::paginate(100);
        return view('backend.pages.sede.index', compact(['sedes']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('sede.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        $departamentos  = Departamento::all();
        return view('backend.pages.sede.create', compact('departamentos'));
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
            'sede_imagen' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'sede_nombre' => 'required|string|max:255',
            'sede_descripcion' => 'required',
            'sede_contacto_1' => 'required|integer',
            'sede_horario' => 'required|string|max:255',
            'sede_turno' => 'required|string|max:255',
            'sede_ubicacion' => 'required',
            // Agrega aquí las validaciones para los demás campos
            ], [
                'sede_imagen.required' => 'La imagen de la sede es obligatoria.',
                'sede_imagen.image' => 'El archivo debe ser una imagen.',
                'sede_imagen.mimes' => 'La imagen debe ser de tipo: png, jpg, jpeg.',
                'sede_imagen.max' => 'La imagen no puede tener un tamaño mayor a :max kilobytes.',
                'sede_nombre.required' => 'El nombre de la sede es obligatorio.',
                'sede_nombre.string' => 'El nombre de la sede debe ser una cadena de texto.',
                'sede_nombre.max' => 'El nombre de la sede no puede tener más de :max caracteres.',
                'sede_descripcion.required' => 'La descripción de la sede es obligatoria.',
                'sede_contacto_1.required' => 'El contacto de la sede es obligatorio.',
                'sede_contacto_1.integer' => 'El contacto de la sede debe ser un número entero.',
                'sede_horario.required' => 'El horario de la sede es obligatorio.',
                'sede_horario.string' => 'El horario de la sede debe ser una cadena de texto.',
                'sede_horario.max' => 'El horario de la sede no puede tener más de :max caracteres.',
                'sede_turno.required' => 'El turno de la sede es obligatorio.',
                'sede_turno.string' => 'El turno de la sede debe ser una cadena de texto.',
                'sede_turno.max' => 'El turno de la sede no puede tener más de :max caracteres.',
                'sede_ubicacion.required' => 'La ubicación de la sede es obligatoria.',
            ]
        );
        // Procesamiento de las imágenes
        $sedeImagenPath = $request->file('sede_imagen')->store('public/sede_imagen');

        $sede = new Sede();
        $sede->sede_imagen = basename($sedeImagenPath); // Guardar solo el nombre del archivo
        $sede->sede_nombre = $request->sede_nombre;
        $sede->sede_descripcion = $request->sede_descripcion;
        $sede->sede_contacto_1 = $request->sede_contacto_1;
        $sede->sede_contacto_2 = $request->sede_contacto_2??NULL;
        $sede->sede_horario = $request->sede_horario;
        $sede->sede_turno = $request->sede_turno;
        $sede->sede_ubicacion = $request->sede_ubicacion;
        $sede->dep_id = $request->dep_id;
        $sede->save();
        // session()->flash('success', 'Versión creada con exito');
        // return redirect()->route('configuracion.programa.index');
        // Crear un nuevo programa
        return redirect()->route('admin.sede.index')
            ->with('success', 'Sede creado exitosamente.');
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
