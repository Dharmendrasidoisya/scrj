<!-- Logos -->
<div class="container-fluid ">
    <div class="row ">

        <div class="col pb-0 pb-lg-5" style="padding-bottom: 3rem !important">

            <div class="owl-carousel owl-theme carousel-center-active-item scrollbigscreen"
                data-plugin-options="{'responsive': {'0': {'items': 2}, '476': {'items':2}, '768': {'items': 2}, '992': {'items': 8}, '1200': {'items': 6}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false, 'loop': true, 'center': true}"
                style="background: rgb(255 252 244); padding: 20px 0px;">


                <div>
                    @if (!empty($icon))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif

                </div>
                <div>
                    @if (!empty($icon2))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon2)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon3))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon3)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon4))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon4)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon5))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon5)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon6))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon6)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon7))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon7)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div>
                    @if (!empty($icon8))
                        <img src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon8)) }}" loading="lazy"
                            class="img-fluid climob" alt="clientlogo">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>
<style>
    .scrollbigscreen .owl-item.active {
        opacity: 1;
        transform: scale(1.1);

    }

    .climob {
        width: 150px !important;
        height: 73px !important;
    }
</style>
