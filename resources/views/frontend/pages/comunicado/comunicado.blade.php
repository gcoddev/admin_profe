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
                            <h2>{{ $comunicado->comun_nombre }}</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comunicado</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- breadcrumb-area-end --><!-- Project Detail -->
    <section class="project-detail">
        <div class="container"> <!-- Lower Content -->
            <div class="lower-content">
                <div class="row">
                    <div class="text-column col-lg-12 col-md-9 col-sm-12">
                        <div class="upper-box">
                            <div class="single-item-carousel owl-carousel owl-theme">
                                <figure class="image">
                                    <img fetchpriority="high" width="1213" height="800"
                                        src="{{ asset('storage/comunicado/' . $comunicado->comun_imagen) }}"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        decoding="async" />
                                </figure>
                            </div>
                        </div>
                        <div class="inner-column">
                            <div class="course-meta2 review style2 clearfix mb-30">
                                <ul class="left">
                                    <li class="categories">
                                        <div class="author">
                                            <div class="text"> <span> {{ $comunicado->updated_at }} </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="right">
                                    <li class="price"> {{ $comunicado->comun_importancia }}</li>
                                </ul>
                            </div>
                            <div>
                                {!! $comunicado->comun_descripcion !!}
                            </div>
                            {{-- <ul class="pr-ul">
                                <li>
                                    <div class="icon"><i class="fal fa-check"></i></div>
                                    <div class="text">Crawl accessibility so engines can read your website</div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fal fa-check"></i></div>
                                    <div class="text">Share-worthy content that earns links, citations</div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fal fa-check"></i></div>
                                    <div class="text">Keyword optimized to attract searchers &#038; engines</div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fal fa-check"></i></div>
                                    <div class="text">Title, URL, &#038; description to draw high CTR</div>
                                </li>
                            </ul> --}}
                            {{-- <h4>Study Options:</h4>
                            <table class="table table-bordered mb-40">
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>Length</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bsc (Hons)</td>
                                        <td>3 years full time</td>
                                        <td>CDX3</td>
                                    </tr>
                                    <tr>
                                        <td>Bsc</td>
                                        <td>4 years full time</td>
                                        <td>CDX4</td>
                                    </tr>
                                </tbody>
                            </table> --}}
                            {{-- <h3>Frequently Asked Question</h3>
                            <p>A business or organization established to provide a particular service, typically one
                                that involves a organizing transactions.Lorem ipsum is simply free text used by
                                copytyping refreshing. Neque porro est qui dolorem enim var sed efficitur turpis
                                gilla sed sit amet finibus eros. Lorem Ipsum is simply dummy text of the printing..
                            </p> --}}
                            {{-- <div class="faq-wrap pt-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0"><button class="faq-btn" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree">01
                                                    Cras turpis felis, elementum sed mi at arcu ?</button></h2>
                                        </div>
                                        <div id="collapseThree" class="collapse show" data-bs-parent="#accordionExample">
                                            <div class="card-body">Our community is being called to reimagine the
                                                future. As the only university where a renowned design school comes
                                                together with premier colleges, we are making learning more relevant
                                                and transformational. We are enriched by the wide range.</div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0"><button class="faq-btn collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne">02
                                                    Vestibulum nibh risus, in neque eleifendulputate sem ?</button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-bs-parent="#accordionExample">
                                            <div class="card-body">Our community is being called to reimagine the
                                                future. As the only university where a renowned design school comes
                                                together with premier colleges, we are making learning more relevant
                                                and transformational. We are enriched by the wide range.</div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0"><button class="faq-btn collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo">03 Donec
                                                    maximus, sapien id auctor ornare ?</button></h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordionExample">
                                            <div class="card-body">Our community is being called to reimagine the
                                                future. As the only university where a renowned design school comes
                                                together with premier colleges, we are making learning more relevant
                                                and transformational. We are enriched by the wide range.</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="upper-box">
                            <div class="single-item-carousel owl-carousel owl-theme d-flex justify-content-center">
                                <a href="{{ asset('storage/programa_afiches/' . $comunicado->pro_afiche) }}"
                                    target="_blank">
                                    <img fetchpriority="high" width="500" height="1200"
                                        src="{{ asset('storage/programa_afiches/' . $comunicado->pro_afiche) }}"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        decoding="async" />
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section> <!--End Project Detail -->
@endsection
