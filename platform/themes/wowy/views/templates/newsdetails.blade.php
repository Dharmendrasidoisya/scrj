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

<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
     style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100 bredcome">
     
    </div>
    <div class="container-fluid p-relative z-index-1 py-2 ">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                    data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="animation-delay: 0ms;">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">Our News</span></span>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible"
                    data-appear-animation="fadeIn" data-appear-animation-delay="200"
                    style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2">
                        {{ $post->name }}</h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible"
                    data-appear-animation="fadeIn" data-appear-animation-delay="200"
                    style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class=" text-decoration-none text-white">Home</a></li>

                        <li class="active text-color-light opacity-7 ">{{ $post->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid  pt-5 border-bottom border-bottom-color-grey-100 ">

    <div class="row">
        {{-- @foreach ($relatedPosts as $relatedItem) --}}
        <div class="col-lg-8 mb-lg-0">
            <style>
                @media screen and (min-device-width: 1367px) and (max-device-width: 1440px) {
                    .smallscreen {
                        height: 470px !important;
                        width: 870px !important;
                    }
                      
                }
                     @media screen and (min-device-width: 1440px) and (max-device-width: 1600px) {
                    .smallbottom{
                                padding-bottom: 2rem !important;
                    }
                }
                .smallbottom{
                                padding-bottom: 2rem !important;
                    }
				.smallscreen{
				height: 507px;
					width: 762px;
                        margin-top: 0rem !important;
				}
				@media only screen and (max-width: 600px) {
                    .smallscreen {
                        height: auto!important;
                        width: auto!important;
                    }
                    }

            </style>
            <article>
                <div class="card border-0">
                    <div class="card-body z-index-1 p-0">
                        <div class="post-image ">
                            <img class="card-img-top border-radius-2 smallscreen"
                                src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                alt="{{ $post->name }}" >
                        </div>

                        <div class="card-body pt-4 smallbottom" style="padding: 0px;padding: 0rem;">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </article>

        </div>
        {{-- @endforeach --}}

        <div class="blog-sidebar col-lg-4 pt-lg-0">
            <aside class="sidebar">
                <div class="py-1 clearfix">
                    <hr class="my-2">
                </div>
                <div class="px-3 mt-4">
                    <h3 class="text-color-dark text-capitalize font-weight-bold text-5 m-0 mb-3">Recent Posts</h3>
                    <div class="pb-2 mb-1">
                        @foreach ($newsrelated as $relatedItem)
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                <a href="{{ url('news/' . Str::slug(str_replace('&', '', html_entity_decode($relatedItem->name)))) }}">
                                    <img src="{{ RvMedia::getImageUrl($relatedItem->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        alt="img" width="70" height="70" class="widget-posts-img">
                                </a>
                                <a href="{{ url('news/' . Str::slug(str_replace('&', '', html_entity_decode($relatedItem->name)))) }}"
                                    class="text-color-dark text-hover-primary font-weight-bold text-3 line-height-4">
                                    {!! $relatedItem->name !!}
                                </a>
                                
                              
                            </div>
                        @endforeach

                    </div>
                </div>



            </aside>
        </div>
    </div>

</div>

