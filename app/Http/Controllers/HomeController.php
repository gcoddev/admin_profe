<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Evento;
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
        $eventos = Evento::where('eve_estado', 'activo')->orderBy('eve_id', 'DESC')->get();
        $blogs = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->get();

        return view('frontend.pages.inicio.index', compact('programas', 'eventos', 'blogs'));
    }
}
