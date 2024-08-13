<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Blogs
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $blogs = Blog::where('blog_estado', 'activo')
                ->where('blog_titulo', 'like', "%{$query}%")
                // ->orWhere('blog_descripcion', 'like', "%{$query}%")
                ->paginate(2);

            $totalBlogs = Blog::where('blog_estado', 'activo')
                ->where('blog_titulo', 'like', "%{$query}%")
                // ->orWhere('blog_descripcion', 'like', "%{$query}%")
                ->count();
        } else {
            // Si no hay búsqueda, simplemente lista todos los blogs
            $blogs = Blog::where('blog_estado', 'activo')
                ->paginate(2);
            $totalBlogs = Blog::where('blog_estado', 'activo')
                ->count();
        }

        $recent = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->limit(3)->get();
        return view('frontend.pages.blog.index', compact('blogs', 'totalBlogs', 'query', 'recent'));
    }

    public function show($blog_id)
    {
        $blog = Blog::where('blog_estado', 'activo')->where('blog_id', $blog_id)->first();
        $recent = Blog::where('blog_estado', 'activo')->orderBy('blog_id', 'DESC')->limit(3)->get();

        return view('frontend.pages.blog.blog', compact('blog', 'recent'));
    }

    public function search(Request $request)
    {
        $query = $request->input('s');

        $blogs = Blog::where('blog_estado', 'activo')
            ->where('blog_titulo', 'like', "%{$query}%")
            ->orWhere('blog_descripcion', 'like', "%{$query}%")
            ->paginate(2);

        // Retorna los resultados a una vista
        return view('frontend.pages.blog.index', compact('blogs', 'query'));
    }
}
