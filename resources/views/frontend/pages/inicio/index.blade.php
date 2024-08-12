@extends('frontend.layouts.master')

@section('styles')
    <style>
        text-black {
            color: #000000;
        }
    </style>
@endsection

@section('frontend-content')
    <article id="post-9" class="post-9 page type-page status-publish hentry">
        <div class="pages-content">
            <div data-elementor-type="wp-page" data-elementor-id="9" class="elementor elementor-9">
                @include('frontend.pages.inicio.components.portada')
                @include('frontend.pages.inicio.components.acerca')
                @include('frontend.pages.inicio.components.programas')
                @include('frontend.pages.inicio.components.eventos')
                @include('frontend.pages.inicio.components.blogs')
            </div>
        </div><!-- .entry-content -->
    </article><!-- #post-9 -->
@endsection
