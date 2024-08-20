<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
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
        if (is_null($this->user) || !$this->user->can('galeria.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ninguna imagen!');
        }

        $galerias = Galeria::where('galeria_estado', '<>', 'eliminado')->get();
        confirmDelete('Eliminar imagen', 'Esta seguro de eliminar? Esta acción no se puede deshacer.');

        return view('backend.pages.galeria.index', compact('galerias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('galeria.create')) {
            abort(403, 'Lo siento !! ¡No estas autorizado a crear galerias !');
        }

        return view('backend.pages.galeria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'galeria_imagen' => 'required|image|mimes:png,jpg,jpeg|max:2000',
        ], [
            'blog_imagen.image' => 'El archivo debe ser una imagen.',
            'blog_imagen.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'blog_imagen.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
        ]);

        $galeria = new Galeria();

        $imagePath = $request->file('galeria_imagen')->store('public/galeria');
        $galeria->galeria_imagen = basename($imagePath);

        $galeria->save();

        return redirect()->route('admin.galeria.index')->with('success', 'Imagen creada con éxito.');
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
        if (is_null($this->user) || !$this->user->can('galeria.edit')) {
            abort(403, 'Lo siento !! No estas autorizado a editar ninguna imagen !');
        }
        $galeria = Galeria::find($id);

        if (!$galeria) {
            abort(404, 'Galeria no encontrado.');
        }

        return view('backend.pages.galeria.edit', compact('galeria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'blog_imagen' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
        ], [
            'blog_imagen.image' => 'El archivo debe ser una imagen.',
            'blog_imagen.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'blog_imagen.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
        ]);

        $galeria = Galeria::find($id);

        if ($request->hasFile('galeria_imagen')) {
            // Eliminar el afiche actual si existe
            if ($galeria->galeria_imagen) {
                Storage::delete('public/galeria/' . $galeria->galeria_imagen);
            }
            // Guardar el nuevo afiche
            $galeriaImagePath = $request->file('galeria_imagen')->store('public/galeria');
            $galeria->galeria_imagen = basename($galeriaImagePath);
        }

        $galeria->save();

        return redirect()->route('admin.galeria.index')->with('success', 'Galeria editada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeria = Galeria::find($id);

        if (!$galeria) {
            abort(404, 'galeria no encontrada.');
        }
        $galeria->galeria_estado = 'eliminado';
        $galeria->save();

        return redirect()->route('admin.galeria.index')
            ->with('success', 'Galeria eliminada exitosamente.');
    }

    public function estado(string $id)
    {
        $galeria = Galeria::where('galeria_id', $id)->first();
        if ($galeria->galeria_estado == 'activo') {
            $galeria->galeria_estado = 'inactivo';
        } else {
            $galeria->galeria_estado = 'activo';
        }
        $galeria->save();

        return back()->with('success', 'Estado actualizado');
    }
}
