<!-- Our Services -->
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2"
                src="{{ asset('themes/wowy/ads/img/demos/accounting-1/svg/waves.svg') }}" alt="waves">
        </div>
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">{{__('Who We Are')}}</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">{{__('Products')}}</h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class="text-light text-decoration-none">{{__('Home')}}</a></li>
                        <li class="active text-color-light opacity-7">{{__('Products')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" id="intro">
    <div class="row align-items-center">

        <div class="col-lg-12 py-lg-5 ps-lg-4">


            <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-4"
                style="-webkit-font-smoothing:antialiased;-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);box-sizing:border-box;color:var(--dark);font-family:Lexend, sans-serif;font-size:3.5em !important;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:600 !important;letter-spacing:-0.05em;line-height:1 !important;margin:0px 0px 1.5rem !important;orphans:2;text-align:center;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;">
                {{__('Efficiency, Accuracy, and Innovation in PVC Machining.')}}</h2>
            <p style="text-align:center;">{{__('Experience unmatched performance with PVC machining solutions, where efficiency, accuracy, and innovation come together. Our advanced machinery innovative technology that streamlines operations. Discover a new era of PVC processing. Ready to transform your PVC operations?  Explore Products That Move Your Business Forward.')}}</p>



        </div>
    </div>
</div>
<div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">

    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center py-5">
            <div class="col py-4">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="text-align: center;">
                    <span
                        class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4">
                        @if ($title)
                        <span class="d-inline-flex py-1 px-2">{!! BaseHelper::clean($title) !!}</span>
                            @endif</span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200"
                    style="text-align: center;">
                    @if ($headertitle)
                    <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light">{!! BaseHelper::clean($headertitle) !!}</h2>
                    @endif
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                    style="text-align: center;">
                    @if ($description)
                    <p class="pe-lg-5 text-light opacity-7">{!! BaseHelper::clean($description) !!}</p>
                        @endif
                </div>

                <div class="pt-2 pb-4">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-3 mb-4 pb-1">
                                <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                    <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                        <span
                                            class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content border-radius-0 rounded-top">
                                            <a href="{{ $category->url }}">
                                                <img src="{{ RvMedia::getImageUrl($category->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}"
                                                    alt="{{ $category->name }}" loading="lazy" class="img-fluid"
                                                    alt="PVC Window Door Machinery">
                                            </a>
                                        </span>
                                        <span class="thumb-info-content">
                                            <span class="thumb-info-content-inner bg-light p-4">
                                                <h4 class="text-5 mb-2">{{ $category->name }}</h4>
                                                {{-- <p>{{ $category->name }}</p> --}}
                                                <span
                                                    class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                    <a href="{{ $category->url }}"
                                                        class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">{{__('View Details')}}</a>
                                                    <a href="{{ $category->url }}"
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
                        {{__('24/7 Availability - Round-the-clock support for all your accounting needs, anytime.')}}
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
