<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
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
        if (is_null($this->user) || !$this->user->can('programa.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún evento!');
        }

        $blogs = Blog::where('blog_estado', '<>', 'eliminado')->get();
        confirmDelete('Eliminar blog', 'Esta seguro de eliminar? Esta acción no se puede deshacer.');

        return view('backend.pages.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('blog.edit')) {
            abort(403, 'Lo siento !! ¡No estas autorizado a crear blogs !');
        }

        return view('backend.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_titulo' => 'required|string|max:255',
            'blog_descripcion' => 'required|string',
            'blog_imagen' => 'required|image|mimes:png,jpg,jpeg|max:2000',
        ], [
            // Mensajes personalizados
            'blog_titulo.required' => 'El título del blog es obligatorio.',
            'blog_titulo.string' => 'El título del blog debe ser una cadena de texto.',
            'blog_titulo.max' => 'El título del blog no debe superar los :max caracteres.',
            'blog_descripcion.required' => 'La descripción del blog es obligatoria.',
            'blog_descripcion.string' => 'La descripción del blog debe ser una cadena de texto.',
            'blog_imagen.image' => 'El archivo debe ser una imagen.',
            'blog_imagen.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'blog_imagen.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
        ]);

        $blog = new Blog();

        $blog->blog_titulo = $request->input('blog_titulo');
        $blog->blog_descripcion = $request->input('blog_descripcion');

        $imagePath = $request->file('blog_imagen')->store('public/blog');
        $blog->blog_imagen = basename($imagePath);

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog creado con éxito.');
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
        if (is_null($this->user) || !$this->user->can('blog.edit')) {
            abort(403, 'Lo siento !! No estas autorizado a editar ningún blog !');
        }
        $blog = Blog::find($id);

        if (!$blog) {
            abort(404, 'blog no encontrado.');
        }

        return view('backend.pages.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'blog_titulo' => 'required|string|max:255',
            'blog_descripcion' => 'required|string',
            'blog_imagen' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
        ], [
            // Mensajes personalizados
            'blog_titulo.required' => 'El título del blog es obligatorio.',
            'blog_titulo.string' => 'El título del blog debe ser una cadena de texto.',
            'blog_titulo.max' => 'El título del blog no debe superar los :max caracteres.',
            'blog_descripcion.required' => 'La descripción del blog es obligatoria.',
            'blog_descripcion.string' => 'La descripción del blog debe ser una cadena de texto.',
            'blog_imagen.image' => 'El archivo debe ser una imagen.',
            'blog_imagen.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'blog_imagen.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
        ]);

        $blog = Blog::find($id);

        $blog->blog_titulo = $request->input('blog_titulo');
        $blog->blog_descripcion = $request->input('blog_descripcion');

        if ($request->hasFile('blog_imagen')) {
            // Eliminar el afiche actual si existe
            if ($blog->blog_imagen) {
                Storage::delete('public/blog/' . $blog->blog_imagen);
            }
            // Guardar el nuevo afiche
            $blogImagePath = $request->file('blog_imagen')->store('public/blog');
            $blog->blog_imagen = basename($blogImagePath);
        }

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::where('blog_id', $id)->first();

        if (!$blog) {
            abort(404, 'Blog no encontrado.');
        }
        $blog->blog_estado = 'eliminado';
        $blog->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog eliminado exitosamente.');
    }

    public function estado(string $id)
    {
        $blog = Blog::where('blog_id', $id)->first();
        if ($blog->blog_estado == 'activo') {
            $blog->blog_estado = 'inactivo';
        } else {
            $blog->blog_estado = 'activo';
        }
        $blog->save();

        return back()->with('success', 'Estado actualizado');
    }
}
