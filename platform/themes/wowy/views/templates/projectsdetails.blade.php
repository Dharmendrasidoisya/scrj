{{-- @php
    $layout = MetaBox::getMetaData($post, 'layout', true);
    $layout =
        $layout && in_array($layout, array_keys(get_post_single_layouts())) ? $layout : 'post-right-sidebar';
    Theme::layout($layout);

    Theme::asset()->usePath()->add('lightGallery-css', 'plugins/lightGallery/css/lightgallery.min.css');
    Theme::asset()
        ->container('footer')
        ->usePath()
        ->add('lightGallery-js', 'plugins/lightGallery/js/lightgallery.min.js', ['jquery']);
@endphp --}}

{{-- dharmendra --}}
<div class="owl-carousel owl-theme"
    data-plugin-options="{'items': 1, 'autoplay': true, 'dots': false, 'autoplayTimeout': 5000, 'margin': 10, 'animateOut': 'fadeOut', 'nav': true, 'navText': ['<i class=\'fas fa-chevron-left\'></i>', '<i class=\'fas fa-chevron-right\'></i>']}">

    {{-- Image 1 --}}
    <div class="position-relative text-center mobileproject" >
        <img src="{{ asset('themes/wowy/ads/images/home/2.png') }}" class="img-fluid w-100 h-100 object-fit-cover mobileproject" 
            alt="Project Image 1" loading="lazy" style="position: absolute; top: 0; left: 0; z-index: 1;">

        {{-- Overlay Text --}}
        <div class="position-absolute top-50 start-50 translate-middle text-white z-index-2 px-3">
            <span
                class="badge bg-color-dark-rgba-30 rounded-pill text-uppercase font-weight-semibold text-2-5 px-4 py-2 mb-3 d-inline-block">
                Our Projects
            </span>
            <h1 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2" style="color: #fff;">
                {{ $post->name }}
            </h1>
            <ul class="breadcrumb d-flex justify-content-center text-3-5 font-weight-semi-bold mb-0">
                <li>
                    <a href="{{ BaseHelper::getHomepageUrl() }}" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="active text-white opacity-75 mx-2">{{ $post->name }}</li>
            </ul>
        </div>
    </div>

    {{-- Image 2 --}}
    <div class="position-relative text-center mobileproject" >
        <img src="{{ asset('themes/wowy/ads/images/home/3.png') }}"
            class="img-fluid w-100 h-100 object-fit-cover mobileproject" alt="Project Image 2" loading="lazy"
            style="position: absolute; top: 0; left: 0; z-index: 1;">

        {{-- Same Overlay Text --}}
        <div class="position-absolute top-50 start-50 translate-middle text-white z-index-2 px-3">
            <span
                class="badge bg-color-dark-rgba-30 rounded-pill text-uppercase font-weight-semibold text-2-5 px-4 py-2 mb-3 d-inline-block">
                Our Projects
            </span>
            <h1 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2" style="color: #fff;">
                {{ $post->name }}
            </h1>
            <ul class="breadcrumb d-flex justify-content-center text-3-5 font-weight-semi-bold mb-0">
                <li>
                    <a href="{{ BaseHelper::getHomepageUrl() }}" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="active text-white opacity-75 mx-2">{{ $post->name }}</li>
            </ul>
        </div>
    </div>

    {{-- Image 3 --}}
    <div class="position-relative text-center mobileproject" >
        <img src="{{ asset('themes/wowy/ads/images/home/4.png') }}"
            class="img-fluid w-100 h-100 object-fit-cover mobileproject" alt="Project Image 3" loading="lazy"
            style="position: absolute; top: 0; left: 0; z-index: 1;">

        {{-- Same Overlay Text --}}
        <div class="position-absolute top-50 start-50 translate-middle text-white z-index-2 px-3">
            <span
                class="badge bg-color-dark-rgba-30 rounded-pill text-uppercase font-weight-semibold text-2-5 px-4 py-2 mb-3 d-inline-block">
                Our Projects
            </span>
            <h1 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2" style="color: #fff;">
                {{ $post->name }}
            </h1>
            <ul class="breadcrumb d-flex justify-content-center text-3-5 font-weight-semi-bold mb-0">
                <li>
                    <a href="{{ BaseHelper::getHomepageUrl() }}" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="active text-white opacity-75 mx-2">{{ $post->name }}</li>
            </ul>
        </div>
    </div>

