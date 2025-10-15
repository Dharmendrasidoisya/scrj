<section class="section-padding-60">
<div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light p-relative overflow-hidden">
    <div class="custom-el-3 custom-pos-2 opacity-1">
        <img class="img-fluid opacity-5" src="img/demos/accounting-1/svg/waves-2.svg" alt="waves-2">
    </div>
    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center py-5">
            <div class="col py-4">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">  
                    @if ($title)
                    <span
                        class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span class="d-inline-flex py-1 px-2">{!! BaseHelper::clean($title) !!}</span></span>
                    @endif
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                    @if ($title)
                    <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light"> {!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
                <div class="pt-2 pb-4">
                    <div class="carousel-half-full-width-wrapper carousel-half-full-width-right">
                        <div class="owl-carousel owl-theme carousel-half-full-width-right nav-bottom nav-bottom-align-left nav-lg nav-transparent nav-borders-light nav-arrow-light rounded-nav mb-2"
                            data-plugin-options="{'responsive': {'0': {'items': 1}, '768': {'items': 3}, '992': {'items': 4}, '1200': {'items': 5}}, 'loop': true, 'nav': true, 'dots': false, 'autoplay': true, 'margin': 20}" style="width: auto;">
                           
                            @foreach ($products as $product)
                                @if ($product)
                                <div class="box-shadow-7 border-radius-2 overflow-hidden" >
                                    <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover" style="height: 500px;">
                                        <span class="thumb-info-wrapper overlay-gradient-bottom-content border-radius-0 rounded-top">
                                            <a href="{{ $product->url }}">
                                                <img class="default-img img-fluid" src="{{ RvMedia::getImageUrl($product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                                
                                            </a>
                                        </span>
                                        <span class="thumb-info-content">
                                            <span class="thumb-info-content-inner bg-light p-4">
                                                <h4 class="text-5 mb-2">{{ $product->name }}</h4>
                                                <p>{!! \Illuminate\Support\Str::words($product->description, 10, '...') !!}</p>
                                                <span
                                                    class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                    <a href="{{ $product->url }}" class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">View Details</a>
                                                    <a href="{{ $product->url }}" class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7">
                                                        <span class="p-static bg-transparent transform-none"><i class="fa-solid fa-arrow-right text-dark"></i></span>
                                                    </a>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                    data-appear-animation-delay="400">
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

</section>


