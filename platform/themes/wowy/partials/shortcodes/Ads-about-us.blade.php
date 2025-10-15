<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
    style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">


    <div class=" p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                            class="d-inline-flex py-1 px-2 ">{{ __('Who We Are') }}</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">{{ __('About Us') }}</h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class=" text-decoration-none text-white">{{ __('Home') }}</a></li>
                        <li class="active  opacity-7">{{ __('About Us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>


<style>
    @media only screen and (max-width: 600px) {
        .image_resized {
            width: 100% !important;
            padding-left: inherit !important;
            padding-right: inherit !important;
        }

        .iconspace {
            margin-top: 0px !important;
        }

        .widthsize {
            width: 100% !important;
        }
    }

    h1,
    h2,
    h3 {
        font-size: 25px;
        line-height: 28px;
        margin: 0 0 0px 0;
        font-weight: 500;
        text-transform: capitalize;
    }
</style>
