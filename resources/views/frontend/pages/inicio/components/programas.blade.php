<section
    class="elementor-section elementor-top-section elementor-element elementor-element-64fd482 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
    data-id="64fd482" data-element_type="section">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-281d83f"
            data-id="281d83f" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-fa714b6 elementor-widget elementor-widget-Elementor-courses-widget"
                    data-id="fa714b6" data-element_type="widget" data-widget_type="Elementor-courses-widget.default">
                    <div class="elementor-widget-container"> <!-- courses-area -->
                        <section class="courses pt-120 pb-90 p-relative fix">
                            <div class="animations-01"><img decoding="async"
                                    src="{{ asset('frontend/wp-content/uploads/2023/02/an-img-03.png') }}"
                                    alt="an-img-03.png">
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 p-relative">
                                        <div class="section-title center-align mb-50 wow fadeInDown animated"
                                            data-animation="fadeInDown" data-delay=".4s">
                                            <h5>
                                                <i class="fal fa-graduation-cap"></i>
                                                Nuestros programas
                                            </h5>
                                            <h2> PROGRAMAS</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row class-active">
                                    @if (count($programas) > 0)
                                        @foreach ($programas as $pro)
                                            <div class="col-lg-4 col-md-6 ">
                                                <div class="courses-item mb-30 hover-zoomin">
                                                    <div class="thumb fix"> <a
                                                            href="{{ route('programa.show', $pro->pro_id) }}">
                                                            <img fetchpriority="high" decoding="async" width="1180"
                                                                height="664"
                                                                src="{{ asset('storage/programa_banners/' . $pro->pro_banner) }}"
                                                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                alt="" /> </a></div>
                                                    <div class="courses-content">
                                                        <div class="cat"><i class="fal fa-graduation-cap"></i>
                                                            {{ $pro->pro_nombre_abre }}</div>
                                                        <h3><a
                                                                href="{{ route('programa.show', $pro->pro_id) }}">{{ $pro->pro_nombre }}</a>
                                                        </h3>
                                                        <p>
                                                            {!! Str::words($pro->pro_contenido, 20, '...') !!}
                                                        </p>
                                                        <a href="{{ route('programa.show', $pro->pro_id) }}"
                                                            class="readmore">Leer
                                                            mas
                                                            <i class="fal fa-long-arrow-right"></i></a>
                                                    </div>
                                                    <div class="icon">
                                                        <img decoding="async"
                                                            src="{{ asset('frontend/wp-content/uploads/2023/02/cou-icon.png') }}"
                                                            alt="cou-icon">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h4>
                                            No hay programas
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
