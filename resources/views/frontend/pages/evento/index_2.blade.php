@extends('frontend.layouts.master')

@section('title')
    Prevención frente a riesgos de sismos y terremotos en instituciones educativas del SEP.
@endsection
@section('og-meta-tags')
    <meta property="og:locale" content="es_ES" />
    {{-- <meta property="og:type" content="article" /> --}}
    <meta property="og:title" content="Prevención frente a riesgos de sismos y terremotos en instituciones educativas del SEP." />
    <meta property="og:description" content="Formulario de preinscripción." />
    <meta property="og:image" content="https://profe.minedu.gob.bo/assets/evento/12082024_afiche2.jpg" />
    {{-- <meta property="og:url" content="{{ url()->current() }}" /> --}}
    <meta property="og:image:type" content="image/jpeg" />
@endsection
@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style id="qeducato_data-dynamic-css" title="dynamic-css" class="redux-options-output">
        body,
        .widget_categories a {
            color: #6e6e6e;
        }
    
        .site-content {
            background-color: #ffffff;
        }
    
        .breadcrumb-area {
            background-color: rgba(32, 40, 46, 0.8); /* Fondo con un poco de transparencia */
            background-image: url('{{ asset('assets/evento/12082024_banner.jpg') }}');
            background-blend-mode: overlay; /* Mezcla el color de fondo y la imagen */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Añade sombra */
        }
    
        .footer-bg {
            background-color: #00173c;
            background-image: url('{{ asset('frontend/wp-content/uploads/2023/03/footer-bg.png') }}');
        }
    
        .footer-social a:hover,
        .contact-form .btn,
        .about-area .btn:hover::before,
        .bsingle__content .blog__btn .btn,
        .s-about-content .footer-social a:hover,
        .project-detail .project-info li .btn,
        .testimonial-active2 .slick-dots .slick-active button,
        .slider-content h2 span::after,
        .home-blog-active .slick-arrow,
        .home-blog-active2 .slick-arrow,
        .button-group button.active,
        .breadcrumb,
        .f-widget-title h2::before,
        .footer-widget .widgettitle::before,
        .copyright-wrap,
        .f-contact i,
        .cta-area .btn,
        .event-content .date,
        .blog-thumb2 .date-home,
        .step-box .date-box,
        .about-content2 li .ano,
        .class-active .slick-arrow,
        .courses-content .cat,
        .about-text,
        .services-box07:hover,
        .services-box07.active,
        .second-header::before,
        .second-header-btn .btn,
        .slider-content h5::after,
        .slider-active .slider-btn .btn,
        .post__tag ul li a:hover,
        .services-categories li a::after,
        .brochures-box .inner,
        .home-blog-active .slick-arrow:hover,
        .home-blog-active2 .slick-arrow:hover,
        .portfolio .col3 .grid-item .box a::after,
        .comment-form .submit,
        #scrollUp,
        .search-form .search-submit,
        .wp-block-search .wp-block-search__button,
        .top-btn,
        .widget-social a:hover,
        .comment-form .submit:hover,
        .services-08-item:hover .readmore,
        #scrollUp:hover,
        .gallery-image figcaption .span::before,
        .team-thumb .dropdown .xbtn,
        .blog-content2 .date-home,
        .f-cta-icon i,
        .contact-bg02 .btn.ss-btn.active {
            background-color: #ff7350;
        }
    
        .event03 .event-content .time i,
        .faq-wrap .card-header h2 button::after,
        .bsingle__content h2:hover a,
        .testimonial-active2 .ta-info span,
        .services-box a:hover,
        .main-menu ul li:hover>a,
        .main-menu ul li a::after,
        .project-detail .project-info li .icon,
        .main-menu ul li:hover>a,
        .cta-title h2 span,
        .recent-blog-footer span,
        .b-meta i,
        .section-title h5,
        .event-content .time strong,
        .courses-content a.readmore,
        .about-title h5,
        .header-cta ul li i,
        blockquote footer,
        .pricing-body li::before,
        .pricing-box2.active .price-count h2,
        .pricing-box2.active .pricing-head h2,
        .header-three .main-menu .sub-menu li a:hover,
        .menu .children li a:hover,
        .footer-link ul li a:hover,
        .comment-text .avatar-name span,
        .team-area-content span,
        .team-area-content li .icon i,
        .header-social a,
        a:hover,
        .services-08-thumb.glyph-icon i,
        .gallery-image figcaption .span,
        .team-info span,
        .team-info h4 a:hover,
        .single-team:hover .team-info h4,
        .testimonial-active .slick-arrow,
        .blog-btn a,
        .bsingle__post .video-p .video-i,
        .bsingle__content .meta-info ul li i,
        .about-content li .icon i {
            color: #ff7350;
        }
    
        .slider-active .slider-btn .btn,
        .contact-form .btn,
        .faq-btn,
        .about-area .btn:hover,
        .menu .sub-menu,
        .menu .children,
        .second-header-btn .btn,
        .cta-area .btn,
        .slider-active .slider-btn .btn,
        .post__tag ul li a:hover,
        .pricing-box2.active,
        .menu .children,
        .sidebar-widget .widgettitle,
        .tag-cloud-link:hover,
        .widget-social a:hover,
        .services-08-item:hover .readmore,
        .team-info .text,
        .blog-btn a,
        .contact-bg02 .btn.ss-btn.active {
            border-color: #ff7350;
        }
    
        .btn.ss-btn.active,
        .second-header a,
        .second-header span,
        .comment-form .submit,
        .search-form .search-submit,
        .wp-block-search .wp-block-search__button,
        .team-thumb .dropdown .xbtn,
        #scrollUp,
        .cta-title h2,
        .footer-widget .widgettitle,
        .footer-widget .cat-item,
        .footer-widget .widget ul li,
        .copyright-wrap .text,
        .f-cta-icon i,
        .btn-style-one {
            color: #fff;
        }
    
        .event-item:hover .event-content,
        .header-three .second-header,
        .project-detail .info-column .inner-column2 h3,
        .btn:hover::before,
        .conterdown,
        .s-about-content .footer-social a,
        .about-area .btn {
            background-color: #125875;
        }
    
            {
            color: #125875;
        }
    
        .about-area .btn,
        .second-header-btn .btn:hover {
            border-color: #125875;
        }
    
        .blog-area3 .blog-thumb2 .date-home {
            background-color: #4ea9b4;
        }
    
            {
            color: #4ea9b4;
        }
    
            {
            border-color: #4ea9b4;
        }
    
        .copyright-wrap .text,
        .btn-style-one {
            background-color: #232323;
        }
    
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #232323;
        }
    </style>
    <style>
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .form-title {
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('frontend-content')
    <div id="content" class="site-content"> <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex p-relative align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-left">
                            <div class="breadcrumb-title">
                                <h2>Prevención frente a riesgos de sismos y terremotos en instituciones educativas del SEP.</h2>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Desarrollo emocional en la primera
                                    infancia</li>
                            </ol>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </section> <!-- breadcrumb-area-end --><!-- Project Detail -->
        <section>

            <div class="lower-content2">
                <div class="form-container">
                    <h2 class="form-title">Formulario de preinscripción</h2>
                    
                    <form action="{{ route('evento.storeParticipantes') }}" method="POST" enctype="multipart/form-data" id="inscripcionForm">
                        @csrf
                        <div class="form-group">
                            <label for="eve_ins_carnet_identidad">Número de cédula de identidad</label>
                            <input type="text" class="form-control" name="eve_ins_carnet_identidad" id="eve_ins_carnet_identidad" autofocus required
                            pattern="[0-9]{4,10}" title="Debe tener entre 4 y 10 dígitos." />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_carnet_complemento">Complemento</label>
                            <input type="text" class="form-control" name="eve_ins_carnet_complemento" id="eve_ins_carnet_complemento"
                                maxlength="3" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_nombre_1">Nombres</label>
                            <input type="text" class="form-control" name="eve_ins_nombre_1" id="eve_ins_nombre_1" required
                                onkeyup="mayusculas(this);" maxlength="38" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_apellido_1">Apellido paterno</label>
                            <input type="text" class="form-control" name="eve_ins_apellido_1" id="eve_ins_apellido_1"
                                onkeyup="mayusculas(this);" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_apellido_2">Apellido materno</label>
                            <input type="text" class="form-control" name="eve_ins_apellido_2" id="eve_ins_apellido_2"
                                onkeyup="mayusculas(this);" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="eve_ins_fecha_nacimiento" id="eve_ins_fecha_nacimiento" min="1950-01-01" max="2010-12-31"/>
                            <div id="error-message" style="color: red; display: none;">La fecha de nacimiento debe estar entre 1950 y 2010.</div>
                        </div>
                        <div class="form-group">
                            <label for="gen_id">Sexo</label>
                            <select class="form-control" name="gen_id" id="gen_id" required>
                                <option value="">Seleccione el sexo</option>
                                @foreach ($generos as $gen)
                                <option value="{{ encrypt($gen->gen_id) }}">{{ $gen->gen_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eve_celular">Celular</label>
                            <input type="text" class="form-control" name="eve_celular" id="eve_celular" required
                                   pattern="[67][0-9]{7}" title="El número debe comenzar con 6 o 7 y tener 8 dígitos." />
                        </div>
                        <div class="form-group">
                            <label for="eve_correo">Correo electronico</label>
                            <input type="email" class="form-control" name="eve_correo" id="eve_correo" required
                                onkeyup="minusculas(this);" maxlength="40" />
                        </div>
                        <div class="form-group">
                            <label for="dep_id">En que departamento reside</label>
                            <select class="form-control" name="dep_id" id="dep_id" required>
                                <option value="">Seleccione</option>
                                @foreach ($departamentos as $dep)
                                <option value="{{ encrypt($dep->dep_id) }}">{{ $dep->dep_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pm_id">Modalidad de asistencia</label>
                            <select class="form-control" name="pm_id" id="pm_id" required">
                                <option value="">Seleccione</option>
                                {{-- @if (count($participante) <= 500) --}}
                                {{-- <option value="1">Presencial</option> --}}
                                {{-- @endif --}}
                                <option value="3">Virtual</option>
                                {{-- <option value="1">Presencial</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="eve_id" id="eve_id" value="3">
                            {{-- <input type="hidden" name="en_id" id="en_id" value="{{ encrypt(1) }}"> --}}
                            {{-- <input type="hidden" name="ei_autorizacion" id="ei_autorizacion" value="0"> --}}
                        </div>
                        <button type="submit" class="btn submit-btn">Enviar</button>
                    </form>
                </div>
            </div>
        </section> <!--End Project Detail -->
    </div><!-- #content -->
@endsection

@section('scripts')
    <script>
        // function showPresencialAlert(select) {
        //     const alertDiv = document.getElementById('virtual-alert');
        //     if (select.value == "3") {
        //         alertDiv.style.display = 'block';
        //     } else {
        //         alertDiv.style.display = 'none';
        //     }
        // }
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }
    </script>
    <script>
        document.getElementById('eve_ins_fecha_nacimiento').addEventListener('change', function() {
            const minDate = new Date('1950-01-01');
            const maxDate = new Date('2010-12-31');
            const selectedDate = new Date(this.value);
            const errorMessage = document.getElementById('error-message');

            if (selectedDate < minDate || selectedDate > maxDate) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
@endsection
