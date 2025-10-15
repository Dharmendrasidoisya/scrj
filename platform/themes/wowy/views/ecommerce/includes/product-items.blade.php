@php
    $layout = theme_option('product_list_layout');
    // dd($layout);

    $requestLayout = request()->input('layout');
    if ($requestLayout && in_array($requestLayout, array_keys(get_product_single_layouts()))) {
        $layout = $requestLayout;
    }

    $layout = $layout && in_array($layout, array_keys(get_product_single_layouts())) ? $layout : 'product-full-width';
@endphp
<div class="list-content-loading">
    <div class="half-circle-spinner">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
    </div>
</div>

{{-- @if ($products->isNotEmpty())
   <div class="shop-product-filter">
        <div class="total-product">
            <p>{!! BaseHelper::clean(__('We found :total items for you!', ['total' => '<strong class="text-brand">' . $products->total() . '</strong>'])) !!}</p>
        </div>
        @include(Theme::getThemeNamespace() . '::views/ecommerce/includes/sort')
    </div> 
@endif --}}

<input type="hidden" name="page" data-value="{{ $products->currentPage() }}">
<input type="hidden" name="sort-by" value="{{ BaseHelper::stringify(request()->input('sort-by')) }}">
<input type="hidden" name="num" value="{{ BaseHelper::stringify(request()->input('num')) }}">
<input type="hidden" name="q" value="{{ BaseHelper::stringify(request()->input('q')) }}">

<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2" src="img/demos/accounting-1/svg/waves.svg" alt="waves">
        </div>
    </div>
    <div class="container p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">

            <div class="col" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">{{__('Our Products')}}</span></span>
                </div>
                @php $firstCategoryDisplayed = false; @endphp

                @forelse ($category as $product)
                    @if (!$firstCategoryDisplayed && $category)
                        <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                            {{ \Illuminate\Support\Str::of($category->name)->replace('-', ' ')->title() }}
                        </h1>
                        <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                            <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                                <li><a href="https://www.itrade.space/dharmendra/shiner/public"
                                        class="text-light text-decoration-none">{{__('Home')}}</a></li>
                                <li class="active text-color-light opacity-7">
                                    {{ \Illuminate\Support\Str::of($category->name)->replace('-', ' ')->title() }}</li>
                            </ul>
                        </div>
                        @php $firstCategoryDisplayed = true; @endphp
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="intro">
    <div class="row align-items-center">
        <div class="col-lg-12 py-lg-5 ps-lg-4">
            <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-4"
                style="-webkit-font-smoothing:antialiased;-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);box-sizing:border-box;color:var(--dark);font-family:Lexend, sans-serif;font-size:3.5em !important;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:600 !important;letter-spacing:-0.05em;line-height:1 !important;margin:0px 0px 1.5rem !important;orphans:2;text-align:center;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;">
                {{__('Efficiency, Accuracy, and Innovation in PVC Machining.')}}<h2>

            <p style="text-align:center;">{{__('Experience unmatched performance with PVC machining solutions, where efficiency, accuracy, and innovation come together. Our advanced machinery innovative technology that streamlines operations. Discover a new era of PVC processing. Ready to transform your PVC operations?  Explore Products That Move Your Business Forward.')}}</p>
        </div>
    </div>
</div>
{{-- <div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">
  


    <div class="container-fluid p-relative z-index-1">
        <div class="row align-items-center py-5">
            <div class="col py-4">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0" style="text-align: center;">
                    <span class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span class="d-inline-flex py-1 px-2">Our Products</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="text-align: center;">
                    <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light">Our Incredible Products</h2>
                </div>
                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="text-align: center;">
                    <p class="pe-lg-5 text-light opacity-7">Serving an impressive list of long-term clients with experience and expertise in multiple industries.</p>
                </div>

                <div class="pt-2 pb-4">
                    <div class="row">
               
                        <div class="col-lg-3 mb-4 pb-1">
                            <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                    <span class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content border-radius-0 rounded-top">
                                        <a href="https://www.itrade.space/dharmendra/shiner/public/products/pvc-machining-center/1">
                                            <img src="https://www.itrade.space/dharmendra/shiner/public/upload/subcategory/1818598710156969.jpg" loading="lazy" class="img-fluid" alt="{$categories->subcategory_name}}">
                                        </a>
                                    </span>											
                                    <span class="thumb-info-content">
                                        <span class="thumb-info-content-inner bg-light p-4">
                                            <h4 class="text-5 mb-2">PVC Machining Center</h4>
                                             <p>PVC Machining Center</p>
                                            <span class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                                                <a href="https://www.itrade.space/dharmendra/shiner/public/products/pvc-machining-center/1" class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">View Details</a>
                                                <a href="https://www.itrade.space/dharmendra/shiner/public/products/pvc-machining-center/1" class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7"><span class="p-static bg-transparent transform-none"><i class="fa-solid fa-arrow-right text-dark"></i></span></a>
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </div>
                     
                </div>

                </div>

                <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                    <p class="mb-0 text-light d-flex justify-content-center">
                        <img src="https://www.itrade.space/dharmendra/shiner/public/img/demos/accounting-1/icons/icon-5.svg" width="30" alt="icon-5" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light me-2'}" />
                        24/7 Availability - Round-the-clock support for all your needs, anytime.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>  --}}

<div class="row product-grid">
    <div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">
        <div class="container-fluid p-relative z-index-1">
            <div class="row align-items-center py-5">
                <div class="col py-4">
                    <div class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0" style="text-align: center; animation-delay: 0ms;">
                        <span class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span class="d-inline-flex py-1 px-2">{{__('Our Products')}}</span></span>
                    </div>
                    <div class="appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="text-align: center; animation-delay: 200ms;">
                        <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light">{{__('Our Incredible Products')}}</h2>
                    </div>
                    <div class="appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="text-align: center; animation-delay: 400ms;">
                        <p class="pe-lg-5 text-light opacity-7">{{__('Serving an impressive list of long-term clients with experience and expertise in multiple industries.')}}</p>
                    </div>
                    <div class="pt-2 pb-4">
                        <div class="row">
                    @forelse ($products as $product)
                        <div
                            class="@if ($layout === 'product-full-width') col-lg-3 mb-4 pb-1 @endif col-lg-3 mb-4 pb-1">
                            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item',
                                compact('product'))
                        </div>
                    @empty
                        <div class="mt__60 mb__60 text-center">
                            <p>{{ __('No products found!') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@if ($products->hasPages())
    <br>
    {!! $products->withQueryString()->links(Theme::getThemeNamespace() . '::partials.custom-pagination') !!}
@endif
