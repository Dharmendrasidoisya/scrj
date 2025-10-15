<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
     style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100 bredcome">
     
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                    data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="animation-delay: 0ms;">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 "><span
                            class="d-inline-flex py-1 px-2">Get In Touch</span></span>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">Contact Us
                    </h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}" class=" text-decoration-none text-color-light">Home</a></li>
                        <li class="active text-color-light opacity-7" >Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row pt-4">
    <div class="col">
        <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
            data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0" style="animation-delay: 0ms;">
            <span
                class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4">
                @if ($title)
                    <span class="d-inline-flex py-1 px-2">{!! BaseHelper::clean($title) !!}</span>
                @endif
            </span>
        </div>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
            data-appear-animation-delay="200" style="animation-delay: 200ms;">
            @if ($headertitle)
                <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2">{!! BaseHelper::clean($headertitle) !!}</h2>
            @endif
        </div>
    </div>
    <div class="col-lg-6 p-relative">
        <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
            data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">
            @if ($description)
                <p class="mb-0">{!! BaseHelper::clean($description) !!}</p>
            @endif
        </div>
    </div>
</div>
<div class="row mt-5 pt-2">
    <div class="col-lg-4 mb-5 mb-lg-0">
        <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">

            <div class="owl-carousel1 owl-theme"
                data-plugin-options="{'items': 1, 'autoplay': true, 'dots': false, 'autoplayTimeout': 5000, 'margin': 10, 'animateOut': 'fadeOut'}">
                <div>
                    <img class="img-fluid border-radius-2" src="themes/wowy/ads/images/home/image1.jpg" alt="generic-14">
                </div>
                {{-- <div>
                    <img class="img-fluid border-radius-2" src="themes/wowy/ads/images/home/images.jpg" alt="generic-16">
                </div> --}}
                {{-- <div>
                    <img class="img-fluid border-radius-2" src="themes/wowy/ads/images/home/about1.jpg" alt="generic-14">
                </div> --}}
            </div>

        </div>
    </div>
    <div class="col-lg-4 mb-3 mb-lg-0">
        <div class="feature-box feature-box-secondary mt-0 mobiletop">
            <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                <i class="fa fa-building" aria-hidden="true" ></i>

            </div>
            <div class="feature-box-info ps-3">
                <strong class="d-block text-4-5 text-dark ">Company Name</strong>
                @if (theme_option('site_title'))
                <p class="mb-0 text-3-5 line-height-7">{!! theme_option('site_title') !!}</p>
                @endif
            </div>
        </div>
      
        <div class="feature-box feature-box-secondary mt-4 pt-2">
            <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                <img src="themes/wowy/ads/img/icons/email.svg" width="30" height="30" alt="email" data-icon style="color: #000;"
                    data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
            </div>
            <div class="feature-box-info ">
                <strong class="d-block text-4-5 text-dark ">E-mail</strong>
                @if (theme_option('contact_email'))
                <p class="mb-0  line-height-7 size"><a href="mailto:{{ theme_option('contact_email') }}"
                        class="text-color-secondary text-color-hover-primary font-weight-semi-bold text-decoration-underline">{{ theme_option('contact_email') }}</a>
                </p>
                @endif
                @if (theme_option('contact_email2'))
                <p class="mb-0 text-3-5 line-height-7 pb-3"><a href="mailto:{{ theme_option('contact_email2') }}"
                        class="text-color-secondary text-color-hover-primary font-weight-semi-bold text-decoration-underline">{{ theme_option('contact_email2') }}</a>

                </p>
                @endif  
            </div>
        </div>

    </div>
    <div class="col-lg-4">

       
        <div class="feature-box feature-box-secondary">
            <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                <img src="themes/wowy/ads/img/icons/pin-light.svg" width="30" height="30" alt="pin-light" data-icon
                    data-plugin-options="{'onlySVG': true, 'extraClass': 'icon-white'}"  />
            </div>
            <div class="feature-box-info ps-3">
                <strong class="d-block text-4-5 text-dark ">Office Address</strong>
                @if (theme_option('address'))
                <p class="mb-0 text-3-5 line-height-7"> {{ theme_option('address') }}</p>
                @endif
            
            </div>
        </div>
        <br>
        <div class="feature-box feature-box-secondary">
            <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                <img src="themes/wowy/ads/img/icons/phone-2.svg" width="30" height="30" alt="phone-2" data-icon
                    data-plugin-options="{'onlySVG': true, 'extraClass': 'icon-white'}" style="color: #000;" />
            </div>
            <div class="feature-box-info ps-3">
                <strong class="d-block text-4-5 text-dark">Phone</strong>
                @if (theme_option('phone'))
                <p class="mb-0 text-3-5 line-height-7"><a href="tel:{{ theme_option('phone') }}"
                        class="text-color-secondary text-color-hover-primary font-weight-semi-bold text-decoration-underline">{{ theme_option('phone') }}</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row pt-1 pb-2">
    <div class="col pt-1 pb-2">
        <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
            <p class="mb-0 text-dark d-flex justify-content-center">
                <img src="themes/wowy/ads/img/demos/accounting-1/icons/icon-5.svg" width="30" alt="icon-5" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-dark me-2'}" />
                24/7 Availability - Round-the-clock support for all your investing needs, anytime.
            </p>
        </div>
    </div>
</div>
<style>
    .fa-solid,.fa-brands{
        color: #000;
    }
	@media only screen and (max-width: 600px) {
		.mobiletop{
		margin-top: 1rem !important;
		}
  .size {
     font-size: 13px!important;
  }
}
</style>

