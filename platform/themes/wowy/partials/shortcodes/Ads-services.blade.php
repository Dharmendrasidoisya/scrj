
<!-- Our Services -->


<div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">

    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center projectsmallscreen">

            <div class="container-fluid p-relative z-index-1">
                <div class="row align-items-center ">
                    <div class="col py-4 sizeproject">
                        <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                            data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                            style="animation-delay: 0ms;">
                            <span
                                class="badge bg-gradient-tertiary-dark text-dark rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
                                    class="d-inline-flex py-1 px-2">Our Projects</span></span>
                        </div>
                        <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
                            data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200"
                            style="animation-delay: 200ms;">
                            <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-dark bottomprojectlb"
                                style="font-weight: 500 !important;">
                                Projects</h2>
							
                        </div>

                        <div class="row">

                        @php
                            use Illuminate\Support\Str;

                            function limit_html_words($html, $wordLimit = 140)
                            {
                                $dom = new \DOMDocument();
                                libxml_use_internal_errors(true);
                                $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
                                libxml_clear_errors();

                                $body = $dom->getElementsByTagName('body')->item(0);

                                $wordCount = 0;
                                $limitReached = false;

                                $walker = function ($node) use (&$walker, $wordLimit, &$wordCount, &$limitReached) {
                                    if ($limitReached) {
                                        return null;
                                    }

                                    if ($node->nodeType === XML_TEXT_NODE) {
                                        $words = preg_split('/\s+/', $node->nodeValue, -1, PREG_SPLIT_NO_EMPTY);
                                        if ($wordCount + count($words) > $wordLimit) {
                                            $remaining = $wordLimit - $wordCount;
                                            $node->nodeValue = implode(' ', array_slice($words, 0, $remaining)) . '...';
                                            $limitReached = true;
                                        } else {
                                            $wordCount += count($words);
                                        }
                                    }

                                    if ($node->hasChildNodes()) {
                                        foreach (iterator_to_array($node->childNodes) as $child) {
                                            $walker($child);
                                        }
                                    }

                                    return $node;
                                };

                                $walker($body);

                                $innerHTML = '';
                                foreach ($body->childNodes as $child) {
                                    $innerHTML .= $dom->saveHTML($child);
                                }

                                return $innerHTML;
                            }
                        @endphp

                        @foreach ($services as $service)
                            <div class="col-lg-6 mb-5 mb-lg-0 bottomsection">
								   <h3 class="text-9 text-lg-6 font-weight-semibold line-height-1 mb-2 text-dark bottomprojectlb"
                                style="font-weight: 500 !important;    text-transform: none;">
                                Introducing AeroVista: A Residential Enclave in Dholera</h3>
                                <div class="lblp">
                                 {!! limit_html_words($service->content, 280) !!}
                                </div>
								
                            </div>
                        @endforeach


                                @foreach ($services as $service)

                                    <div class="col-lg-6 mb-5 mb-lg-0 width">
                                        <div class="appear-animation" data-appear-animation="fadeIn"
                                            data-appear-animation-delay="400">

                                            {{-- <img class="img-fluid border-radius-2 lbweare smallhomeheight"
                                    src="{{ RvMedia::getImageUrl($service->image) }}" alt="generic-14"> --}}
                                            <a href="{{ $service->url }}">
                                                <img class="default-img img-fluid img-fluid border-radius-2 lbweare smallhomeheight"
                                                    src="{{ RvMedia::getImageUrl($service->image) }}"
                                                    alt="Smart Home Speaker (Digital)">

                                            </a>
                                        </div>

                                    </div>
                                @endforeach
                        </div>





                        {{-- <div class="pt-2 pb-4">
                            <div class="carousel-half-full-width-wrapper carousel-half-full-width-right">
                                <div class="owl-carousel owl-theme carousel-half-full-width-right nav-bottom nav-bottom-align-left nav-lg nav-transparent nav-borders-light nav-arrow-light rounded-nav mb-2 owl-loaded owl-drag owl-carousel-init"
                                    data-plugin-options="{'responsive': {'0': {'items': 1}, '768': {'items': 3}, '992': {'items': 3}, '1200': {'items': 3}}, 'loop': true, 'nav': true, 'dots': false, 'autoplay': false, 'margin': 20}"
                                    style="width: auto; height: auto;">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage"
                                            style="transform: translate3d(-1803px, 0px, 0px); transition: 0.25s; width: 5410px;">

                                            @foreach ($services as $service)
                                                <div class="owl-item" style="width: 340.6px;  margin-right: 20px;">
                                                    <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                                        <span
                                                            class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                                            <span
                                                                class="thumb-info-wrapper overlay-gradient-bottom-content border-radius-0 rounded-top">
                                                                <a href="{{ $service->url }}">
                                                                    <img class="default-img img-fluid"
                                                                        src="{{ RvMedia::getImageUrl($service->image) }}"
                                                                        alt="Smart Home Speaker (Digital)">

                                                                </a>
                                                            </span>
                                                            <span class="thumb-info-content">
                                                                <span class="thumb-info-content-inner bg-light p-4"
                                                                    style="height: 182px!important;">
                                                                    <h4 class="text-4 mb-2">{{ $service->name }}
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
																{!! html_limit($service->content, 50) !!}
															</p>
                                                                    <span
                                                                        class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                                        <a href="{{ $service->url }}"
                                                                            class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">Read
                                                                            More</a>
                                                                        <a href="{{ $service->url }}"
                                                                            class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7">
                                                                            <span
                                                                                class="p-static bg-transparent transform-none"><i
                                                                                    class="fa-solid fa-arrow-right text-dark"></i></span>
                                                                        </a>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="owl-nav disabled"><button type="button" role="presentation"
                                            class="owl-prev"></button><button type="button" role="presentation"
                                            class="owl-next"></button></div>
                                    <div class="owl-dots disabled"></div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>


            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                style="display:none;">
                <p class="mb-0 text-dark d-flex">

                    {{ __('24/7 Availability - Round-the-clock support for all your investing needs, anytime.') }}
                </p>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid  pb-5   paddingleftright" style="padding-top: 3rem!important;">
    <div class="row">
        <div class="col-lg-6">
            <!-- First Row -->
            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                <div>
                    <img class="img-fluid border-radius-2 lbweare smallheight" src="{{ asset('themes/wowy/ads/img/home/amenity.png') }}" alt="generic-14">
                </div>
            </div>
        </div>
        @php
            $headerMessages = json_decode(theme_option('header_messages'), true);
            $thirdLink = null;
            $linkCount = 0;

            if (!empty($headerMessages) && is_array($headerMessages)) {
                foreach ($headerMessages as $message) {
                    if (is_array($message)) {
                        foreach ($message as $field) {
                            if (isset($field['key']) && $field['key'] === 'link' && !empty($field['value'])) {
                                $linkCount++;
                                if ($linkCount === 3) {
                                    $thirdLink = $field['value'];
                                    break 2; // Stop both loops once the second link is found
                                }
                            }
                        }
                    }
                }
            }
        @endphp
        <div class="col-lg-6 mobiletopsection">
            <!-- First Row -->

            <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
                data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200"
                style="animation-delay: 200ms;">

                <span
                    class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
                        class="d-inline-flex py-1 px-2">Amenities</span></span>
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">

                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/park.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ASME NB Stamp">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                    2 Landscaping Garden
                                </a>
                            </h4>
                        </div>


                    </div>
                </div>

                <!-- Repeat 3 more for 4 in the row -->
                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">

                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/transmission-tower.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ASME R Stamp">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                 Electricity
                                </a>
                            </h4>
                        </div>

                    </div>
                </div>

                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">

                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/security.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ASME U Stamp">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;color: #000 !important;">
                                 24 Hrs.Security
                                </a>
                            </h4>
                        </div>

                    </div>
                </div>

                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/road-with-broken-line.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ASME U2 Stamp">
                            </a>
                            <h4 class="line-height-5 positive-ls-3 text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                  Internal Rcc Road
                                </a>
                            </h4>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>

            <!-- Second Row -->
            <div class="col-12 d-flex flex-wrap">
                <!-- Repeat 4 more items for second row -->
                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/faucet.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="bureau veritas">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                      Water Supply
                                </a>
                            </h4>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>

                <!-- Repeat 3 more -->
                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/gate.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ISO 45001 2018">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="#"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                   Entrance Gate
                                </a>
                            </h4>

                        </div>
                        {{-- @endif --}}
                    </div>
                </div>

                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/wall.png"   class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ISO 14001 2015">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                              Compound Wall
                                </a>
                            </h4>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>

                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/street-light.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ISO 45001 2018">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                    Street Lights
                                </a>
                            </h4>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="col-6 col-lg-3 px-lg-3 mb-3">
                    <div class="featured-box-primary">
                        {{-- @if ($thirdLink) --}}
                        <div class="box-content text-center">
                            <a href="{{ $thirdLink }}">
                                <img src="themes/wowy/ads/images/home/leisure.png"  class="resize-img" 
                                    onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                    style="width: 70px;height: 70px;" alt="ISO 45001 2018">
                            </a>
                            <h4 class="line-height-5 positive-ls-3  text-color-primary mb-2 sizesmallfaq">
                                <a href="{{ $thirdLink }}"
                                    style="letter-spacing: 0.2px !important;    color: #000 !important;">
                                  Senior Citizen Area
                                </a>
                            </h4>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
                
            </div>
        </div>


    </div>
</div>




<script>
    function bigImg(x) {
        x.style.height = "100px";
        x.style.width = "100px";
    }

    function normalImg(x) {
        x.style.height = "70px";
        x.style.width = "70px";
    }
</script>
<style>
@media screen and (min-width: 1365px) and (max-width: 1450px) {
    .resize-img {
        height: 50px !important;
        width: 50px !important;
    }
}
</style>
