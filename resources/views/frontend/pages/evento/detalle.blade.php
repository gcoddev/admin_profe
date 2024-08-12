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
                            <h2>{{ $evento->eve_nombre }}</h2>
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
    </section>
    <section class="project-detail">
        <div class="container">
            <div class="upper-box">
                <div class="single-item-carousel owl-carousel owl-theme">
                    <figure class="image">
                        <img fetchpriority="high" width="1180" height="787"
                            src="{{ asset('storage/evento/' . $evento->eve_banner) }}"
                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                            decoding="async" />
                    </figure>
                </div>
            </div> <!-- Lower Content -->
            <div class="lower-content2">
                <div class="row">
                    <div class="text-column col-lg-9 col-md-12 col-sm-12">
                        <div class="s-about-content wow fadeInRight" data-animation="fadeInRight" data-delay=".2s">
                            <br />
                            <h2>{{ $evento->eve_nombre }}</h2>
                            <div>
                                {!! $evento->eve_descripcion !!}
                            </div>
                            <div countdown class="conterdown wow fadeInDown animated" data-animation="fadeInDown animated"
                                data-delay=".2s" data-date="Jan 1 2024 00:00:00">
                                <div class="timer">
                                    <div class="timer-outer bdr1"> <span class="days" data-days>0</span></p>
                                        <div class="smalltext">Days</div>
                                        <div class="value-bar"></div>
                                    </div>
                                    <div class="timer-outer bdr2"> <span class="hours" data-hours>0</span></p>
                                        <div class="smalltext">Hours</div>
                                    </div>
                                    <div class="timer-outer bdr3"> <span class="minutes" data-minutes>0</span></p>
                                        <div class="smalltext">Minutes</div>
                                    </div>
                                    <div class="timer-outer bdr4"> <span class="seconds" data-seconds>0</span></p>
                                        <div class="smalltext">Seconds</div>
                                    </div>
                                    <p id="time-up">
                                </div>
                            </div>
                            <p></p>
                            <div class="two-column mt-30">
                                <div class="row aling-items-center">
                                    <div class="image-column col-xl-6 col-lg-12 col-md-12">
                                        <div class="footer-social mt-10">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-column col-xl-6 col-lg-12 col-md-12 text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-column col-lg-3 col-md-12 col-sm-12">
                        <div class="inner-column2">
                            <h3> Detalles</h3>
                            <ul class="project-info clearfix">
                                <li> <span class="icon fal fa-clock"></span> <strong>
                                        {{ Carbon::createFromFormat('H:i:s', $evento->eve_ins_hora_asis_habilitado)->format('H:i:s A') }}
                                        -
                                        {{ Carbon::createFromFormat('H:i:s', $evento->eve_ins_hora_asis_deshabilitado)->format('H:i:s A') }}
                                    </strong>
                                </li>
                                <li> <span class="icon fal fa-calendar-alt"></span>
                                    <strong>{{ Carbon::parse($evento->eve_fecha)->translatedFormat('d F, Y') }} </strong>
                                </li>
                                <li> <span class="icon fal fa-map-marker-check"></span> <strong>12/A, NewYork Sydney
                                        City</strong></li>
                                <li> <span class="icon fal fa-envelope"></span> <strong> yourmail@gmail.com</strong>
                                </li>
                                <li> <span class="icon fal fa-phone"></span> <strong>+91 705 2101 786</strong></li>
                                <li>
                                    <div class="slider-btn">
                                        <a href="{{ route('evento.show', $evento->eve_id) }}"
                                            class="btn ss-btn smoth-scroll">
                                            Inscribirme
                                            <i class="fal fa-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
