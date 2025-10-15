<?php

$posts = DB::table('newsposts')->get();

?>
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
    style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">
    <div class="overflow-hidden p-absolute top-0 left-0 bottom-0 h-100 w-100 bredcome">

    </div>
    <div class="container-fluid p-relative z-index-1 py-2">
        <div class="row mh-200px mh-lg-300px align-items-center py-4">
            <div class="col lbtop" style="text-align:center;">
                <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0">
                    <span
                        class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                            class="d-inline-flex py-1 px-2">News</span></span>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">News</h1>
                </div>
                <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="http://127.0.0.1:8000/" class=" text-decoration-none text-color-light">Home</a>
                        </li>
                        <li class="active text-color-light opacity-7">News</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-grey-100 px-3 px-xl-0 border-radius-2-bottom p-relative overflow-hidden">
    <div class="container-fluid py-5">

        <div class="row pt-3">
            @foreach ($posts as $post)
                <div class="col-lg-3 mb-4 pb-1 ">
                    <article class="post">
                        <div
                            class="card rounded-3 border-0 bg-transparent box-shadow-10 box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                            <div class="p-relative rounded-3 overflow-hidden">
                                {{-- <div class="post-date p-absolute top-20 left-20">
                                    <span class="day py-1 text-4 font-weight-bold text-secondary">
                                        {{ \Carbon\Carbon::parse($post->updated_at)->format('d') }}
                                    </span>
                                    <span class="month bg-secondary">
                                        {{ \Carbon\Carbon::parse($post->updated_at)->format('M') }}
                                    </span>
                                </div> --}}


                                <a href="{{ url('news/' . Str::slug(str_replace('&', '', html_entity_decode($post->name)))) }}"
                                    class="text-decoration-none">
                                    <img class="card-img-top" src="{{ RvMedia::getImageUrl($post->image) }}"
                                        style="height: 260px;" alt="{{ $post->name }}" loading="lazy"
                                        alt="Common Tax Mistakes">
                                </a>
                                <div class="card-body bg-light p-4">
                                    <h4 class="my-2"><a
                                            href="{{ url('news/' . Str::slug(str_replace('&', '', html_entity_decode($post->name)))) }}"
                                            class="text-decoration-none text-dark text-color-hover-primary">{{ \Illuminate\Support\Str::limit($post->name, 38) }}
                                        </a>
                                    </h4>

                                    @if (!function_exists('html_limit'))
                                        @php
                                            function html_limit($html, $maxLength = 50)
                                            {
                                                $content = strip_tags($html);
                                                $limited = \Illuminate\Support\Str::limit($content, $maxLength);
                                                return $limited;
                                            }
                                        @endphp
                                    @endif
                                      @if (!function_exists('html_limit'))
                                                    @php
                                                    function html_limit($html, $maxLength = 100)
                                                    {
                                                    $content = strip_tags($html);
                                                    $limited = \Illuminate\Support\Str::limit(
                                                    $content,
                                                    $maxLength,
                                                    );
                                                    return $limited;
                                                    }
                                                    @endphp
                                                    @endif
                                                    <div class="lblp">
                                                        {!! html_limit($post->content, 100) !!}
                                                    </div>
                                    {{-- <p class="lblp">
                                        {!! html_limit($post->content, 50) !!}
                                    </p> --}}
                                    {{-- <p class="card-text text-3-5 mb-1">
                                       <p>{{ \Illuminate\Support\Str::limit($post->description, 100) }}</p> --}}
                                    <a href="{{ url('news/' . Str::slug(str_replace('&', '', html_entity_decode($post->name)))) }}"
                                        class="read-more text-color-secondary font-weight-semibold text-2">Read More<i
                                            class="fas fa-angle-right position-relative top-1 ms-1"></i></a>

                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach




        </div>


    </div>
</div>
