<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfeController extends Controller
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
        if (is_null($this->user) || !$this->user->can('profe.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver la información!');
        }
        $profe = Profe::first();

        return view('backend.pages.profe.index', compact('profe'));
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
        if (is_null($this->user) || !$this->user->can('programa.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        // Validación de datos
        $request->validate([
            'profe_imagen' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'profe_nombre' => 'required|string|max:255',
            'profe_descripcion' => 'required|string',
            'profe_sobre_nosotros' => 'required|string',
            'profe_mision' => 'required|string',
            'profe_vision' => 'required|string',
            'profe_actividad' => 'required|string',
            'profe_fecha_creacion' => 'required|date',
            'profe_correo' => 'nullable|string|max:255',
            'profe_celular' => 'nullable|string|max:255',
            'profe_telefono' => 'nullable|string|max:255',
            'profe_pagina' => 'nullable|string|max:255',
            'profe_facebook' => 'nullable|string|max:255',
            'profe_tiktok' => 'nullable|string|max:255',
            'profe_youtube' => 'nullable|string|max:255',
            'profe_ubicacion' => 'required|string',
            'profe_latitud' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,8})?$/',
            'profe_longitud' => 'nullable|numeric|regex:/^\d{1,3}(\.\d{1,8})?$/',
            'profe_banner' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'profe_afiche' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
            'profe_convocatoria' => 'required|string',
        ], [
            'profe_imagen.image' => 'El archivo debe ser una imagen.',
            'profe_imagen.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'profe_imagen.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
            'profe_nombre.required' => 'El nombre del profesor es obligatorio.',
            'profe_nombre.string' => 'El nombre debe ser una cadena de texto.',
            'profe_nombre.max' => 'El nombre no puede exceder los :max caracteres.',
            'profe_descripcion.required' => 'La descripción es obligatoria.',
            'profe_descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'profe_sobre_nosotros.required' => 'La sección "Sobre nosotros" es obligatoria.',
            'profe_sobre_nosotros.string' => 'La sección "Sobre nosotros" debe ser una cadena de texto.',
            'profe_mision.required' => 'La misión es obligatoria.',
            'profe_mision.string' => 'La misión debe ser una cadena de texto.',
            'profe_vision.required' => 'La visión es obligatoria.',
            'profe_vision.string' => 'La visión debe ser una cadena de texto.',
            'profe_actividad.required' => 'La actividad es obligatoria.',
            'profe_actividad.string' => 'La actividad debe ser una cadena de texto.',
            'profe_fecha_creacion.required' => 'La fecha de creación es obligatoria.',
            'profe_fecha_creacion.date' => 'La fecha de creación debe ser una fecha válida.',
            'profe_correo.string' => 'El correo debe ser una cadena de texto.',
            'profe_correo.max' => 'El correo no puede exceder los :max caracteres.',
            'profe_celular.string' => 'El celular debe ser una cadena de texto.',
            'profe_celular.max' => 'El celular no puede exceder los :max caracteres.',
            'profe_telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'profe_telefono.max' => 'El teléfono no puede exceder los :max caracteres.',
            'profe_pagina.string' => 'La página web debe ser una cadena de texto.',
            'profe_pagina.max' => 'La página web no puede exceder los :max caracteres.',
            'profe_facebook.string' => 'El enlace de Facebook debe ser una cadena de texto.',
            'profe_facebook.max' => 'El enlace de Facebook no puede exceder los :max caracteres.',
            'profe_tiktok.string' => 'El enlace de TikTok debe ser una cadena de texto.',
            'profe_tiktok.max' => 'El enlace de TikTok no puede exceder los :max caracteres.',
            'profe_youtube.string' => 'El enlace de YouTube debe ser una cadena de texto.',
            'profe_youtube.max' => 'El enlace de YouTube no puede exceder los :max caracteres.',
            'profe_ubicacion.required' => 'La ubicación es obligatoria.',
            'profe_ubicacion.string' => 'La ubicación debe ser una cadena de texto.',
            'profe_latitud.numeric' => 'La latitud debe ser un número.',
            'profe_latitud.regex' => 'La latitud debe tener un máximo de 11 dígitos, incluyendo hasta 8 decimales.',
            'profe_longitud.numeric' => 'La longitud debe ser un número.',
            'profe_longitud.regex' => 'La longitud debe tener un máximo de 11 dígitos, incluyendo hasta 8 decimales.',
            'profe_banner.image' => 'El archivo del banner debe ser una imagen.',
            'profe_banner.mimes' => 'El banner debe ser de tipo PNG, JPG o JPEG.',
            'profe_banner.max' => 'El tamaño máximo permitido para el banner es de :max kilobytes.',
            'profe_afiche.image' => 'El archivo del afiche debe ser una imagen.',
            'profe_afiche.mimes' => 'El afiche debe ser de tipo PNG, JPG o JPEG.',
            'profe_afiche.max' => 'El tamaño máximo permitido para el afiche es de :max kilobytes.',
            'profe_convocatoria.required' => 'La convocatoria es obligatoria.',
            'profe_convocatoria.string' => 'La convocatoria debe ser una cadena de texto.',
        ]);

        $profe = Profe::findOrFail($id);

        if ($request->hasFile('profe_imagen')) {
            if ($profe->profe_imagen) {
                Storage::delete('public/profe/' . $profe->profe_imagen);
            }
            $newImageName = $request->file('profe_imagen')->store('public/profe');
            $profe->profe_imagen = basename($newImageName);
        }

        if ($request->hasFile('profe_banner')) {
            if ($profe->profe_banner) {
                Storage::delete('public/profe/' . $profe->profe_banner);
            }
            $newBannerName = $request->file('profe_banner')->store('public/profe');
            $profe->profe_banner = basename($newBannerName);
        }

        if ($request->hasFile('profe_afiche')) {
            if ($profe->profe_afiche) {
                Storage::delete('public/profe/' . $profe->profe_afiche);
            }
            $newAficheName = $request->file('profe_afiche')->store('public/profe');
            $profe->profe_afiche = basename($newAficheName);
        }

        $profe->fill($request->except(['profe_imagen', 'profe_banner', 'profe_afiche']));
        $profe->save();

        return redirect()->route('admin.profe.index')
            ->with('success', 'La información ha sido actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
