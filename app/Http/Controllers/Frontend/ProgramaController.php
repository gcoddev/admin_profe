<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Programa;

class ProgramaController extends Controller
{
    // Programas
    public function index()
    {
        $programas = Programa::where('pro_estado', 'activo')->orderBy('pro_id', 'DESC')->get();
        $blogs = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->get();

        return view('frontend.pages.programa.index', compact('programas', 'blogs'));
    }

    public function programa($pro_id)
    {
        $programa = Programa::where('pro_estado', 'activo')->where('pro_id', $pro_id)->first();
        $blogs = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->get();

        return view('frontend.pages.programa.programa', compact('programa', 'blogs'));
    }
}
