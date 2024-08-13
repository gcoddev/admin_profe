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
                            <h2>{{ $blog->blog_titulo }}</h2>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-wrap2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- breadcrumb-area-end -->
    <div class="inner-blog b-details-p pt-120 pb-120 blog-deatails-box02">
        <div class="container">
            <div class="row"> <!-- .blog -->
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="blog-deatails-box single">
                        <article id="post-2695"
                            class="post-2695 post type-post status-publish format-standard has-post-thumbnail hentry category-high-school tag-design tag-development tag-web-design">
                            <div class="bsingle__post mb-50">
                                <div class="bsingle__post-thumb">
                                    <a href="index.html">
                                        <img fetchpriority="high" width="1109" height="752"
                                            src="{{ asset('storage/blog/' . $blog->blog_imagen) }}"
                                            class="attachment-qeducato-featured-large size-qeducato-featured-large wp-post-image"
                                            alt="Planting Seeds in the Hearts of Preschooler" decoding="async" />
                                    </a>
                                </div>
                                <div class="bsingle__content">
                                    <div class="meta-info">
                                        <ul>
                                            <li><i class="far fa-user"></i> By admin</li>
                                            <li><i class="fal fa-calendar-alt"></i>
                                                {{ Carbon::parse($blog->created_at)->translatedFormat('F d, Y') }}</li>
                                            <li><i class="far fa-comments"></i> No Comments</li>
                                        </ul>
                                    </div>
                                    <h2 class="single">{{ $blog->blog_titulo }}</h2>
                                    <div>
                                        {!! $blog->blog_descripcion !!}
                                    </div>
                                    {{-- <div class="two-column mb-25">
                                        <div class="row">
                                            <div class="image-column col-xl-6 col-lg-12 col-md-6">
                                                <div class="image">
                                                    <img decoding="async" src="protfolio-img01.jpg"
                                                        alt="protfolio-img01.jpg">
                                                </div>
                                            </div>
                                            <div class="text-column col-xl-6 col-lg-12 col-md-6">
                                                <div class="image">
                                                    <img decoding="async" src="protfolio-img02.jpg"
                                                        alt="protfolio-img02.jpg">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <blockquote>
                                        <footer>By Rosalina Pong</footer>
                                        <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic
                                            polaroid pug pitchfork post-ironic.</h3>
                                    </blockquote> --}}
                                    <p></p>
                                    {{-- <div class="details__content-img"><img decoding="async"
                                            src="../wp-content/uploads/2023/03/b_details01.jpg"
                                            alt="https://wpdemo.zcubethemes.com/qeducato/wp-content/uploads/2023/03/b_details01.jpg">
                                    </div> --}}
                                    <p></p>
                                    {{-- <div class="two-column">
                                        <div class="row">
                                            <div class="image-column col-xl-4 col-lg-4 col-md-4">
                                                <div class="image"> <img decoding="async"
                                                        src="../wp-content/uploads/2023/03/b_details02.jpg"
                                                        alt="https://wpdemo.zcubethemes.com/qeducato/wp-content/uploads/2023/03/b_details02.jpg">
                                                </div>
                                            </div>
                                            <div class="text-column col-xl-8 col-lg-8 col-md-8">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna ali qua. Ut
                                                    enim ad minim veniam, quis nostrud exercitation ulla mco laboris
                                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                    nulla pariatur. Excepteur sint occaecat cupida tat non proident,
                                                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                    quae ab illo inventore veritatis et quasi architecto beatae
                                                    vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </article><!-- #post-## -->
                        {{-- <div class="tags">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="post__tag">
                                        <h5>Post Tags</h5>
                                        <ul>
                                            <li><a href="../tag/design/index.html" rel="tag">Design</a></li>
                                            <li><a href="../tag/development/index.html" rel="tag">development</a>
                                            </li>
                                            <li><a href="../tag/web-design/index.html" rel="tag">web design</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.blog --> --}}
                        {{-- <div id="comments" class="comments-area  mt-45">
                            <div id="respond" class="comment-respond">
                                <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow"
                                            id="cancel-comment-reply-link" href="index.html#respond"
                                            style="display:none;">Cancel reply</a></small></h3>
                                <form action="https://wpdemo.zcubethemes.com/qeducato/wp-comments-post.php" method="post"
                                    id="commentform" class="comment-form" novalidate>
                                    <p class="comment-notes"><span id="email-notes">Your email address will not be
                                            published.</span> <span class="required-field-message">Required fields
                                            are marked <span class="required">*</span></span></p>
                                    <p class="comment-field"><i class="fas fa-user"></i><input id="author"
                                            placeholder="Your Name" name="author" type="text" /></p>
                                    <p class="comment-field"><i class="fas fa-envelope"></i><input id="email"
                                            placeholder="your-real-email@example.com" name="email" type="text" />
                                    </p>
                                    <p class="comment-field"><i class="fas fa-globe"></i><input id="url"
                                            name="url" placeholder="http://your-site-name.com" type="text" /></p>
                                    <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent"
                                            name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label
                                            for="wp-comment-cookies-consent">Save my name, email, and website in
                                            this browser for the next time I comment.</label></p>
                                    <p class="comment-form-comment"><label for="comment">Comment <span
                                                class="required">*</span></label>
                                        <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea>
                                    </p>
                                    <p class="form-submit"><input name="submit" type="submit" id="submit"
                                            class="submit" value="Post Comment" /> <input type='hidden'
                                            name='comment_post_ID' value='2695' id='comment_post_ID' /> <input
                                            type='hidden' name='comment_parent' id='comment_parent' value='0' />
                                    </p>
                                </form>
                            </div><!-- #respond -->
                        </div><!-- #comments --> --}}
                    </div>
                </div> <!-- #right side -->
                <div class="col-sm-12 col-md-12 col-lg-4">
                    @include('frontend.pages.blog.partials.sidebar')
                </div> <!-- #right side end -->
            </div>
        </div>
    </div>
@endsection
