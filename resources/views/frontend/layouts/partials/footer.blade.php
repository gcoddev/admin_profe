<!-- footer area start-->
<footer class="footer-bg footer-p pt-90">
    <div class="footer-top pb-70 p-relative">
        <!-- Lines -->
        <div class="content-lines-wrapper2">
            <div class="content-lines-inner2">
                <div class="content-lines2"></div>
            </div>
        </div>
        <!-- Lines -->
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-4 col-sm-6 redux-footer">
                    <ul class="footer-widget weight mb-30">
                        <li id="custom_html-1" class="widget_text widget widget_custom_html">
                            <h2 class="widgettitle">Sobre nosotros</h2>
                            <div class="textwidget custom-html-widget">
                                <div class="f-contact">
                                    <p>
                                        Suspendisse non sem ante. Cras pretium gravida leo a
                                        convallis. Nam malesuada interdum metus, sit amet dictum
                                        ante congue eu. Maecenas ut maximus enim.
                                    </p>
                                </div>
                                <div class="footer-social mt-10">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6 redux-footer">
                    <ul class="footer-widget f-menu-content footer-link mb-30">
                        <li id="nav_menu-1" class="widget widget_nav_menu">
                            <h2 class="widgettitle">Nuestros enlaces</h2>
                            <div class="menu-our-links-container">
                                <ul id="menu-our-links-1" class="menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-9 current_page_item menu-item-2837">
                                        <a href="{{ route('home') }}" aria-current="page">Inicio</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2839">
                                        <a href="about-us/index.html">Sobre nosotros</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2841">
                                        <a href="our-courses/index.html">Programas</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2841">
                                        <a href="our-courses/index.html">Comunicados</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2838">
                                        <a href="blog/index.html">Blogs</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2840">
                                        <a href="contact/index.html">Eventos</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6 redux-footer">
                    <ul class="footer-widget f-menu-content footer-link mb-30">
                        <li id="custom_html-6" class="widget_text widget widget_custom_html">
                            <h2 class="widgettitle">Última publicación</h2>
                            <div class="textwidget custom-html-widget">
                                <div class="recent-blog-footer">
                                    <ul>
                                        {{-- @if (count($blogs) > 0)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($blogs as $blog)
                                                @if ($i < 2)
                                                    <li>
                                                        <div class="thum">
                                                            <a href="indexbc60.html?p=2513">
                                                                <img src="{{ asset('frontend/wp-content/uploads/2023/03/s-blogimg-01.png') }}"
                                                                    alt="img" />
                                                            </a>
                                                        </div>
                                                        <div class="text">
                                                            <a href="indexbc60.html?p=2513">Nothing impossble to need
                                                                hard
                                                                work</a>
                                                            <span>7 March, 2023</span>
                                                        </div>
                                                    </li>
                                                @endif
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <div class="text">
                                                Aun no hay publicaciones
                                            </div>
                                        @endif --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6 redux-footer">
                    <ul class="footer-widget weight footer-link mb-30">
                        <li id="custom_html-2" class="widget_text widget widget_custom_html">
                            <h2 class="widgettitle">Contáctenos</h2>
                            <div class="textwidget custom-html-widget">
                                <div class="f-contact">
                                    <ul>
                                        <li>
                                            <i class="icon fal fa-phone"></i>
                                            <span><a href="tel:+14440008888">+1 (444) 000-8888</a><br /><a
                                                    href="tel:+917052101786">+91 7052 101 786</a></span>
                                        </li>
                                        <li>
                                            <i class="icon fal fa-envelope"></i>
                                            <span>
                                                <a href="mailto:info@example.com">info@example.com</a>
                                                <br />
                                                <a href="mailto:help@example.com">help@example.com</a>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="icon fal fa-map-marker-check"></i>
                                            <span>1247/Plot No. 39, 15th Phase,<br />
                                                LHB Colony, Kanpur</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="copy-text">
                        <a href="index.html">
                            <img src="{{ asset('assets/profe/logoprofe.jpg') }}" alt="Qeducato" title="" /></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center"></div>
                <div class="col-lg-4 text-right text-xl-right">
                    Copyright © Profe 2024. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end-->
