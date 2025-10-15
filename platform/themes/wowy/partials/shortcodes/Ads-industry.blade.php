<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2" src="{{asset('themes/wowy/ads/img/demos/accounting-1/svg/waves.svg')}}" alt="waves">
        </div>
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">Industry</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">Industry Info
                    </h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}" class="text-light text-decoration-none">Home</a></li>
                        <li class="active text-color-light opacity-7">Industry Info</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::partial('shortcodes.Ads-home-icons') !!}
<div class="container-fluid pt-lg-5" id="intro">
    <div class="row align-items-center">
        <div class="col-lg-12 mb-12 mb-lg-0">
            <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
                data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                style="animation-delay: 400ms;">
                @if ($description)
                    <p>{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>

        </div>

    </div>
</div>
