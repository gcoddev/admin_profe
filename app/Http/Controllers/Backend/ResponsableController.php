<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ResponsableProfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResponsableController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún admin!');
        }

        $responsables = ResponsableProfe::where('resp_profe_estado', '<>', 'eliminado')->get();
        confirmDelete('Eliminar responsable', 'Esta seguro de eliminar? Esta acción no se puede deshacer.');

        return view('backend.pages.responsable.index', compact('responsables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Lo siento !! ¡No estas autorizado a crear admin !');
        }

        return view('backend.pages.responsable.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'resp_profe_nombre_completo' => 'required|string|max:255',
            'resp_profe_facebook' => 'nullable',
            'resp_profe_tiktok' => 'nullable',
            'resp_profe_correo' => 'nullable|email',
            'resp_profe_pagina' => 'nullable',
            'resp_profe_youtube' => 'nullable',
            'resp_profe_cargo' => 'required|string|max:255',
            'resp_profe_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'resp_profe_nombre_completo.required' => 'El nombre completo es obligatorio.',
            'resp_profe_nombre_completo.string' => 'El nombre completo debe ser una cadena de texto.',
            'resp_profe_nombre_completo.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'resp_profe_celular.numeric' => 'El celular debe ser un número.',
            'resp_profe_correo.email' => 'El correo debe ser una dirección de email válida.',
            'resp_profe_cargo.required' => 'El cargo es obligatorio.',
            'resp_profe_cargo.string' => 'El cargo debe ser una cadena de texto.',
            'resp_profe_cargo.max' => 'El cargo no puede tener más de 255 caracteres.',
            'resp_profe_imagen.image' => 'El archivo debe ser una imagen.',
            'resp_profe_imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, o gif.',
            'resp_profe_imagen.max' => 'La imagen no puede tener más de 2MB.',
        ]);

        $imagePath = $request->file('resp_profe_imagen')->store('public/responsable');

        $responsableProfe = new ResponsableProfe;

        $responsableProfe->resp_profe_imagen = $imagePath;

        $responsableProfe->resp_profe_nombre_completo = $request->resp_profe_nombre_completo;
        $responsableProfe->resp_profe_celular = $request->resp_profe_celular;
        $responsableProfe->resp_profe_cargo = $request->resp_profe_cargo;
        $responsableProfe->resp_profe_facebook = $request->resp_profe_facebook;
        $responsableProfe->resp_profe_tiktok = $request->resp_profe_tiktok;
        $responsableProfe->resp_profe_correo = $request->resp_profe_correo;
        $responsableProfe->resp_profe_pagina = $request->resp_profe_pagina;
        $responsableProfe->resp_profe_youtube = $request->resp_profe_youtube;

        $responsableProfe->save();

        return redirect()->route('admin.responsable.index')->with('success', 'Responsable guardado con éxito.');
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Lo siento !! No estas autorizado a editar ningún admin !');
        }
        $responsable = ResponsableProfe::find($id);

        if (!$responsable) {
            abort(404, 'Responsable no encontrado.');
        }

        return view('backend.pages.responsable.edit', compact('responsable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'resp_profe_nombre_completo' => 'required|string|max:255',
            'resp_profe_facebook' => 'nullable',
            'resp_profe_tiktok' => 'nullable',
            'resp_profe_correo' => 'nullable|email',
            'resp_profe_pagina' => 'nullable',
            'resp_profe_youtube' => 'nullable',
            'resp_profe_cargo' => 'required|string|max:255',
            'resp_profe_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'resp_profe_nombre_completo.required' => 'El nombre completo es obligatorio.',
            'resp_profe_nombre_completo.string' => 'El nombre completo debe ser una cadena de texto.',
            'resp_profe_nombre_completo.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'resp_profe_celular.numeric' => 'El celular debe ser un número.',
            'resp_profe_correo.email' => 'El correo debe ser una dirección de email válida.',
            'resp_profe_cargo.required' => 'El cargo es obligatorio.',
            'resp_profe_cargo.string' => 'El cargo debe ser una cadena de texto.',
            'resp_profe_cargo.max' => 'El cargo no puede tener más de 255 caracteres.',
            'resp_profe_imagen.image' => 'El archivo debe ser una imagen.',
            'resp_profe_imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, o gif.',
            'resp_profe_imagen.max' => 'La imagen no puede tener más de 2MB.',
        ]);

        $responsableProfe = ResponsableProfe::find($id);

        if ($request->hasFile('resp_profe_imagen')) {
            if ($responsableProfe->resp_profe_imagen) {
                Storage::delete('public/responsable/' . $responsableProfe->resp_profe_imagen);
            }
            $imagePath = $request->file('resp_profe_imagen')->store('public/responsable');
            $responsableProfe->resp_profe_imagen = basename($imagePath);
        }

        $responsableProfe->resp_profe_nombre_completo = $request->resp_profe_nombre_completo;
        $responsableProfe->resp_profe_celular = $request->resp_profe_celular;
        $responsableProfe->resp_profe_facebook = $request->resp_profe_facebook;
        $responsableProfe->resp_profe_tiktok = $request->resp_profe_tiktok;
        $responsableProfe->resp_profe_correo = $request->resp_profe_correo;
        $responsableProfe->resp_profe_pagina = $request->resp_profe_pagina;
        $responsableProfe->resp_profe_youtube = $request->resp_profe_youtube;
        $responsableProfe->resp_profe_cargo = $request->resp_profe_cargo;

        $responsableProfe->save();

        return redirect()->route('admin.responsable.index')->with('success', 'Responsable actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $responsable = ResponsableProfe::where('resp_profe_id', $id)->first();

        if (!$responsable) {
            abort(404, 'Responsable no encontrado.');
        }
        $responsable->resp_profe_estado = 'eliminado';
        $responsable->save();

        return redirect()->route('admin.responsable.index')
            ->with('success', 'Responsable eliminado exitosamente.');
    }

    public function estado(string $id)
    {
        $responsable = ResponsableProfe::where('resp_profe_id', $id)->first();
        if ($responsable->resp_profe_estado == 'activo') {
            $responsable->resp_profe_estado = 'inactivo';
        } else {
            $responsable->resp_profe_estado = 'activo';
        }
        $responsable->save();

        return back()->with('success', 'Estado actualizado');
    }
}
