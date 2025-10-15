<!-- Main Slider -->
<div class="owl-carousel owl-carousel-light owl-carousel-light-init-fadeIn owl-theme manual nav-style-1 nav-arrows-thin nav-inside nav-inside-plus nav-dark nav-lg nav-font-size-lg rounded-nav nav-borders show-nav-hover mb-0  bannermobile"
    data-plugin-options="{'autoplay': false, 'autoplayTimeout': 700000000}">
    <div class="owl-stage-outer">
        <div class="owl-stage">
            <!-- Carousel Slide 1 -->
            <div class="hero-style-three ul_li pos-rel hero-section  py-5 ">
                <div class="container">
                    <div class="slider-one">
                        <div class="slider-one-image">
                            <div class="slider-text section-title lq hero-sec-title-htree ">
                                  @if ($title)
                                <h1 class=" xb-split-text split-in-right lwop slidercolor sliderbottom">{!! BaseHelper::clean($title) !!}</h1>
                                    @endif
                                {{-- <h1 class=" xb-split-text split-in-right lwop slidercolor ">Smart Investment</h1> --}}

                                @if ($description)
                                    <p class="sub-title wow fadeInRight lqs slidercolor">{!! BaseHelper::clean($description) !!}</p>
                                @endif
                                <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                                    data-appear-animation-delay="600">
                                    <div class="d-flex  pb-3 align-items-center">

                                        @php
                                            $headerMessages = json_decode(theme_option('header_messages'), true);
                                            $secondLink = null;
                                            $linkCount = 0;

                                            if (!empty($headerMessages) && is_array($headerMessages)) {
                                                foreach ($headerMessages as $message) {
                                                    if (is_array($message)) {
                                                        foreach ($message as $field) {
                                                            if (
                                                                isset($field['key']) &&
                                                                $field['key'] === 'link' &&
                                                                !empty($field['value'])
                                                            ) {
                                                                $linkCount++;
                                                                if ($linkCount === 1) {
                                                                    $secondLink = $field['value'];
                                                                    break 2; // Stop both loops once the second link is found
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($secondLink)
                                            <a href="{{ $secondLink }}"
                                                class="btn btn-rounded btn-dark box-shadow-7 font-weight-medium btn-swap-1"
                                                data-clone-element="1">
                                                <span style="color:#fff;">Contacts Us</span>
                                            </a>
                                        @endif

                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="slider-two">
                        <div class="slider-two-image">
                            <div class="slider-text">
                                @if ($title)
                                <h1 class=" xb-split-text split-in-right lwop slidercolor sliderbottom">{!! BaseHelper::clean($title) !!}</h1>
                                    @endif
                                @if ($description2)
                                    <p class="sub-title wow fadeInRight lqs slidercolor">{!! BaseHelper::clean($description2) !!}</p>
                                @endif
                                <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                                    data-appear-animation-delay="600">
                                    <div class="d-flex  pb-3 align-items-center">

                                        @php
                                            $headerMessages = json_decode(theme_option('header_messages'), true);
                                            $secondLink = null;
                                            $linkCount = 0;

                                            if (!empty($headerMessages) && is_array($headerMessages)) {
                                                foreach ($headerMessages as $message) {
                                                    if (is_array($message)) {
                                                        foreach ($message as $field) {
                                                            if (
                                                                isset($field['key']) &&
                                                                $field['key'] === 'link' &&
                                                                !empty($field['value'])
                                                            ) {
                                                                $linkCount++;
                                                                if ($linkCount === 1) {
                                                                    $secondLink = $field['value'];
                                                                    break 2; // Stop both loops once the second link is found
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($secondLink)
                                            <a href="{{ $secondLink }}"
                                                class="btn btn-rounded btn-dark box-shadow-7 font-weight-medium btn-swap-1"
                                                data-clone-element="1">
                                                <span style="color:#fff;">Contacts Us</span>
                                            </a>
                                        @endif

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="slider-three">
                        <div class="slider-three-image">
                            <div class="slider-text">
                                 @if ($title)
                                <h1 class=" xb-split-text split-in-right lwop slidercolor sliderbottom">{!! BaseHelper::clean($title) !!}</h1>
                                    @endif
                                {{-- <h1 class=" xb-split-text split-in-right lwop slidercolor sliderbottom ">Smart City</h1>
                                <h1 class=" xb-split-text split-in-right lwop slidercolor ">Smart Investment</h1> --}}
                                @if ($description2)
                                    <p class="sub-title wow fadeInRight lqs slidercolor">{!! BaseHelper::clean($description2) !!}</p>
                                @endif
                                <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                                    data-appear-animation-delay="600">
                                    <div class="d-flex  pb-3 align-items-center">

                                        @php
                                            $headerMessages = json_decode(theme_option('header_messages'), true);
                                            $secondLink = null;
                                            $linkCount = 0;

                                            if (!empty($headerMessages) && is_array($headerMessages)) {
                                                foreach ($headerMessages as $message) {
                                                    if (is_array($message)) {
                                                        foreach ($message as $field) {
                                                            if (
                                                                isset($field['key']) &&
                                                                $field['key'] === 'link' &&
                                                                !empty($field['value'])
                                                            ) {
                                                                $linkCount++;
                                                                if ($linkCount === 1) {
                                                                    $secondLink = $field['value'];
                                                                    break 2; // Stop both loops once the second link is found
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($secondLink)
                                            <a href="{{ $secondLink }}"
                                                class="btn btn-rounded btn-dark box-shadow-7 font-weight-medium btn-swap-1"
                                                data-clone-element="1">
                                                <span style="color:#fff;">Contacts Us</span>
                                            </a>
                                        @endif

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

</div>
