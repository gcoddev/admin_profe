<header class="header-area header-three">
    <!-- header -->
    <div class="header-top second-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 d-none d-lg-block">
                    <div class="header-social">
                        {{-- <span>
                            Síganos:-
                            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" title="LinkedIn"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-youtube"></i></a>
                        </span> --}}
                        <!--  /social media icon redux -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 d-none d-lg-block text-right">
                    <div class="header-cta">
                        <ul>
                            {{-- <li>
                                <div class="call-box">
                                    <div class="icon">
                                        <img src="{{ asset('frontend/wp-content/themes/qeducato/inc/assets/images/phone-call.png') }}"
                                            alt="https://wpdemo.zcubethemes.com/qeducato/wp-content/themes/qeducato/inc/assets/images/phone-call.png" />
                                    </div>
                                    <div class="text">
                                        <span>Call Now !</span>
                                        <strong><a href="tel:+917052101786">+91 7052 101 786</a></strong>
                                    </div>
                                </div>
                            </li> --}}
                            <li>
                                <div class="call-box">
                                    <div class="icon">
                                        <img src="{{ asset('frontend/wp-content/themes/qeducato/inc/assets/images/mailing.png') }}"
                                            alt="mailing" />
                                    </div>
                                    <div class="text">
                                        <span>Correo</span>
                                        <strong><a href="mailto:info@example.com">
                                                profe@iipp.edu.bo
                                            </a></strong>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-3">
                    <div class="logo">
                        <!-- LOGO IMAGE -->
                        <!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 268 x 60 pixels) -->
                        <a href="{{ route('home') }}" class="navbar-brand logo-black">
                            <!-- Logo Standard -->
                            <img src="{{ asset('assets/profe/logoprofe.jpg') }}" alt="PROFE" title=""
                                width="70%" />
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="main-menu text-right text-xl-right">
                        <nav id="mobile-menu">
                            <div id="cssmenu" class="menu-main-menu-container">
                                <ul id="menu-main-menu" class="menu d-flex">
                                    <li id="menu-item-113"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-9 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-113">
                                        <a href="{{ route('home') }}" aria-current="page">Inicio</a>
                                        {{-- <ul class="sub-menu">
                                            <li id="menu-item-112"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-9 current_page_item menu-item-112">
                                                <a href="index.html" aria-current="page">Home Page 01</a>
                                            </li>
                                            <li id="menu-item-115"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-115">
                                                <a href="home-page-02/index.html">Home Page 02</a>
                                            </li>
                                            <li id="menu-item-114"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-114">
                                                <a href="home-page-03/index.html">Home Page 03</a>
                                            </li>
                                        </ul> --}}
                                    </li>
                                    {{-- <li id="menu-item-114"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-114">
                                        <a href="about-us/index.html">Sobre nosotros</a>
                                    </li> --}}
                                    <li id="menu-item-115"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-115">
                                        <a href="{{ route('programa') }}">Programas</a>
                                        {{-- <ul class="sub-menu">
                                            <li id="menu-item-2866"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2866">
                                                <a href="our-courses/index.html">Our Courses</a>
                                            </li>
                                            <li id="menu-item-2865"
                                                class="menu-item menu-item-type-post_type menu-item-object-kidscourses menu-item-2865">
                                                <a href="kidscourses/langue-class/index.html">Course Details</a>
                                            </li>
                                        </ul> --}}
                                    </li>
                                    <li id="menu-item-116"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-116">
                                        <a href="{{ route('comunicado') }}">Comunicados</a>
                                        {{-- <ul class="sub-menu">
                                            <li id="menu-item-123"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-123">
                                                <a href="our-event/index.html">Event</a>
                                            </li>
                                            <li id="menu-item-122"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-122">
                                                <a href="our-gallery/index.html">Gallery</a>
                                            </li>
                                            <li id="menu-item-119"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                                                <a href="pricing/index.html">Pricing</a>
                                            </li>
                                            <li id="menu-item-120"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-120">
                                                <a href="faq/index.html">Faq</a>
                                            </li>
                                            <li id="menu-item-121"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121">
                                                <a href="teacher/index.html">Teacher</a>
                                            </li>
                                        </ul> --}}
                                    </li>
                                    <li id="menu-item-117"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-117">
                                        <a href="{{ route('blog') }}">Blogs</a>
                                    </li>
                                    <li id="menu-item-118"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-118">
                                        <a href="{{ route('evento') }}">Eventos</a>
                                    </li>
                                    <li id="menu-item-119"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                                        {{-- <a href="contact/index.html">Contact</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 text-right d-none d-lg-block text-right text-xl-right">
                    <div class="login">
                        <ul>

                            <li>
                                <div class="second-header-btn">
                                    <a href="{{ route('admin.login') }}" class="btn">ACCEDER</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>
