<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Programa;
use App\Models\Sede;
use App\Models\MapPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchRda(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
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
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $roles  = Role::all();
        $sedes  = Sede::all();
        $programas  = Programa::all();
        return view('backend.pages.admins.create', compact('roles','sedes','programas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        // Validation Data
        $request->validate([
                'nombre' => 'required|max:250',
                'apellidos' => 'required|max:250',
                'per_id' => 'required|max:20|unique:admins',
                'celular' => 'required|max:250',
                'cargo' => 'required|max:250',
                'correo' => 'required|max:250|email|unique:admins',
                'username' => 'required|max:100|unique:admins',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.max' => 'El nombre no puede tener más de 250 caracteres.',
                'apellidos.required' => 'Los apellidos son obligatorios.',
                'apellidos.max' => 'Los apellidos no pueden tener más de 250 caracteres.',
                'per_id.required' => 'El RDA es obligatorio.',
                'per_id.max' => 'El RDA no puede tener más de 20 caracteres.',
                'per_id.unique' => 'Este RDA ya está en uso por otro administrador.',
                'celular.required' => 'El celular es obligatorio.',
                'celular.max' => 'El celular no puede tener más de 250 caracteres.',
                'cargo.required' => 'El cargo es obligatorio.',
                'cargo.max' => 'El cargo no puede tener más de 250 caracteres.',
                'correo.required' => 'El correo es obligatorio.',
                'correo.max' => 'El correo no puede tener más de 250 caracteres.',
                'correo.email' => 'El correo debe ser una dirección de correo electrónico válida.',
                'correo.unique' => 'Este correo electrónico ya está registrado por otro administrador.',
                'username.required' => 'El nombre de usuario es obligatorio.',
                'username.max' => 'El nombre de usuario no puede tener más de 100 caracteres.',
                'username.unique' => 'Este nombre de usuario ya está en uso por otro administrador.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            ]
        );
        //$request->rda;
        // CREAR NUEVO ADMIN
        $admin = new Admin();
        $admin->per_id = $request->per_id;
        $admin->nombre = $request->nombre;
        $admin->apellidos = $request->apellidos;
        $admin->cargo = $request->cargo;
        $admin->facebook = $request->facebook;
        $admin->tiktok = $request->tiktok;
        $admin->celular = $request->celular;
        $admin->username = $request->username;
        $admin->correo = $request->correo;
        $admin->password = Hash::make($request->password);
        // Guardar los IDs de sedes y programas como JSON
        $admin->sede_ids = json_encode($request->sedes);
        $admin->pro_ids = json_encode($request->programas);
        $admin->save();

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin creado !!');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $admin = Admin::find($id);
        $roles  = Role::all();
        $sedes  = Sede::all();
        $programas  = Programa::all();
        return view('backend.pages.admins.edit', compact('admin', 'roles','sedes','programas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a editar ningún administrador!');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Lo siento !! No está autorizado a actualizar este administrador ya que es el superadministrador. ¡Cree uno nuevo si necesita realizar una prueba!');
            return back();
        }

        // Create New Admin
        $admin = Admin::find($id);

        // Validation Data
        $request->validate([
            'password' => 'nullable|min:6|confirmed',
        ]);


        $admin->cargo = $request->cargo;
        $admin->facebook = $request->facebook;
        $admin->tiktok = $request->tiktok;
        $admin->celular = $request->celular;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        // Guardar los IDs de sedes y programas como JSON
        $admin->sede_ids = json_encode($request->sedes);
        $admin->pro_ids = json_encode($request->programas);
        $admin->save();

        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin actualizado !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to delete this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }
}
