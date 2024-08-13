@php
    use Carbon\Carbon;
@endphp

<section
    class="elementor-section elementor-top-section elementor-element elementor-element-53259b7 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
    data-id="53259b7" data-element_type="section">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3f4f056"
            data-id="3f4f056" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-b644f74 elementor-widget elementor-widget-Elementor-events-widget"
                    data-id="b644f74" data-element_type="widget" data-widget_type="Elementor-events-widget.default">
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
                                    <div class="col-lg-12 p-relative">
                                        <div class="section-title center-align mb-50 text-center wow fadeInDown animated"
                                            data-animation="fadeInDown" data-delay=".4s">
                                            <h5><i class="fal fa-graduation-cap"></i> Nuestros eventos
                                            </h5>
                                            <h2> Eventos recientes</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (count($eventos) > 0)
                                        @foreach ($eventos as $eve)
                                            <div class="col-lg-4 col-md-6  wow fadeInUp animated"
                                                data-animation="fadeInUp" data-delay=".4s">
                                                <div class="event-item mb-30 hover-zoomin">
                                                    <div class="thumb"> <a
                                                            href="events/basic-ui-ux-design-for-new-development/index.html"><img
                                                                loading="lazy" decoding="async" width="1180"
                                                                height="787"
                                                                src="{{ asset('storage/evento_banners/' . $eve->eve_banner) }}"
                                                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                alt="" /></a></div>
                                                    <div class="event-content">
                                                        <div class="date">
                                                            <strong>{{ Carbon::parse($eve->eve_fecha)->translatedFormat('d') }}</strong>
                                                            {{ Carbon::parse($eve->eve_fecha)->translatedFormat('F, Y') }}
                                                        </div>
                                                        <h3>
                                                            <a
                                                                href="events/basic-ui-ux-design-for-new-development/index.html">{{ $eve->eve_nombre }}</a>
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
                                    @else
                                        <h4>
                                            No hay eventos
                                        </h4>
                                    @endif
                                </div>
                            </div>
                        </section> <!-- courses-area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
