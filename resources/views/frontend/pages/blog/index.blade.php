@extends('frontend.layouts.master')

@section('frontend-content')
    @php
        use Carbon\Carbon;
    @endphp
    <section class="breadcrumb-area d-flex  p-relative align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-left">
                        <div class="breadcrumb-title">
                            <h2>Nuestros blogs</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- breadcrumb-area-end -->
    <div class="inner-blog pt-120 pb-80">
        <div class="container">
            <div class="row"> <!-- .blog -->
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="blog-deatails-box">
                        @if ($totalBlogs > 0)
                            @if (request('search'))
                                <h4 class="text-muted">
                                    Se encontraron {{ $totalBlogs }} blogs en la busqueda "{{ request('search') }}".
                                </h4>
                                <br>
                            @endif
                            @foreach ($blogs as $blog)
                                <article
                                    class="post-2695 post type-post status-publish format-standard has-post-thumbnail hentry">
                                    <div class="bsingle__post mb-50">
                                        <div class="bsingle__post-thumb">
                                            <a href="{{ route('blog.show', $blog->blog_id) }}">
                                                <img src="{{ asset('storage/blog/' . $blog->blog_imagen) }}"
                                                    alt="{{ $blog->blog_titulo }}" />
                                            </a>
                                        </div>
                                        <div class="bsingle__content">
                                            <div class="meta-info">
                                                <ul>
                                                    <li><i class="far fa-user"></i> By admin</li>
                                                    <li><i class="fal fa-calendar-alt"></i>
                                                        {{ Carbon::parse($blog->created_at)->translatedFormat('F d, Y') }}
                                                    </li>
                                                    <li><i class="far fa-comments"></i> No Comments</li>
                                                </ul>
                                            </div>
                                            <h2 class="single">
                                                <a
                                                    href="{{ route('blog.show', $blog->blog_id) }}">{{ $blog->blog_titulo }}</a>
                                            </h2>
                                            <p>{!! Str::words($blog->blog_descripcion, 50, '...') !!}</p>
                                            <div class="blog__btn">
                                                <a class="btn" href="{{ route('blog.show', $blog->blog_id) }}">
                                                    Leer más <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                            <nav class="navigation posts-navigation" aria-label="Posts">
                                <h2 class="screen-reader-text">Blogs navigation</h2>
                                <div class="nav-links">
                                    @if ($blogs->onFirstPage())
                                        <div class="nav-previous disabled"><span>Older posts</span></div>
                                    @else
                                        <div class="nav-previous">
                                            <a href="{{ $blogs->appends(request()->except('page'))->previousPageUrl() }}">Older
                                                posts</a>
                                        </div>
                                    @endif
                                </div>
                            </nav>

                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="pagination-wrap mb-50">
                                        <ul class="pagination">
                                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                                <li class="{{ $page == $blogs->currentPage() ? 'active' : '' }}">
                                                    <a
                                                        href="{{ $blogs->appends(request()->except('page'))->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if (request('search'))
                                <h4>
                                    No se encontraron blogs que contengan "{{ request('search') }}".
                                </h4>
                                <br>
                                <a href="{{ route('blog') }}" class="btn">
                                    <i class="fa fa-arrow-left"></i> Volver
                                </a>
                            @else
                                <h4>
                                    No se encontraron blogs.
                                </h4>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    @include('frontend.pages.blog.partials.sidebar')
                </div> <!-- #right side end -->
            </div>
        </div>
    </div>
@endsection
