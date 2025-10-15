<!-- News -->
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100">
        <div class="custom-el-5 custom-pos-4">
            <img class="img-fluid opacity-2 opacity-hover-2" src="{{asset('themes/wowy/ads/img/demos/accounting-1/svg/waves.svg')}}" alt="waves">
        </div>
    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter"
                    data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30 text-light rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-3"><span
                            class="d-inline-flex py-1 px-2">{{__('Who We Are')}}</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">{{__('Blogs')}}</h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}" class="text-light text-decoration-none">{{__('Home')}}</a></li>
                        <li class="active text-color-light opacity-7">{{__('Blogs')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section-padding-10">
    <div class="container-fuild">
        <div class="col-12">
            {{-- @if ($title)
                <h3 class="section-title style-1 mb-30 wow fadeIn animated">{!! BaseHelper::clean($title) !!}</h3>
            @endif --}}
     
        
                    <h2
                        class="text-resp-150 ws-nowrap font-weight-semi-bold text-overflow-center text-color-grey-100 n-ls-5 ">
                        Blogs</h2>
              
          
            <div class="post-list mb-4 mb-lg-0">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <article class="post">
                                <div
                                    class="card rounded-3 border-0 bg-transparent box-shadow-10 box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                                    <div class="p-relative rounded-3 overflow-hidden">
                                        <div class="post-date p-absolute top-20 left-20">
                                            <span class="day py-1 text-4 font-weight-bold text-secondary">
                                                {{ \Carbon\Carbon::parse($post->updated_at)->format('d') }}
                                            </span>
                                            <span class="month bg-secondary">
                                                {{ \Carbon\Carbon::parse($post->updated_at)->format('M') }}

                                            </span>
                                        </div>


                                        <a href="{{ $post->url }}" class="text-decoration-none">
                                            <img class="card-img-top" src="{{ RvMedia::getImageUrl($post->image) }}"
                                                alt="{{ $post->name }}" loading="lazy" alt="Common Tax Mistakes">
                                        </a>
                                        <div class="card-body bg-light p-4">

                                            <h4 class="my-2"><a href="{{ $post->url }}"
                                                    class="text-decoration-none text-dark text-color-hover-primary">{{ $post->name }}</a>
                                            </h4>
                                            <p class="card-text text-3-5 mb-1">
                                            <p>{{ $post->description }}</p>
                                            <a href="{{ $post->url }}"
                                                class="read-more text-color-secondary font-weight-semibold text-2">Read
                                                More <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- <article class="wow fadeIn animated col-lg-6">
                            <div class="d-md-flex d-block">
                                <div class="post-thumb d-flex mr-15 border-radius-10">
                                    <a class="color-white" href="{{ $post->url }}">
                                        <img class="border-radius-10" src="{{ RvMedia::getImageUrl($post->image) }}" alt="{{ $post->name }}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="entry-meta mb-5 mt-10">
                                        <a class="entry-meta meta-2" href="{{ $post->firstCategory->url }}"><span class="post-in text-danger font-x-small text-uppercase">{{ $post->firstCategory->name }}</span></a>
                                    </div>
                                    <h4 class="post-title mb-25 text-limit-2-row">
                                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                                    </h4>
                                    <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on"> <i class="far fa-clock"></i> {{ $post->created_at->translatedFormat('d M Y') }}</span>
                                            <span class="hit-count has-dot">{{ number_format($post->views) }} {{ __('Views')}}</span>
                                        </div>
                                        <a href="{{ $post->url }}">{{ __('Read more') }} <i class="fa fa-arrow-right font-xxs ml-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article> --}}
                    @endforeach




                </div>
            </div>
        </div>
    </div>
</section>
