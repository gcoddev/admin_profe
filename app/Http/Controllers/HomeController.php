<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comunicado;
use App\Models\Evento;
use App\Models\Profe;
use App\Models\Programa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function redirectAdmin()
    {
        return redirect()->route('evento.show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $programas = Programa::where('pro_estado', 'activo')->orderBy('pro_id', 'DESC')->get();
        $comunicados = Comunicado::where('comun_estado', 'activo')->orderBy('comun_id', 'DESC')->get();
        $eventos = Evento::where('eve_estado', 'activo')->orderBy('eve_id', 'DESC')->limit(6)->get();
        $blogs = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->limit(6)->get();
        $profe = Profe::first();

        return view('frontend.pages.inicio.index', compact('programas', 'comunicados', 'eventos', 'blogs', 'profe'));
    }
}
