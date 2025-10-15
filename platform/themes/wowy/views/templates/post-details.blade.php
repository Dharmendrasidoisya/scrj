<style>
    img {
        max-width: none;
    }
</style>
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2"
                src="{{ asset('themes/wowy/ads/img/demos/accounting-1/svg/waves.svg') }}" alt="waves">
        </div>
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col" style="text-align:center;">
                <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                    data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                    style="animation-delay: 0ms;">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">Our Blogs</span></span>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                        {!! $post->name !!}</h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class="text- text-decoration-none">Home</a></li>

                        <li class="active text-color-light opacity-7">{!! $post->name !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-lg-5 pt-5 border-bottom border-bottom-color-grey-100">

    <div class="row">

        @php
            use Illuminate\Support\Facades\DB;

            $relatedPosts = get_related_posts($post->id, 5);
            // dd($relatedPosts);
            $related = DB::table('posts')->where('status', 'published')->get();

        @endphp


        <div class="col-lg-8 mb-5 mb-lg-0">
            <article>
                <div class="card border-0">
                    <div class="card-body z-index-1 p-0">
                        <div class="post-image ">
                            <img class="card-img-top border-radius-2"
                                src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                alt="{{ $post->name }}">
                        </div>

                        <div class="card-body p-0">
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
            </article>

        </div>
        {{-- @endforeach --}}

        <div class="blog-sidebar col-lg-4 pt-4 pt-lg-0">
            <aside class="sidebar">
                <div class="py-1 clearfix">
                    <hr class="my-2">
                </div>
                <div class="px-3 mt-4">
                    <h3 class="text-color-dark text-capitalize font-weight-bold text-5 m-0 mb-3">Recent Posts</h3>
                    <div class="pb-2 mb-1">
                        @foreach ($related as $relatedItem)
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                <a href="{{ route('post.details', ['id' => $relatedItem->id]) }}">
                                    <img src="{{ RvMedia::getImageUrl($relatedItem->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        alt="img" width="70" height="70" class="widget-posts-img">
                                </a>
                                <a href="{{ route('post.details', ['id' => $relatedItem->id]) }}"
                                    class="text-color-dark text-hover-primary font-weight-bold text-3 line-height-4">
                                    {{ $relatedItem->name }}
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>



            </aside>
        </div>
    </div>

</div>