</div>




{{-- <div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
    style="background-image:url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;height: 850px;">

    <div class="container-fluid p-relative z-index-1 py-2 ">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                    data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="animation-delay: 0ms;">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                            class="d-inline-flex py-1 px-2">Our Projects</span></span>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">
                        {{ $post->name }}</h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class="text-dark text-decoration-none text-color-light">Home</a></li>

                        <li class="active text-color-light opacity-7">{{ $post->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid pb-30 pt-30 pt-lg-5  border-bottom-color-grey-100">
    <div class="row align-items-start">

        @php
            $cleanContent = str_replace('&nbsp;', ' ', $post->content);
            $allowedTags = '<strong><b><i><u><em><br><a>';
            $safeHtml = strip_tags($cleanContent, $allowedTags);
            $textOnly = strip_tags($safeHtml);
            $words = explode(' ', $textOnly);

            preg_match_all('/\S+|\s+/', $safeHtml, $allParts);
            $allParts = $allParts[0];

            // Desktop 165 words
            $first165 = implode('', array_slice($allParts, 0, 180 * 2));
            $rest165 = implode('', array_slice($allParts, 180 * 2));

            // Tablet 140 words
            $first140 = implode('', array_slice($allParts, 0, 100 * 2));
            $rest140 = implode('', array_slice($allParts, 100 * 2));

            // Mobile 50 words
            $first50 = implode('', array_slice($allParts, 0, 50 * 2));
            $rest50 = implode('', array_slice($allParts, 50 * 2));
        @endphp

        <style>
            .mobileproject{
                height: 850px; 
                overflow: hidden;
            }
            .size {
                font-size: 18px !important;
            }

            .desktop-version,
            .tablet-version,
            .mobile-version {
                display: none;
            }

            .desktop-version {
                display: block;
            }

            @media only screen and (max-width: 600px) {
                .mobileproject{
                        height: 280 !important;
                       width: 342px !important;
                }
                .mobilevideo{
                    height: auto!important;
                }
                .pb-30 {
                    padding-bottom: 0px !important;
                    padding-top: 2rem;
                }

                .desktop-version {
                    display: none;
                }

                .mobile-version {
                    display: block;
                }

                .productdeatils {
                    width: 100% !important;
                    height: auto !important;
                }

                .mobiletoplb {
                    margin-top: 2rem !important;
                }
            }

            .productdeatils {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            .content-side {
                text-align: justify;
            }

            .content-below {
                margin-top: 20px;
                text-align: justify;
            }

            @media screen and (min-width: 1450px) {
                .desktop-version {
                    display: block;
                }
            }

            @media screen and (min-width: 1367px) and (max-width: 1449px) {
                .tablet-version {
                    display: block;
                }
            }
        </style>

        <!-- Image Column -->


        <!-- Description Column -->

        <div class="col-lg-6 col-md-12">
            <h2 class="vcex-heading vcex-module wpex-text-2xl wpex-font-normal wpex-m-auto wpex-max-w-100 vcex-heading-plain wpex-block wpex-mb-20 vc_custom_1623214167090"
                style="font-size:22px;font-weight:600;"><span
                    class="vcex-heading-inner wpex-inline-block wpex-clr">Overview</span></h2>
            {!! $post->content !!}
        </div>
        <div class="col-lg-6 col-md-12 topmobile">
            <h2 class="vcex-heading vcex-module wpex-text-2xl wpex-font-normal wpex-m-auto wpex-max-w-100 vcex-heading-plain wpex-block wpex-mb-20 vc_custom_1623214167090"
                style="font-size:22px;font-weight:600;">
                <span class="vcex-heading-inner wpex-inline-block wpex-clr">Photo Gallery</span>
            </h2>

            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                <div class="owl-carousel owl-theme"
                    data-plugin-options="{'items': 1, 'autoplay': true, 'dots': false, 'autoplayTimeout': 5000, 'margin': 10, 'animateOut': 'fadeOut', 'nav': true, 'navText': ['<i class=\'fas fa-chevron-left\'></i>', '<i class=\'fas fa-chevron-right\'></i>']}">

                    @php
                        $galleryImages = is_array($post->images) ? $post->images : json_decode($post->images, true);
                    @endphp

                    @if (!empty($galleryImages) && count($galleryImages) > 0)
                        @foreach ($galleryImages as $image)
                            <div>
                                <img src="{{ RvMedia::getImageUrl($image) }}"
                                    class="img-fluid height thumb-info border-radius-2 img rounded-top heightimg"
                                    alt="Project Image" loading="lazy" style="">
                            </div>
                        @endforeach
                    @else
                        <div>
                            <img src="{{ Theme::asset()->url('/wowy/no_image.jpg') }}"
                                class="img-fluid height thumb-info border-radius-2 img rounded-top"
                                alt="No Image Available" loading="lazy" style="">
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid pb-30  border-bottom border-bottom-color-grey-100">
    <div class="row align-items-start">

        @php
            $cleanContent = str_replace('&nbsp;', ' ', $post->content);
            $allowedTags = '<strong><b><i><u><em><br><a>';
            $safeHtml = strip_tags($cleanContent, $allowedTags);
            $textOnly = strip_tags($safeHtml);
            $words = explode(' ', $textOnly);

            preg_match_all('/\S+|\s+/', $safeHtml, $allParts);
            $allParts = $allParts[0];

            // Desktop 165 words
            $first165 = implode('', array_slice($allParts, 0, 180 * 2));
            $rest165 = implode('', array_slice($allParts, 180 * 2));

            // Tablet 140 words
            $first140 = implode('', array_slice($allParts, 0, 100 * 2));
            $rest140 = implode('', array_slice($allParts, 100 * 2));

            // Mobile 50 words
            $first50 = implode('', array_slice($allParts, 0, 50 * 2));
            $rest50 = implode('', array_slice($allParts, 50 * 2));
        @endphp

        <style>
            .heightimg {
                width: 918px;

            }

            .vcex-heading {
                padding: 15px 22px 10px 20px;
                line-height: 1.5 !important;
            }

            .wpex-clr {
                font-weight: 600 !important;
            }

            .size {
                font-size: 18px !important;
            }

            .desktop-version,
            .tablet-version,
            .mobile-version {
                display: none;
            }

            .desktop-version {
                display: block;
            }

            @media only screen and (max-width: 600px) {
				 .iframwidth{
        width: auto!important;
        }
				 .size {
                font-size: 13px !important;
            }
                .brochuretop {
                    padding-bottom: 1rem !important;
                }

                .topmobile {
                    margin-top: 20px !important;
                }

                .vc_custom_1623214167090 {
                    margin-bottom: 15px !important;
                    padding-top: 10px !important;
                    padding-right: 10px !important;
                    padding-bottom: 0px !important;
                    padding-left: 20px !important;
                    background-color: #F4F4F4 !important;
                    border-radius: 3px !important;
                }

                .wpb_vc_table {
                    width: auto !important;
                }

                .table td {
                    display: table-cell !important;
                    text-align: center;
                    width: 100%;
                }

                figure {
                    width: auto !important;
                }

                .heightimg {
                    height: 280 !important;
                    width: 342px !important;
                }

                .pb-30 {
                    padding-bottom: 0px !important;
                    padding-top: 2rem;
                }

                .desktop-version {
                    display: none;
                }

                .mobile-version {
                    display: block;
                }

                .productdeatils {
                    width: 100% !important;
                    height: auto !important;
                }

                .mobiletoplb {
                    margin-top: 2rem !important;
                }
            }

            .productdeatils {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            .content-side {
                text-align: justify;
            }

            .content-below {
                margin-top: 20px;
                text-align: justify;
            }

            @media screen and (min-width: 1450px) {
                .desktop-version {
                    display: block;
                }
            }

            @media screen and (min-width: 1367px) and (max-width: 1449px) {
                .tablet-version {
                    display: block;
                }
            }
        </style>
        <!-- Image Column -->

        <!-- Description Column -->
        {{-- <div class="col-lg-6 col-md-12">
          
            {!! $post->specification !!}
        </div> --}}
        <div class="col-lg-6 col-md-12 brochuretop">
            @if ($post->pdf)
                <h2 class="vcex-heading vcex-module wpex-text-2xl wpex-font-normal wpex-m-auto wpex-max-w-100 vcex-heading-plain wpex-block wpex-mb-20 vc_custom_1623214167090"
                    style="font-size:22px;font-weight:600;">
                    <span class="vcex-heading-inner wpex-inline-block wpex-clr">Download Project Brochure</span>
                </h2>
                <a href="{{ RvMedia::getImageUrl($post->pdf) }}" target="_blank" style="font-size: 17px;">
                    <img src="{{ asset('themes/wowy/ads/img/pdf-file.png') }}" alt="PDF Icon"
                        style="width: 70px; height: 70px; vertical-align: middle; ">
                </a>
            @endif
        </div>
        {!! $post->specification !!}
		  {!! $post->location !!}
        {{-- <div class="container-fluid " style="padding-top: 0rem !important;">
            <div class="container-fluid bg-grey  " id="intro"
                style=" padding-top: 3rem !important;padding-bottom: 2rem;">

                <div class="row counters">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 text-center">
                        <div class="d-flex flex-column pt-2 pb-4 appear-animation animated fadeInUpShorter appear-animation-visible"
                            data-appear-animation="fadeInUpShorter" data-appear-animation-delay="0"
                            style="animation-delay: 0ms;">
                            <p class="d-inline-block mb-0 font-weight-bold line-height-1 counter"><mark
                                    class="text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-12 mark-height-30 n-ls-5 p-0"
                                    data-to="198000" data-append="+">1.98 Lakh</mark></p>
                            <span class="custom-font-tertiary text-6 text-dark n-ls-1 fst-italic pt-2">SQ Yards</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 text-center">
                        <div class="d-flex flex-column pt-2 pb-4 appear-animation animated fadeInUpShorter appear-animation-visible"
                            data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200"
                            style="animation-delay: 200ms;">
                            <p class="d-inline-block mb-0 font-weight-bold line-height-1 counter"><mark
                                    class="text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-12 mark-height-30 n-ls-5 p-0"
                                    data-to="1099">1099</mark></p>
                            <span class="custom-font-tertiary text-6 text-dark n-ls-1 fst-italic pt-2">Residential
                                Villa Plots</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 text-center">
                        <div class="d-flex flex-column pt-2 pb-4 appear-animation animated fadeInUpShorter appear-animation-visible"
                            data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                            style="animation-delay: 400ms;">
                            <p class="d-inline-block mb-0 font-weight-bold line-height-1 counter"><mark
                                    class="text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-12 mark-height-30 n-ls-5 p-0"
                                    data-to="19">19</mark></p>
                            <span class="custom-font-tertiary text-6 text-dark n-ls-1 fst-italic pt-2">Comman Plots For
                                Amenities</span>
                        </div>
                    </div>

                </div>

            </div>
        </div> --}}
    </div>
</div>
<style>
    .vc_custom_1623214167090 {
        margin-bottom: 30px;
        padding-top: 10px !important;
        padding-right: 10px !important;
        padding-bottom: 10px;
        padding-left: 20px !important;
        background-color: #F4F4F4 !important;
        border-radius: 3px !important;
    }
</style>
