<style>
    a:hover {
    color: #046CAC;
}
    </style>
<div class="page-header py-0 bg-tertiary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2"
                src="{{ asset('themes/wowy/ads/img/demos/accounting-1/svg/waves.svg') }}" alt="waves">
        </div>
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col" style="text-align:center;">
                <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                    data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="animation-delay: 0ms;">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">Our Solutions</span></span>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">Solutions
                    </h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class="text-light text-decoration-none">Home</a></li>
                        <li class="active text-color-light opacity-7">Solutions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {!! Theme::partial('shortcodes.Ads-home-icons') !!} --}}
<div class="container-fluid  pt-5" id="intro">
  
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                @if ($headertitle)
                <p class="pe-lg-5 ">{!! BaseHelper::clean($headertitle) !!}</p>
                    @endif
            </div>
        </div>
    </div>
</div>

<!-- Portfolio -->
<div class="bg-grey-100 my-5 px-3 px-xl-0 border-radius-2 p-relative overflow-hidden">
    <div class="container-fluid ">
        <div class="row py-5">
            <div class="col" style="padding-top: 2rem !important;">
                <div class="sort- sort-destination-loader-showing mt-4 pt-2">
                    <div class="row portfolio-list sort-destination overflow-visible">
                        @foreach ($solution as $solutions)
                        <div class="col-12 col-sm-6 col-lg-3 isotope-item accounting">
                            <div class="portfolio-item">
                                <div class="box-shadow-1 border-radius-2">
                                    <span
                                        class="thumb-info border-radius-2 bg-color-light thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                        <span class="thumb-info-content">
                                            <span class="thumb-info-content-inner bg-light p-4">
                                                <h4 class="mb-1">{{$solutions->name}}</h4>
                                                <p class="card-text text-3-5 mb-1">
                                                    {!! \Illuminate\Support\Str::limit($solutions->description, 80) !!}
                                                </p>
                                                <span
                                                    class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                    <a href="{{ $solutions->url }}" class="font-weight-semibold">
                                                        Read More 
                                                    </a>
                                                    <a href="{{$solutions->url}}"
                                                        class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7">
                                                        <span class="p-static bg-transparent transform-none">
                                                            <i class="fa-solid fa-arrow-right text-dark"></i>
                                                        </span>
                                                    </a>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<style>
    @media only screen and (max-width: 600px) {
    .iconspace {
        margin-top: 0px!important;
    }
}
@media screen and (min-device-width: 1367px) and (max-device-width: 1440px) {
    .mobile {
        padding-top: 3rem !important;
    }
}
</style>
