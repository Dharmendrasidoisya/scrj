<!-- Our Services -->
<div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">
    <div class="custom-el-3 custom-pos-6 opacity-1">
        <img class="img-fluid opacity-5" src="img/demos/accounting-1/svg/waves-2.svg" alt="waves-2">
    </div>
    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center py-5">
            <div class="col py-4">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="text-align: center;">
                    <span
                        class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
                            class="d-inline-flex py-1 px-2">Our Products</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200"
                    style="text-align: center;">
                    <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light">Our Incredible
                        Products</h2>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                    style="text-align: center;">
                    <p class="pe-lg-5 text-light opacity-7">Serving an impressive list of long-term clients with
                        experience and expertise in multiple industries.</p>
                </div>

                <div class="pt-2 pb-4">
                    <div class="row">
                        @foreach ($categories as $category)
                        
                        <div class="col-lg-3 mb-4 pb-1">
                            <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                    <span
                                        class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content border-radius-0 rounded-top">
                                        <a href="pvc-window-door-machinery/1">
                                            <img src="{{ RvMedia::getImageUrl($category->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $category->name }}"
                                                loading="lazy" class="img-fluid" alt="PVC Window Door Machinery">
                                        </a>
                                    </span>
                                    <span class="thumb-info-content">
                                        <span class="thumb-info-content-inner bg-light p-4">
                                            <h4 class="text-5 mb-2">{{ $category->name }}</h4>
                                            {{-- <p>{{ $category->name }}</p> --}}
                                            <span class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                <a href="pvc-window-door-machinery/1"
                                                    class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">View
                                                    Details</a>
                                                <a href="pvc-window-door-machinery/1"
                                                    class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7"><span
                                                        class="p-static bg-transparent transform-none"><i
                                                            class="fa-solid fa-arrow-right text-dark"></i></span></a>
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        @endforeach
                      
                    </div>

                </div>

                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                    <p class="mb-0 text-light d-flex justify-content-center">
                        <img src="img/demos/accounting-1/icons/icon-5.svg" width="30" alt="icon-5" data-icon
                            data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light me-2'}" />
                        24/7 Availability - Round-the-clock support for all your needs, anytime.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <section class="popular-categories bg-grey-9 section-padding-60" id="featured-product-categories">
    <div class="container wow fadeIn animated">
        <h3 class="section-title mb-30">{{ $title }}</h3>

        <div class="carousel-6-columns-cover position-relative">
            <div class="slider-arrow slider-arrow-2 carousel-6-columns-arrow" id="carousel-6-columns-categories-arrows"></div>
            <div class="carousel-slider-wrapper carousel-6-columns" id="carousel-6-columns-categories" data-slick="{{ json_encode([
                'autoplay' => $shortcode->is_autoplay == 'yes',
                'infinite' => $shortcode->infinite == 'yes' || $shortcode->is_infinite == 'yes',
                'autoplaySpeed' => (int)(in_array($shortcode->autoplay_speed, theme_get_autoplay_speed_options()) ? $shortcode->autoplay_speed : 3000),
                'speed' => 800,
            ]) }}">
                @foreach ($categories as $category)
                    <div class="card-1 border-radius-10 hover-up p-20">
                        <figure class="mb-30 img-hover-scale overflow-hidden">
                            <a href="{{ $category->url }}"><img src="{{ RvMedia::getImageUrl($category->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $category->name }}" /></a>
                        </figure>
                        <h5><a href="{{ $category->url }}">{{ $category->name }}</a></h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> --}}
