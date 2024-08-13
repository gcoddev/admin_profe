@php
    use Carbon\Carbon;
@endphp

<aside class="sidebar-widget">
    <section id="search-1" class="widget widget_search">
        <h2 class="widget-title">Buscar</h2>
        <form role="search" method="GET" class="search-form" action="{{ route('blog') }}">
            <label>
                <span class="screen-reader-text">Buscar para:</span>
                <input type="search" class="search-field" placeholder="Buscar &hellip;" value="{{ request('search') }}"
                    name="search" />
            </label>
            <input type="submit" class="search-submit" value="Buscar" />
        </form>
    </section>
    {{-- <section id="custom_html-4" class="widget_text widget widget_custom_html">
        <h2 class="widget-title">Siguenos</h2>
        <div class="textwidget custom-html-widget">
            <div class="textwidget custom-html-widget">
                <div class="widget-social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-wordpress"></i></a>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="recent-posts-widget-with-thumbnails-1" class="widget recent-posts-widget-with-thumbnails">
        <div id="rpwwt-recent-posts-widget-with-thumbnails-1" class="rpwwt-widget">
            <h2 class="widget-title">Blogs recientes</h2>
            <ul>
                @foreach ($recent as $r)
                    <li>
                        <a href="../planting-seeds-in-the-hearts-of-preschooler/index.html">
                            <img width="100" height="68" src="{{ asset('storage/blog/' . $r->blog_imagen) }}"
                                class="attachment-100x75 size-100x75 wp-post-image" alt="" decoding="async" />
                            <span class="rpwwt-post-title">
                                {{ $r->blog_titulo }}
                            </span>
                        </a>
                        <div class="rpwwt-post-date">{{ Carbon::parse($blog->created_at)->translatedFormat('F d, Y') }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div><!-- .rpwwt-widget -->
    </section>
    {{-- <section id="custom_html-5" class="widget_text widget widget_custom_html">
        <h2 class="widget-title">About Us</h2>
        <div class="textwidget custom-html-widget">
            <div class="sidebar-about-contnent text-center mt-35"> <img src="../wp-content/uploads/2023/03/team10.png"
                    alt="https://wpdemo.zcubethemes.com/qeducato/wp-content/uploads/2023/03/team10.png">
                <h5 class="title mt-20">Rosalina D. Willaimson</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore.</p>
            </div>
        </div>
    </section> --}}
    {{-- <section id="categories-1" class="widget widget_categories">
        <h2 class="widget-title">Categories</h2>
        <ul>
            <li class="cat-item cat-item-9"><a href="../category/branding/index.html">Branding</a> (3)
            </li>
            <li class="cat-item cat-item-7"><a href="../category/economics/index.html">Economics</a>
                (3)</li>
            <li class="cat-item cat-item-3"><a href="../category/finance/index.html">Finance</a>
                (4)</li>
            <li class="cat-item cat-item-20"><a href="../category/high-school/index.html">High
                    School</a> (6)</li>
            <li class="cat-item cat-item-18"><a href="../category/kids-blog/index.html">kids
                    blog</a> (3)</li>
            <li class="cat-item cat-item-16"><a href="../category/kids-event/index.html">Kids
                    Event</a> (4)</li>
            <li class="cat-item cat-item-6"><a href="../category/media/index.html">Media</a> (1)
            </li>
            <li class="cat-item cat-item-5"><a href="../category/public/index.html">Public</a>
                (1)</li>
            <li class="cat-item cat-item-21"><a href="../category/school-event/index.html">School
                    Event</a> (3)</li>
            <li class="cat-item cat-item-4"><a href="../category/sciences/index.html">Sciences</a> (1)
            </li>
            <li class="cat-item cat-item-17"><a href="../category/team/index.html">Team</a> (4)
            </li>
            <li class="cat-item cat-item-22"><a href="../category/team-two/index.html">Team
                    Two</a> (4)</li>
            <li class="cat-item cat-item-1"><a href="../category/uncategorized/index.html">Uncategorized</a> (13)</li>
        </ul>
    </section> --}}
    {{-- <section id="tag_cloud-1" class="widget widget_tag_cloud">
        <h2 class="widget-title">Tags</h2>
        <div class="tagcloud"><a href="../tag/app/index.html" class="tag-cloud-link tag-link-8 tag-link-position-1"
                style="font-size: 12.2pt;" aria-label="app (2 items)">app</a> <a href="../tag/design/index.html"
                class="tag-cloud-link tag-link-12 tag-link-position-2" style="font-size: 20.833333333333pt;"
                aria-label="Design (6 items)">Design</a>
            <a href="../tag/development/index.html" class="tag-cloud-link tag-link-19 tag-link-position-3"
                style="font-size: 15pt;" aria-label="development (3 items)">development</a> <a
                href="../tag/gallery/index.html" class="tag-cloud-link tag-link-10 tag-link-position-4"
                style="font-size: 12.2pt;" aria-label="gallery (2 items)">gallery</a> <a
                href="../tag/web-design/index.html" class="tag-cloud-link tag-link-11 tag-link-position-5"
                style="font-size: 22pt;" aria-label="web design (7 items)">web design</a> <a
                href="../tag/wordpress/index.html" class="tag-cloud-link tag-link-15 tag-link-position-6"
                style="font-size: 8pt;" aria-label="Wordpress (1 item)">Wordpress</a>
        </div>
    </section> --}}
</aside>
