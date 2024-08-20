@extends('frontend.layouts.master')

@section('frontend-content')
    <section class="breadcrumb-area d-flex  p-relative align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-left">
                        <div class="breadcrumb-title">
                            <h2>Comunicados</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comunicados</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <article id="post-78" class="post-78 page type-page status-publish hentry">
        <div class="pages-content">
            <div data-elementor-type="wp-page" data-elementor-id="78" class="elementor elementor-78">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-ce034c9 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                    data-id="ce034c9" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c20593e"
                            data-id="c20593e" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-1e2c1f4 elementor-widget elementor-widget-Elementor-courses-widget"
                                    data-id="1e2c1f4" data-element_type="widget"
                                    data-widget_type="Elementor-courses-widget.default">
                                    <div class="elementor-widget-container"> <!-- courses-area -->
                                        <section class="shop-area pt-120 pb-90 p-relative "
                                            data-animation="fadeInUp animated" data-delay=".2s">
                                            <div class="container">
                                                <div class="row align-items-center">
                                                    @foreach ($comunicados as $comunicado)
                                                        <div class="col-lg-4 col-md-6 ">
                                                            <div class="courses-item mb-30 hover-zoomin">
                                                                <div class="thumb fix">
                                                                    <a
                                                                        href="{{ route('comunicado.show', $comunicado->comun_id) }}">
                                                                        <img decoding="async" width="1180" height="664"
                                                                            src="{{ asset('storage/comunicado/' . $comunicado->comun_imagen) }}"
                                                                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                            alt="" />
                                                                    </a>
                                                                </div>
                                                                <div class="courses-content">
                                                                    <div class="cat">
                                                                        <i class="fal fa-graduation-cap"></i>
                                                                        {{ $comunicado->comun_importancia }}
                                                                    </div>
                                                                    <h3>
                                                                        <a
                                                                            href="{{ route('comunicado.show', $comunicado->comun_id) }}">
                                                                            {{ $comunicado->comun_nombre }}
                                                                        </a>
                                                                    </h3>
                                                                    <p>
                                                                        {!! Str::words($comunicado->comun_descripcion, 20, '...') !!}
                                                                    </p>
                                                                    <a href="{{ route('comunicado.show', $comunicado->comun_id) }}"
                                                                        class="readmore">Leer mas
                                                                        <i class="fal fa-long-arrow-right"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="icon"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </section> <!-- courses-area-end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div><!-- .entry-content -->
    </article>
@endsection
