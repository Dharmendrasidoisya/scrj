
<?php

    
    $servicescategory = DB::table('projectsposts')->get();
    
    ?>
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
     style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100 bredcome">
       
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                            class="d-inline-flex py-1 px-2">Projects</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">
                        Projects</h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class=" text-decoration-none text-white">{{ __('Home') }}</a></li>
                        <li class="active text-color-light opacity-7" >Projects</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-grey-100 px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">

    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center py-5">

            <div class="pt-2 pb-4">   
                <div class="row">
                  
                    @foreach ($servicescategory as $servicescategorys)
                        @if ($servicescategorys)
                            <div class="col-lg-3 mb-4 pb-1">
                                <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                    <a href="{{ url('projects/' . Str::slug(str_replace('&', '', html_entity_decode($servicescategorys->name)))) }}" class="text-decoration-none">
                                        <img class="card-img-top" src="{{ RvMedia::getImageUrl($servicescategorys->image) }}" alt="{{ $servicescategorys->name }}" loading="lazy" alt="Common Tax Mistakes">
                                    </a>
                                    <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                       
                                        <span class="thumb-info-content">
                                            <span class="thumb-info-content-inner bg-light p-4">
                                                <h4 class="text-5 mb-2">{{ $servicescategorys->name }}</h4>
                                                <p> {!! \Illuminate\Support\Str::limit($servicescategorys->description, 50) !!}</p>
                                               
                                                <span
                                                    class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                    <a href="{{ url('projects/' . Str::slug(str_replace('&', '', html_entity_decode($servicescategorys->name)))) }}"
                                                        class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">
                                                        {{ __('Read More') }}
                                                    </a>
                                                    <a href="{{ url('projects/' . Str::slug(str_replace('&', '', html_entity_decode($servicescategorys->name)))) }}"
                                                        class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7"><span
                                                            class="p-static bg-transparent transform-none"><i
                                                                class="fa-solid fa-arrow-right text-dark"></i></span></a>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach


                </div>

            </div>

            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                <p class="mb-0 text-dark d-flex justify-content-center">
                    <img src="img/demos/accounting-1/icons/icon-5.svg" width="30" alt="icon-5" data-icon
                        data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light me-2'}" />
                    {{ __('24/7 Availability - Round-the-clock support for all your accounting needs, anytime.') }}
                </p>
            </div>
        </div>
    </div>
</div>
</div>


