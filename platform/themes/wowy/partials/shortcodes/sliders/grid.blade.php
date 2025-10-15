<div class="hero-slider-1 dot-style-1 dot-style-1-position-1 {{ $class ?? '' }}"
    data-autoplay="{{ $shortcode->is_autoplay ?: 'yes' }}"
    data-autoplay-speed="{{ in_array($shortcode->autoplay_speed, theme_get_autoplay_speed_options()) ? $shortcode->autoplay_speed : 3000 }}">
    @foreach ($sliders as $slider)
        <div class="single-hero-slider single-animation-wrap">
            @if ($sliderContent = Theme::partial('shortcodes.sliders.content', compact('slider')))
                <div class="container">
                    <div class="row slider-animated-1 flex-column-reverse flex-lg-column">
                        <!-- Image Section -->
                        <div class="col-12 text-center">
                            <div class="single-slider-img single-slider-img-1 mb-4">
                                {!! Theme::partial('shortcodes.sliders.includes.image', compact('slider')) !!}
                            </div>
                            <!-- Content Section -->
                            <div class="col-lg-6 text-center">
                                <div class="slider-content-wrapper">
                                    {!! $sliderContent !!}
                                </div>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="slider-content-wrapper">
                                    {{-- {!! $sliderContent !!} --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <!-- Fallback for image-only slider -->
                <div class="single-slider-img single-slider-img-1">
                    {!! Theme::partial('shortcodes.sliders.includes.image', compact('slider')) !!}
                </div>
            @endif
        </div>
    @endforeach
</div>
<div class="slider-arrow hero-slider-1-arrow"></div>
