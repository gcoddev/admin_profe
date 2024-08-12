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
                            <h2>{{ $programa->pro_nombre }}</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Programa</li>
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
                    <div class="text-column col-lg-9 col-md-9 col-sm-12">
                        <div class="upper-box">
                            <div class="single-item-carousel owl-carousel owl-theme">
                                <figure class="image">
                                    <img fetchpriority="high" width="1213" height="800"
                                        src="{{ asset('storage/programa_banners/' . $programa->pro_banner) }}"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        decoding="async" />
                                </figure>
                            </div>
                        </div>
                        <div class="inner-column">
                            {{-- <div class="course-meta2 review style2 clearfix mb-30">
                                <ul class="left">
                                    <li>
                                        <div class="author">
                                            <div class="thumb"> <img
                                                    src="../../wp-content/uploads/2023/02/testi_avatar.png"
                                                    alt="https://wpdemo.zcubethemes.com/qeducato/wp-content/uploads/2023/02/testi_avatar.png">
                                            </div>
                                            <div class="text"> <span> Robto Jone </span>
                                                <p> Teacher</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="categories">
                                        <div class="author">
                                            <div class="text"> <span> Language Class </span>
                                                <p> Language</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="right">
                                    <li class="price"> $49.00</li>
                                </ul>
                            </div> --}}
                            <div>
                                {!! $programa->pro_contenido !!}
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
                    </div>
                    <div class="col-lg-3">
                        <aside class="sidebar-widget info-column">
                            <div class="inner-column3">
                                <h3> Detalle</h3>
                                <ul class="project-info clearfix">
                                    <li>
                                        <div class="priceing"> <strong> Bs {{ $programa->pro_costo }} </strong>
                                            {{-- <sub> $129.00 </sub>
                                            <span class="discont"> 55% OFF </span> --}}
                                        </div>
                                    </li>
                                    <li> <span class="icon fal fa-calendar-alt"></span> <strong>Inscripcion:</strong>
                                        <span class="class-size">
                                            Del
                                            {{ Carbon::parse($programa->pro_fecha_inicio_inscripcion)->translatedFormat('d') }}
                                            de
                                            {{ Carbon::parse($programa->pro_fecha_inicio_inscripcion)->translatedFormat('F') }}
                                            al
                                            {{ Carbon::parse($programa->pro_fecha_fin_inscripcion)->translatedFormat('d') }}
                                            de
                                            {{ Carbon::parse($programa->pro_fecha_fin_inscripcion)->translatedFormat('F') }}
                                            de
                                            {{ Carbon::parse($programa->pro_fecha_fin_inscripcion)->translatedFormat('Y') }}
                                        </span>
                                    </li>
                                    <li> <span class="icon fal fa-book"></span> <strong>Carga horaria:</strong>
                                        <span>{{ $programa->pro_carga_horaria }} hrs.</span>
                                    </li>
                                    <li> <span class="icon fal fa-clock"></span> <strong>Tiempo: </strong>
                                        <span>
                                            {{ $programa->duracion->pd_semana == 1 ? '1 semana' : $programa->duracion->pd_semana . ' semanas' }}
                                            <br>
                                            {{ $programa->pro_horario }}
                                        </span>
                                    </li>
                                    <li> <span class="icon fal fa-user"></span> <strong>Inscritos: </strong> <span>20
                                            students</span></li>
                                    <li> <span class="icon fal fa-users"></span> <strong>Versión: </strong>
                                        <span>{{ $programa->version->pv_nombre }}
                                            ({{ $programa->version->pv_numero }})</span>
                                    </li>
                                    <li> <span class="icon fal fa-users"></span> <strong>Tipo: </strong>
                                        <span>{{ $programa->tipo->pro_tip_nombre }}</span></li>
                                    <li> <span class="icon fal fa-globe"></span> <strong>Modalidad: </strong>
                                        <span>{{ $programa->modalidad->pm_nombre }}</span>
                                    </li>
                                    <li>
                                        <div class="slider-btn"> <a href="../../contact/index.html"
                                                class="btn ss-btn smoth-scroll"> Enroll <i
                                                    class="fal fa-long-arrow-right"></i> </a></div>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--End Project Detail -->
@endsection
