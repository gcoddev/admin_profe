<section
    class="elementor-section elementor-top-section elementor-element elementor-element-2e73797 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
    data-id="2e73797" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
    style="background-color:#EFF7FF">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-66779f8"
            data-id="66779f8" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-72d6814 elementor-widget elementor-widget-Elementor-about-widget"
                    data-id="72d6814" data-element_type="widget" data-widget_type="Elementor-about-widget.default">
                    <div class="elementor-widget-container"> <!-- about-area -->
                        <section class="about-area about-p pt-120 pb-120 p-relative fix">
                            <div class="animations-02"><img decoding="async"
                                    src="{{ asset('frontend/wp-content/uploads/2023/02/an-img-02.png') }}"
                                    alt="an-img-02.png">
                            </div>
                            <div class="container">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="s-about-img p-relative  wow fadeInLeft animated"
                                            data-animation="fadeInLeft" data-delay=".4s">
                                            @if ($profe->profe_afiche)
                                                <img decoding="async"
                                                    src="{{ asset('storage/profe/' . $profe->profe_afiche) }}"
                                                    alt="Afiche" width="450">
                                            @else
                                                <img decoding="async" src="{{ asset('assets/minedu.jpg') }}"
                                                    alt="Afiche" width="450">
                                            @endif
                                            <div class="about-text second-about"> <span>25
                                                    <sub>+</sub></span>
                                                <p>Years of Experience</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="about-content s-about-content pl-15 wow fadeInRight  animated"
                                            data-animation="fadeInRight" data-delay=".4s">
                                            <div class="about-title second-title pb-25">
                                                <h5><i class="fal fa-graduation-cap"></i> Acerca de nosotros</h5>
                                                <h2>Sobre nosotros</h2>
                                            </div>
                                            <p class="txt-clr">
                                                {!! $profe->profe_sobre_nosotros !!}
                                            </p>
                                            <div class="about-content2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul class="green2">
                                                            <li>
                                                                <div class="abcontent">
                                                                    <div class="ano"><span>01</span>
                                                                    </div>
                                                                    <div class="text">
                                                                        <h3>Misión</h3>
                                                                        <div>
                                                                            {!! $profe->profe_mision !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="abcontent">
                                                                    <div class="ano"><span>02</span>
                                                                    </div>
                                                                    <div class="text">
                                                                        <h3>Visión</h3>
                                                                        <div>
                                                                            {!! $profe->profe_vision !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-btn mt-20"> <a href="about-us/index.html"
                                                    class="btn ss-btn smoth-scroll">Leer mas <i
                                                        class="fal fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> <!-- about-area-end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
