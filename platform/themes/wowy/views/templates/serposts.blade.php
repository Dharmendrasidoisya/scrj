@php
    $urlCurrent = URL::current();
    $children->loadMissing(['slugable', 'activeChildren:id,name,parent_id', 'activeChildren.slugable']);

@endphp

@if ($category->activeChildren->count())

<style>
ol, ul {
    list-style: disc;
    text-align: left;
}
	h2,h3{
		text-align:justify;
		margin: 0 0 0px 0;
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
                                class="d-inline-flex py-1 px-2">Our Services</span></span>
                    </div>
                    <div class="appear-animation animated fadeIn appear-animation-visible"
                        data-appear-animation="fadeIn" data-appear-animation-delay="200"
                        style="animation-delay: 200ms;">
                        <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                            {!! $category->name ?? 'Subcategories' !!}</h1>
                    </div>
                    <div class="appear-animation animated fadeIn appear-animation-visible"
                        data-appear-animation="fadeIn" data-appear-animation-delay="200"
                        style="animation-delay: 200ms;">
                        <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                            <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                    class="text-light text-decoration-none">Home</a></li>

                            <li class="active text-color-light opacity-7"> {!! $category->name ?? 'Subcategories' !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="intro">
        <div class="row align-items-center">

            <div class="col-lg-12 py-lg-5 pt-5 ">

                <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
                    data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                    style="animation-delay: 400ms;">
<div style="text-align: center;">
                   {!! $category->description ?? 'No Data' !!}
	  </div>
                </div>


            </div>
        </div>
    </div>
    {{-- @if ($servicescategories->isNotEmpty()) --}}
    <!-- News -->
    <div class="bg-grey-100 px-3 px-xl-0 border-radius-2-bottom p-relative overflow-hidden">
        <div class="container-fluid py-5">

            <div class="row pt-3">

                @if ($children->isNotEmpty())
                    @foreach ($children as $post)
                        <div class="col-lg-3 mb-4 pb-1">
                            <article class="post">
                                <div
                                    class="card rounded-3 border-0 bg-transparent box-shadow-10 box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                                    <div class="p-relative rounded-3 overflow-hidden">
                                        <div class="card-body bg-light p-4">
                                            <h4 class="my-2">
                                                <a href="{{ $post->url }}"
                                                    class="text-decoration-none text-dark text-color-hover-primary">
                                                    {!! \Illuminate\Support\Str::limit($post->name, 38) !!}
                                                </a>
                                            </h4>
                                            <p class="card-text text-3-5 mb-1">
                                            <p>{!! \Illuminate\Support\Str::limit($post->description, 120) !!}</p>
                                            <a href="{{ $post->url }}"
                                                class="read-more text-color-secondary font-weight-semibold text-2">Read
                                                More <i class="fas fa-angle-right position-relative top-1 ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted font-weight-bold">No data available</p>
                    </div>
                @endif



            </div>


        </div>
    </div>
@else
    {{-- @include(Theme::getThemeNamespace() . '::views.templates.servicesposts', [
    'children' => $category->activeChildren->where('parent_id', $category->id)
]) --}}
    <?php

    $postIds = DB::table('post_categories')->where('category_id', $category->id)->pluck('post_id'); // Get only post IDs as an array
    
    // Fetch posts that match the retrieved post IDs
    $posts = DB::table('servicesposts')->whereIn('id', $postIds)->get();
    // $slug = DB::table('slugs')->whereIn('reference_id', $postIds)->where('reference_type', 'Botble\Services\Models\Post')->get();
    // dd($slugs);
    $servicescategories = DB::table('servicescategories')->where('id', $category->id)->get();
    
    ?>
    @include(Theme::getThemeNamespace() . '::views.templates.servicesposts',  compact('posts', 'servicescategories') )

@endif

{{-- @endif --}}
