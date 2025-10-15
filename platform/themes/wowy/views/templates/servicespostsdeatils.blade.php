
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
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <h1 class="text-9 text-lg-12 text-color-light font-weight-semibold line-height-1 mb-2">
                        {!! $post->name !!}</h1>
                </div>
                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn"
                    data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                        <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                class="text-light text-decoration-none">Home</a></li>

                        <li class="active text-color-light opacity-7">{!! $post->name !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid pb-5 pt-lg-5 mt-5 border-bottom border-bottom-color-grey-100">
    <div class="row">
        <div class="col-lg-4 order-1 order-lg-0 pe-lg-5 mt-4 mt-lg-0">

            <div class="bg-grey-100 p-4 border-radius-2 mb-4">
                <div class="m-3">
                    <h4 class="text-5 font-weight-semibold line-height-1 mb-4">Related  Services</h4>
                    <ul class="nav nav-list nav-list-arrows flex-column mb-0">
                        @foreach ($posts as $servicescategorys)
                        <li class="nav-item">
                            <a href="{{ Str::slug(str_replace('&', '', html_entity_decode($servicescategorys->name))) }}" class="nav-link ">{!! $servicescategorys->name !!}</a>
                        </li> 
                        @endforeach
                        {{-- @foreach (get_featured_services_categories($servicescategory) as $relatedProduct)
                            <li class="nav-item">
                                <a href="{{ Str::slug(str_replace('&', '', html_entity_decode($servicescategorys->name))) }}" class="nav-link ">{{ $relatedProduct->name }}</a>
                            </li>
                        @endforeach --}}
                    </ul>

                </div>
            </div>

            <div class="bg-tertiary text-light p-4 border-radius-2 mb-4">
                <div class="m-3">
                    <h4 class="text-5 font-weight-semibold line-height-1 mb-4">{{ $post->name }}</h4>
                    <div>
                        {{-- <iframe width="100%" height="300" src="https://www.youtube.com/embed/ZSWUEObpSoA" title="Auto Welding Cleaning Production Line" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe> --}}
                     
                    </div>
                    <div class="d-flex flex-column pt-4">
                        <div class="pe-4">
                            <div class="feature-box feature-box-secondary align-items-center">
                                <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                                    <img src="{{ asset('themes/wowy/ads/img/icons/phone-2.svg') }}" width="30"
                                        height="30" alt="phone-2" data-icon=""
                                        data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}">
                                </div>
                                <div class="feature-box-info ps-2">
                                    <strong class="d-block text-uppercase text-color-secondary p-relative top-2">Call
                                        Us</strong>
                                    @if (theme_option('phone'))
                                        <a href="tel:{{ theme_option('phone') }}"
                                            class="text-decoration-none font-secondary textb font-weight-semibold text-color-light transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2">{{ theme_option('phone') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="pe-4 pt-4">
                            <div class="feature-box feature-box-secondary align-items-center">
                                <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                                    <img src="{{ asset('themes/wowy/ads/img/icons/email.svg') }}" width="30"
                                        height="30" alt="email" data-icon=""
                                        data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}">
                                </div>
                                <div class="feature-box-info ps-2">
                                    <strong class="d-block text-uppercase text-color-secondary p-relative top-2">Send
                                        E-mail</strong>
                                    @if (theme_option('contact_email'))
                                        <a href="mailto:{{ theme_option('contact_email') }}"
                                            class="text-decoration-none font-secondary textb font-weight-semibold text-color-light transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2"    style="word-wrap: break-word !important; overflow-wrap: break-word !important; white-space: normal !important; display: block;">
                                            {{ theme_option('contact_email') }}</a>
                                    @endif
									
                                            @if (theme_option('contact_email2'))
                                        <a href="mailto:{{ theme_option('contact_email2') }}"
                                            class="text-decoration-none font-secondary textb font-weight-semibold text-color-light transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2" style="word-wrap: break-word !important; overflow-wrap: break-word !important; white-space: normal !important; display: block;">{{ theme_option('contact_email2') }}</a>
                                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <img class="card-img-top" src="{{ RvMedia::getImageUrl($post->image) }}"
            alt="{{ $post->name }}" loading="lazy" alt="Common Tax Mistakes" style="width: 500px;
            height: 500px;">
            <p>{!! $post->content !!}</p>
        </div>
    </div>
</div>
