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
                            <h2>Nuestros eventos</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Evento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- breadcrumb-area-end -->
    <article id="post-100" class="post-100 page type-page status-publish hentry">
        <div class="pages-content">
            <div data-elementor-type="wp-page" data-elementor-id="100" class="elementor elementor-100">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-e52485b elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                    data-id="e52485b" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c511688"
                            data-id="c511688" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-f75cd75 elementor-widget elementor-widget-Elementor-events-widget"
                                    data-id="f75cd75" data-element_type="widget"
                                    data-widget_type="Elementor-events-widget.default">
                                    <div class="elementor-widget-container"> <!-- event-area -->
                                        <section class="event pt-120 pb-90 p-relative fix">
                                            <div class="animations-06"><img decoding="async"
                                                    src="{{ asset('frontend/wp-content/uploads/2023/03/an-img-06.png') }}"
                                                    alt="an-img-06.png">
                                            </div>
                                            <div class="animations-07"><img decoding="async"
                                                    src="{{ asset('frontend/wp-content/uploads/2023/03/an-img-07.png') }}"
                                                    alt="an-img-07.png">
                                            </div>
                                            <div class="animations-08"><img decoding="async"
                                                    src="{{ asset('frontend/wp-content/uploads/2023/03/an-img-08.png') }}"
                                                    alt="an-img-08.png">
                                            </div>
                                            <div class="animations-09"><img decoding="async"
                                                    src="{{ asset('frontend/wp-content/uploads/2023/03/an-img-09.png') }}"
                                                    alt="an-img-09.png">
                                            </div>
                                            <div class="container">
                                                <div class="row">
                                                    @foreach ($eventos as $eve)
                                                        <div class="col-lg-4 col-md-6  wow fadeInUp animated"
                                                            data-animation="fadeInUp" data-delay=".4s">
                                                            <div class="event-item mb-30 hover-zoomin">
                                                                <div class="thumb">
                                                                    <a href="{{ route('eventoDetalle', $eve->eve_id) }}">
                                                                        <img fetchpriority="high" decoding="async"
                                                                            width="1180" height="787"
                                                                            src="{{ asset('storage/evento/' . $eve->eve_banner) }}"
                                                                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                            alt="" />
                                                                    </a>
                                                                </div>
                                                                <div class="event-content">
                                                                    <div class="date">
                                                                        <strong>{{ Carbon::parse($eve->eve_fecha)->translatedFormat('d') }}</strong>
                                                                        {{ Carbon::parse($eve->eve_fecha)->translatedFormat('F, Y') }}
                                                                    </div>
                                                                    <h3>
                                                                        <a
                                                                            href="{{ route('eventoDetalle', $eve->eve_id) }}">
                                                                            {{ $eve->eve_nombre }}
                                                                        </a>
                                                                    </h3>
                                                                    <p>
                                                                        {!! Str::words($eve->eve_descripcion, 20, '...') !!}
                                                                    </p>
                                                                    <div class="time">
                                                                        {{ Carbon::parse($eve->eve_fecha)->translatedFormat('d F, Y') }}
                                                                        <i class="fal fa-long-arrow-right"></i>
                                                                        <strong>{{ $eve->tipoEvento->et_nombre }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </section> <!-- courses-area -->
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
