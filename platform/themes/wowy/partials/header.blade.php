<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->

    {!! BaseHelper::googleFonts(
        'https://fonts.googleapis.com/css2?family=' .
            urlencode(theme_option('font_text', 'Poppins')) .
            ':ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap',
    ) !!}

    <style>
        :root {
            --font-text: {{ theme_option('font_text', 'Poppins') }}, sans-serif;
            --color-brand: {{ theme_option('color_brand', '#5897fb') }};
            --primary-color: {{ theme_option('color_brand', '#5897fb') }};
            --color-brand-2: {{ theme_option('color_brand_2', '#3256e0') }};
            --color-primary: {{ theme_option('color_primary', '#3f81eb') }};
            --color-secondary: {{ theme_option('color_secondary', '#41506b') }};
            --color-warning: {{ theme_option('color_warning', '#ffb300') }};
            --color-danger: {{ theme_option('color_danger', '#ff3551') }};
            --color-success: {{ theme_option('color_success', '#3ed092') }};
            --color-info: {{ theme_option('color_info', '#18a1b7') }};
            --color-text: {{ theme_option('color_text', '#4f5d77') }};
            --color-heading: {{ theme_option('color_heading', '#222222') }};
            --color-grey-1: {{ theme_option('color_grey_1', '#111111') }};
            --color-grey-2: {{ theme_option('color_grey_2', '#242424') }};
            --color-grey-4: {{ theme_option('color_grey_4', '#90908e') }};
            --color-grey-9: {{ theme_option('color_grey_9', '#f4f5f9') }};
            --color-muted: {{ theme_option('color_muted', '#8e8e90') }};
            --color-body: {{ theme_option('color_body', '#4f5d77') }};
        }
    </style>

    {!! Theme::header() !!}

    @php
        $headerStyle = theme_option('header_style') ?: '';
        $page = Theme::get('page');
        if ($page) {
            $headerStyle = $page->getMetaData('header_style', true) ?: $headerStyle;
        }
        $headerStyle =
            $headerStyle && in_array($headerStyle, array_keys(get_layout_header_styles())) ? $headerStyle : '';
    @endphp
    <!-- contry css -->


</head>

<body>
    <div class="body">
        <header id="header"
            data-plugin-options="{'stickyScrollUp': true, 'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 0, 'stickyHeaderContainerHeight': 100}"
            style="background-color: transparent; height: 105.891px;">
            <div class="header-body border-top-0 h-auto box-shadow-none bg-transparent mobileheader headertranparent">
                <div class="container-fluid p-static mobilecolor">
                    <div class="row align-items-center">
                        <div class="col-auto col-lg-2 col-xxl-1 me-auto me-lg-0 widthheader" id="widthid">
                            <div class="header-logo" data-clone-element-to="#offCanvasLogo">
                                @if ($logo = theme_option('logo_light') ?: theme_option('logo'))
                                    <a href="{{ BaseHelper::getHomepageUrl() }}">
                                        <img alt="{{ theme_option('site_title') }}" width="250" class="smalllogo"
                                            src="{{ RvMedia::getImageUrl($logo) }}">
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto col-lg-8 col-xxl-8 smallheadersize iped">
                            <div class="header-nav header-nav-links">
                                <div
                                    class="header-nav-main header-nav-main-text-capitalize header-nav-main-arrows header-nav-main-effect-2">
                                    <nav class="collapse">
                                        {!! Menu::renderMenuLocation('main-menu', ['view' => 'main-menu']) !!}
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto col-lg-2 col-xxl-3 smallheadersize2">
                            <div class="d-flex justify-content-end">
                                <div class="d-none d-sm-flex d-lg-none d-xxl-flex flex-column align-items-center">
                                    <span class="deskstyle"
                                        style="font-size: 20px; color: #fff;     font-family: Poppins, sans-serif;text-transform: capitalize;">Contact
                                        Us</span>

                                    @if (theme_option('phone'))
                                        <a href="tel:{{ theme_option('phone') }}"
                                            class="text-decoration-none font-secondary fw-bold text-white text-color-hover-primary transition-2ms"
                                            style="font-size: 1.3rem; text-decoration: underline;">
                                            {{ theme_option('phone') }}
                                        </a>
                                    @endif
                                </div>

                                <ul
                                    class="header-social-icons social-icons social-icons-clean social-icons-icon-gray social-icons-medium custom-social-icons-divider mobile-none">

                                    <li class="social-icons-facebook">
                                        <a href="https://www.facebook.com/scrjrealestateofficial" target="_blank"
                                            title="Facebook" style="color: #fff !important;"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>

                                    <li class="social-icons-instagram">
                                        <a href="https://www.instagram.com/scrjrealestateofficial/?igsh=MWVrNWw3enQ5aGdiNA%3D%3D"
                                            target="_blank" title="Instagram" style="color: #fff !important;"><i
                                                class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                                <button class="btn header-btn-collapse-nav rounded-pill" data-bs-toggle="offcanvas"
                                    href="#offcanvasMain" role="button" aria-controls="offcanvasMain">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
      
      
        <script>
            window.addEventListener('scroll', function() {
                const headerContainer = document.querySelector('.p-static');
                if (window.scrollY > 10) {
                    headerContainer.classList.add('scrolled');
                } else {
                    headerContainer.classList.remove('scrolled');
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                var header = $('#header');
                var shrinkPoint = 100; // Scroll position (100px) pachhi shrink thashe

                $(window).on('scroll', function() {
                    if ($(window).scrollTop() > shrinkPoint) {
                        header.addClass('header-shrink');
                    } else {
                        header.removeClass('header-shrink');
                    }
                });
            });
        </script>
