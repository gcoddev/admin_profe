<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comunicado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComunicadoController extends Controller
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
        if (is_null($this->user) || !$this->user->can('comunicado.view')) {
            abort(403, 'Lo siento !! ¡No estás autorizado a ver ningún comunicado!');
        }

        $comunicados = Comunicado::where('comun_estado', '<>', 'eliminado')->get();
        confirmDelete('Eliminar comunicado', 'Esta seguro de eliminar? Esta acción no se puede deshacer.');

        return view('backend.pages.comunicado.index', compact('comunicados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('comunicado.edit')) {
            abort(403, 'Lo siento !! ¡No estas autorizado a crear ningún comunicado !');
        }

        return view('backend.pages.comunicado.create');
    }

    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'comun_nombre' => 'required|max:255',
            'comun_descripcion' => 'required',
            'comun_imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'comun_importancia' => 'required|in:importante,normal',
        ], [
            'comun_nombre.required' => 'El nombre del comunicado es obligatorio.',
            'comun_nombre.max' => 'El nombre del comunicado no puede superar los 255 caracteres.',
            'comun_descripcion.required' => 'La descripción del comunicado es obligatoria.',
            'comun_imagen.required' => 'Es necesario subir una imagen.',
            'comun_imagen.image' => 'El archivo debe ser una imagen.',
            'comun_imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'comun_imagen.max' => 'La imagen no debe exceder los 2MB.',
            'comun_importancia.required' => 'Debe seleccionar la importancia del comunicado.',
            'comun_importancia.in' => 'La importancia seleccionada no es válida.',
        ]);

        $path = $request->file('comun_imagen')->store('public/comunicado');

        $comunicado = new Comunicado();
        $comunicado->comun_nombre = $request->comun_nombre;
        $comunicado->comun_descripcion = $request->comun_descripcion;
        $comunicado->comun_imagen = basename($path);
        $comunicado->comun_importancia = $request->comun_importancia;
        $comunicado->save();

        return redirect()->route('admin.comunicado.index')->with('success', 'Comunicado guardado exitosamente.');
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
        if (is_null($this->user) || !$this->user->can('comunicado.edit')) {
            abort(403, 'Lo siento !! No estas autorizado a editar ningún comunicado !');
        }
        $comunicado = Comunicado::find($id);

        if (!$comunicado) {
            abort(404, 'Comunicado no encontrado.');
        }

        return view('backend.pages.comunicado.edit', compact('comunicado'));
    }

    /**
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'comun_nombre' => 'required|max:255',
            'comun_descripcion' => 'required',
            'comun_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'comun_importancia' => 'required|in:importante,normal',
        ], [
            'comun_nombre.required' => 'El nombre del comunicado es obligatorio.',
            'comun_nombre.max' => 'El nombre del comunicado no puede superar los 255 caracteres.',
            'comun_descripcion.required' => 'La descripción del comunicado es obligatoria.',
            'comun_imagen.image' => 'El archivo debe ser una imagen.',
            'comun_imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'comun_imagen.max' => 'La imagen no debe exceder los 2MB.',
            'comun_importancia.required' => 'Debe seleccionar la importancia del comunicado.',
            'comun_importancia.in' => 'La importancia seleccionada no es válida.',
        ]);

        $comunicado = Comunicado::find($id);

        $comunicado->comun_nombre = $request->comun_nombre;
        $comunicado->comun_descripcion = $request->comun_descripcion;

        if ($request->hasFile('comun_imagen')) {
            // Eliminar el afiche actual si existe
            if ($comunicado->comun_imagen) {
                Storage::delete('public/comunicado/' . $comunicado->comun_imagen);
            }
            // Guardar el nuevo afiche
            $comunicadoImagePath = $request->file('comun_imagen')->store('public/comunicado');
            $comunicado->comun_imagen = basename($comunicadoImagePath);
        }

        $comunicado->comun_importancia = $request->comun_importancia;
        $comunicado->save();

        return redirect()->route('admin.comunicado.index')->with('success', 'Comunicado actualizado exitosamente.');
    }

    /**
     */
    public function destroy(string $id)
    {
        $comunicado = Comunicado::find($id);

        if (!$comunicado) {
            abort(404, 'Comunicado no encontrado.');
        }
        $comunicado->comun_estado = 'eliminado';
        $comunicado->save();

        return redirect()->route('admin.comunicado.index')
            ->with('success', 'Comunicado eliminado exitosamente.');
    }

    public function estado(string $id)
    {
        $comunicado = Comunicado::find($id);
        if ($comunicado->comun_estado == 'activo') {
            $comunicado->comun_estado = 'inactivo';
        } else {
            $comunicado->comun_estado = 'activo';
        }
        $comunicado->save();

        return back()->with('success', 'Estado actualizado');
    }
}
