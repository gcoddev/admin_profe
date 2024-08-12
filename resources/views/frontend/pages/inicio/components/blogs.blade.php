@php
    use Carbon\Carbon;
@endphp

<section
    class="elementor-section elementor-top-section elementor-element elementor-element-71a5cde elementor-section-full_width elementor-section-height-default elementor-section-height-default"
    data-id="71a5cde" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-26c1115"
            data-id="26c1115" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-a051e33 elementor-widget elementor-widget-Elementor-Widget-Blog"
                    data-id="a051e33" data-element_type="widget" data-widget_type="Elementor-Widget-Blog.default">
                    <div class="elementor-widget-container"> <!-- blog-area -->
                        <section id="blog" class="blog-area p-relative fix pt-120 pb-90">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="section-title center-align mb-50 text-center wow fadeInDown animated"
                                            data-animation="fadeInDown" data-delay=".4s">
                                            <h5><i class="fal fa-graduation-cap"></i> Nuestros blogs</h5>
                                            <h2> Ultimas publicaciones</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (count($blogs) > 0)
                                        @foreach ($blogs as $blog)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-post2 hover-zoomin mb-30 wow fadeInUp animated"
                                                    data-animation="fadeInUp" data-delay=".4s">
                                                    <div class="blog-thumb2"> <a
                                                            href="cras-accumsan-nulla-nec-lacus-ultricies-placerat/index.html"><img
                                                                loading="lazy" decoding="async" width="1109"
                                                                height="752"
                                                                src="{{ asset('frontend/wp-content/uploads/2022/01/inner_b1.jpg') }}"
                                                                class="attachment-qeducato-featured-large size-qeducato-featured-large wp-post-image"
                                                                alt="" /></a>
                                                        <div class="date-home">
                                                            <i class="fal fa-calendar-alt"></i>
                                                            {{ Carbon::parse($blog->created_at)->translatedFormat('F d, Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="blog-content2">
                                                        <div class="b-meta">
                                                            <div class="meta-info">
                                                                <ul>
                                                                    <li><i class="fal fa-user"></i> By admin
                                                                    </li>
                                                                    <li><i class="fal fa-comments"></i> No
                                                                        Comments</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a
                                                                href="cras-accumsan-nulla-nec-lacus-ultricies-placerat/index.html">Cras
                                                                accumsan nulla nec lacus ultricies
                                                                placerat.</a></h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna ali</p>
                                                        <div class="blog-btn"><a
                                                                href="cras-accumsan-nulla-nec-lacus-ultricies-placerat/index.html">Read
                                                                More <i class="fal fa-long-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h4>
                                            No hay blogs
                                        </h4>
                                    @endif

                                </div>
                            </div>
                        </section> <!-- blog-area-end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
