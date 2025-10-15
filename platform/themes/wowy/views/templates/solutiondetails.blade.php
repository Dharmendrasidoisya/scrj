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

<div class="col-lg-12">
    <section class="mt-60 mb-60">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
                    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">

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
                                <div class="appear-animation animated fadeIn appear-animation-visible"
                                    data-appear-animation="fadeIn" data-appear-animation-delay="200"
                                    style="animation-delay: 200ms;">
                                    <h1
                                        class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                                        {{ $solutionPost->name }}</h1>
                                </div>
                                <div class="appear-animation animated fadeIn appear-animation-visible"
                                    data-appear-animation="fadeIn" data-appear-animation-delay="200"
                                    style="animation-delay: 200ms;">
                                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                                        <li><a href="https://www.itrade.space/dharmendra/shiner/public"
                                                class="text-light text-decoration-none">{{__('Home')}}</a></li>

                                        <li class="active text-color-light opacity-7">{{ $solutionPost->name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="col-lg-9">
                {!! Theme::content() !!}
            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar">
                <div class="widget-area">
                    {!! dynamic_sidebar('post_sidebar') !!}
                </div>
            </div> --}}
            </div>
        </div>
    </section>
</div>

<div class="container-fluid mt-lg-5 pt-5 border-bottom border-bottom-color-grey-100">

    <div class="row">
        <div class="col-lg-12 mb-5">
                            <article class="mb-5">
                <div class="card border-0">
                    <div class="row ">
                        <!-- Image Section -->
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            @if(is_array($postImages))
                            @foreach ($postImages as $img)
                                <img src="{{ asset('storage/' . $img) }}" loading="lazy" class="img-fluid" alt="{{ $solutionPost->name }}">
                            @endforeach
                        @else
                            <img src="{{ asset('storage/' . $solutionPost->image) }}" loading="lazy" class="img-fluid" alt="{{ $solutionPost->name }}">
                        @endif
                      
                        </div>
                        <!-- Content Section -->
                        <div class="col-lg-6">
                            <div class="card-body" style="    padding: 0rem;">
                                <p> {!! $solutionPost->content !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
                        </div>
    </div>
    

</div>

