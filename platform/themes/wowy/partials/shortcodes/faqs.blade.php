<div class="container-fluid  pb-5 paddingleftright ">
    <div class="row align-items-center pt-6 ">
        <div class="col-lg-8 mb-5 mb-lg-0 ">
            <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0">
                @if ($title)
                    <span
                        class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
                            class="d-inline-flex py-1 px-2">{!! BaseHelper::clean($title) !!}</span></span>
                @endif
            </div>
            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                @if ($description)
                    <p>{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>
            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                @if ($description2)
                    <p>{!! BaseHelper::clean($description2) !!}</p>
                @endif
            </div>
			<br/>
			  <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                @if ($description3)
                    <p>{!! BaseHelper::clean($description3) !!}</p>
                @endif
            </div>
			  <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                @if ($description4)
                    <p>{!! BaseHelper::clean($description4) !!}</p>
                @endif
            </div>
            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                <div class="d-flex pt-3 pb-3 align-items-center">

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
                                            if ($linkCount === 2) {
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
                            <span> About SCRJ Group</span>
                        </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-5 mb-lg-0 ">


            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                <div>

                    <div>
                        <img class="img-fluid border-radius-2 lbweare heightabout"
                            src="{{ asset('themes/wowy/ads/images/home/photo.png') }}" alt="generic-14">
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pt-6 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    @media screen and (min-device-width: 1200px) and (max-device-width: 1280px) {
        .heightabout {
            height: 400px !important;
        }
    }

    @media only screen and (max-width: 600px) {


        .dholerawidth {
            font-weight: 600 !important;
        }

        .pt-6 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
    }
</style>
