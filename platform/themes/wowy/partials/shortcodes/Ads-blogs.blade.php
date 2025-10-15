<style>
    .bigscreenblog {
        padding: 13px !important;
    }

    @media screen and (min-device-width: 1100px) and (max-device-width: 1440px) {
        h4 {
            font-size: 1.3em !important;
        }
    }

    .ldesign {
        width: 100% !important;
        padding-right: 15px;
    }

    @media screen and (max-width: 600px) {
        .ldesign {
            width: 100% !important;
        }

        .blogsmobile {
            padding-bottom: 0rem !important;
        }
    }
</style>
<section class="section-padding-10">
    <div class="container-fuild px-lg-5 blogsmobile" style="padding-bottom: 3rem;">
        <div class="col-12">



            <h2 class="text-resp-150 ws-nowrap font-weight-semi-bold text-overflow-center text-color-grey-100 n-ls-5"
                style="    margin: 0px 0 -21px 0;">
                Blogs</h2>
            <div class="post-list mb-4 mb-lg-0">
                <div class="owl-carousel owl-theme">
                    @foreach ($posts as $post)
                        <div class="ldesign">
                            <article class="post">
                                <div
                                    class="card rounded-3 border-0 bg-transparent box-shadow-10 box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                                    <div class="p-relative rounded-3 overflow-hidden">
                                        <div class="post-date p-absolute top-20 left-20">
                                            <span class="day py-1 text-4 font-weight-bold text-secondary">
                                                {{ \Carbon\Carbon::parse($post->updated_at)->format('d') }}
                                            </span>
                                            <span class="month bg-secondary">
                                                {{ \Carbon\Carbon::parse($post->updated_at)->format('M') }}
                                            </span>
                                        </div>

                                        <a href="{{ $post->url }}" class="text-decoration-none">
                                            <img class="card-img-top" src="{{ RvMedia::getImageUrl($post->image) }}"
                                                style="height: 280px;" alt="{{ $post->name }}" loading="lazy">
                                        </a>
                                        <div class="card-body bg-light p-4 bigscreenblog">
                                            <h4 class="my-2">
                                                <a href="{{ $post->url }}"
                                                    class="text-decoration-none text-dark text-color-hover-primary">
                                                    {{ \Illuminate\Support\Str::limit($post->name, 38) }}
                                                </a>
                                            </h4>

                                            @if (!function_exists('html_limit'))
                                                @php
                                                    function html_limit($html, $maxLength = 50)
                                                    {
                                                        $content = strip_tags($html);
                                                        $limited = \Illuminate\Support\Str::limit($content, $maxLength);
                                                        return $limited;
                                                    }
                                                @endphp
                                            @endif
                                            <p class="lblp">
                                                {!! html_limit($post->content, 50) !!}
                                            </p>
                                            {{-- <p class="card-text text-3-5 mb-1">
                                                {{ \Illuminate\Support\Str::limit($post->description, 90) }}
                                            </p> --}}
                                            <a href="{{ $post->url }}"
                                                class="read-more text-color-secondary font-weight-semibold text-2">
                                                Read More <i
                                                    class="fas fa-angle-right position-relative top-1 ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</section>




<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true, // Infinite loop scrolling
            margin: 20, // Space between items
            nav: true, // Show left/right arrows
            dots: false, // Hide dots
            autoplay: false, // Enable auto-scroll
            autoplayTimeout: 3000, // Auto-scroll every 3 seconds
            autoplayHoverPause: true, // Pause on hover
            responsive: {
                0: {
                    items: 1
                }, // 1 item in mobile view
                576: {
                    items: 2
                }, // 2 items in small screens
                768: {
                    items: 3
                }, // 3 items in tablets
                992: {
                    items: 4
                } // 4 items in larger screens
            }
        });
    });
</script>
