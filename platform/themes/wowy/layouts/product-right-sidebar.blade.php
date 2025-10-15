@php
    Theme::asset()->container('footer')->usePath()->add('jquery.theia.sticky-js', 'js/plugins/jquery.theia.sticky.js');
@endphp

{!! Theme::partial('header') !!}

<main class="main" id="main-section">
    @if (Theme::get('hasBreadcrumb', true))
        {!! Theme::partial('breadcrumb') !!}
    @endif

 
                {{-- <div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
                    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
                       
                    </div>
                    <div class="container-fluid p-relative z-index-1 py-2">
                        <div class="row mh-200px mh-lg-300px align-items-center py-4">
                                                    <div class="col" style="text-align:center;">
                                    <div class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0" style="animation-delay: 0ms;">
                                        <span class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span class="d-inline-flex py-1 px-2">Our Products</span></span>
                                    </div>
                                    <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                                        <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                                            CNC Four Heads Welding Machine</h1>
                                    </div>
                                    <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                                        <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                                            <li><a href="https://www.itrade.space/dharmendra/shiner/public" class="text-light text-decoration-none">Home</a></li>
                                            
                                            <li class="active text-color-light opacity-7">CNC Four Heads Welding Machine</li>
                                        </ul>
                                    </div>
                                </div>
                               </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    {!! Theme::content() !!}
                </div>
                {{-- <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        {!! dynamic_sidebar('product_sidebar') !!}
                    </div>
                </div> --}}
          
</main>

{!! Theme::partial('footer') !!}
