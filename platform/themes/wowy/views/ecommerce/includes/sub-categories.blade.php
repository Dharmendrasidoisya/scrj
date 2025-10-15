@php
    $urlCurrent = URL::current();
    $children->loadMissing(['slugable', 'activeChildren:id,name,parent_id', 'activeChildren.slugable']);
    // dd($children);
@endphp
{{-- 
<span class="sub-toggle"><i class="far fa-angle-down"></i></span>
<ul class="sub-menu" @if (in_array($urlCurrent, collect($children->toArray())->pluck('url')->toArray())) style="display:block" @endif>
    @foreach ($children as $category)
        <li class="@if ($urlCurrent == $category->url) current-menu-item @endif @if ($category->activeChildren->count()) menu-item-has-children @endif"><a href="{{ $category->url }}">{{ $category->name }}</a>
            @if ($category->activeChildren->count())
                @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.sub-categories', ['children' => $category->activeChildren])
            @endif
        </li>
    @endforeach
</ul> --}}



@if ($category->activeChildren->count())

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
                                class="d-inline-flex py-1 px-2">{{ __('Our Products') }}</span></span>
                    </div>
                    @php $firstCategoryDisplayed = false; @endphp

                    @forelse ($category as $product)
                        @if (!$firstCategoryDisplayed && $category)
                            <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                                {{ \Illuminate\Support\Str::of($category->name)->replace('-', ' ')->title() }}
                            </h1>
                            <div class="appear-animation" data-appear-animation="fadeIn"
                                data-appear-animation-delay="200">
                                <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                                    <li><a href="{{ $category->url }}"
                                            class="text-light text-decoration-none">{{ __('Home') }}</a></li>
                                    <li class="active text-color-light opacity-7">
                                        {{ \Illuminate\Support\Str::of($category->name)->replace('-', ' ')->title() }}
                                    </li>
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
                    {{ __('Efficiency, Accuracy, and Innovation in PVC Machining.') }}</h2>

                <p style="text-align:center;">
                    {{ __('Experience unmatched performance with PVC machining solutions, where efficiency, accuracy, and innovation come together. Our advanced machinery innovative technology that streamlines operations. Discover a new era of PVC processing. Ready to transform your PVC operations?  Explore Products That Move Your Business Forward.') }}
                </p>
            </div>
        </div>
    </div>
    <!-- Our Services -->
    <div class="bg-tertiary px-3 px-xl-0 border-radius-2 text-light mt-5 mt-lg-0 p-relative overflow-hidden">
        <div class="container-fluid p-relative z-index-1">
            <div class="row align-items-center py-5">
                <div class="col py-4">
                    <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                        data-appear-animation-delay="0" style="text-align: center;">
                        <span
                            class="badge bg-gradient-tertiary-dark text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
                                class="d-inline-flex py-1 px-2">{{ __('Our Products') }}</span></span>
                    </div>
                    <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                        data-appear-animation-delay="200" style="text-align: center;">
                        <h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 text-light">
                            {{ __('Our Incredible Products') }}</h2>
                    </div>
                    <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                        data-appear-animation-delay="400" style="text-align: center;">
                        <p class="pe-lg-5 text-light opacity-7">
                            {{ __('Serving an impressive list of long-term clients with experience and expertise in multiple industries.') }}
                        </p>
                    </div>

                    <div class="pt-2 pb-4">
                        <div class="row">
                            @foreach ($children as $category)
                                <div class="col-lg-3 mb-4 pb-1">
                                    <div class="box-shadow-7 border-radius-2 overflow-hidden">
                                        <span
                                            class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
                                            <span
                                                class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content border-radius-0 rounded-top">
                                                <a href="{{ $category->url }}" title="{{ $category->name }}">
                                                    <img src="{{ RvMedia::getImageUrl($category->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}"
                                                        loading="lazy" class="img-fluid"
                                                        alt="CNC Four Heads Welding Machine">
                                                </a>
                                            </span>
                                            <span class="thumb-info-content">
                                                <span class="thumb-info-content-inner bg-light p-4">
                                                    <h4 class="text-5 mb-2">{{ $category->name }}</h4>

                                                    <span
                                                        class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">

                                                        <a href="{{ $category->url }}"
                                                            class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">{{ __('View Details') }}</a>
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

                    <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                        data-appear-animation-delay="400">
                        <p class="mb-0 text-light d-flex justify-content-center">
                            <img src="https://www.itrade.space/dharmendra/shiner/public/img/demos/accounting-1/icons/icon-5.svg"
                                width="30" alt="icon-5" data-icon
                                data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light me-2'}" />
                            24/7 Availability - Round-the-clock support for all your needs, anytime.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-items', compact('products'))

@endif
