<div class="container-fluid  pb-5 paddingleftrighttransport">
    <div class="row align-items-normal  lblb csslb">
        <div class="col-lg-6  mb-lg-0 bottomtransport">
            <div class="appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0">
                <span
                    class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5  py-2"><span
                        class="d-inline-flex py-1 px-2">Technological Advancements in a Smart City Framework
                    </span></span>
            </div>

        </div>
        <div class="col-lg-6 p-relative leftalign">
            <div class="appear-animation animated fadeInUpShorter appear-animation-visible"
                data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                style="animation-delay: 400ms;">
                @if ($description)
                    <p class="mb-0 ">{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6 mb-5 mb-lg-0 paddingtransport">

            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                <div class="owl-carousel owl-theme custom-carousel"
                    data-plugin-options="{'items': 1, 'autoplay': true, 'dots': false, 'nav': true, 'navText': [], 'autoplayTimeout': 5000, 'margin': 10, 'animateOut': 'fadeOut'}">

                    <div>
                        <img class="img-fluid border-radius-2 lbweare smallhomeheight"
                            src="{{ asset('themes/wowy/ads/images/home/trans.jpg') }}" alt="generic-14">
                    </div>
                    <div>
                        <img class="img-fluid border-radius-2 lbweare smallhomeheight"
                            src="{{ asset('themes/wowy/ads/images/home/trans1.jpg') }}" alt="generic-15">
                    </div>
                    <div>
                        <img class="img-fluid border-radius-2 lbweare smallhomeheight"
                            src="{{ asset('themes/wowy/ads/images/home/trans2.jpg') }}" alt="generic-15">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6  display">
            <h2 class="text-9 text-lg-12  line-height-1 mb-2 smalltransport dholerawidth "
                style="margin-bottom: 15px !important;font-weight: 500 !important;">Why Invest in Dholera Smart City?
            </h2>
            <div class="col-lg-3 weight ">
                <div class="feature-box feature-box-secondary  ">
                    <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                        <i class="fa-solid fa-road"></i>

                    </div>
                    <div class="feature-box-info ps-3">
                        <strong class="d-block text-4-5 text-dark  sizeads transportsize"> Strategic Location:</strong>

                        <p class="mb-0" id="limited-text">
                            Located along the Delhi-Mumbai Industrial Corridor (DMIC), Dholera benefits from rapid,
                            seamless connectivity to major cities like Ahmedabad, Bhavnagar, and Vadodara.
                        </p>


                    </div>
                </div>

                <div class="feature-box feature-box-secondary mt-4 ">
                    <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                        <i class="fa-brands fa-accessible-icon"></i>
                    </div>
                    <div class="feature-box-info ps-3">
                        <strong class="d-block text-4-5 text-dark sizeads transportsize">Robust Government
                            Backing:</strong>

                        <p class="mb-0" id="smart-city-text">
                            As a flagship project under India’s Smart Cities Mission, Dholera enjoys
                            continuous policy incentives and financial support, ensuring sustainable growth and
                            long-term value.
                        </p>


                        <p class="mb-0  pb-3"><a href="mailto:{{ theme_option('contact_email2') }}"
                                class="text-color-secondary text-color-hover-primary font-weight-semi-bold text-decoration-underline">{{ theme_option('contact_email2') }}</a>

                        </p>

                    </div>
                </div>

            </div>
            <div class="col-lg-3 weight">


                <div class="feature-box feature-box-secondary">
                    <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                        <i class="fa-solid fa-meteor"></i>
                    </div>
                    <div class="feature-box-info ps-3">
                        <strong class="d-block text-4-5 text-dark transportsize">Early Investment Advantage:</strong>

                        <p class="mb-0" id="greenfield-text">
                            Being a greenfield project, early investors stand to gain from significant
                            property value appreciation and business expansion as the city develops from the ground
                            up.
                        </p>


                    </div>
                </div>
                <br>
                <div class="feature-box feature-box-secondary">
                    <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                        <i class="fa-solid fa-plane"></i>
                    </div>
                    <div class="feature-box-info ps-3">
                        <strong class="d-block text-4-5 text-dark transportsize">Future-Proof Urban
                            Development:</strong>

                        <p class="mb-0" id="tech-text">
                            With its integration of advanced technology, eco-friendly infrastructure, and
                            strategic planning, Dholera represents a forward-thinking approach to
                            urbanization—making it a smart investment for the future.
                        </p>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function limitWordsByScreenSizeTech() {
        const p = document.getElementById("tech-text");
        const fullText =
            "With its integration of advanced technology, eco-friendly infrastructure, and strategic planning, Dholera represents a forward-thinking approach to urbanization—making it a smart investment for the future.";

        const mediaQuery1 = window.matchMedia("(min-width: 1160px) and (max-width: 1640px)");
        const mediaQuery2 = window.matchMedia("(min-device-width: 1000px) and (max-device-width: 1366px)");

        if (mediaQuery2.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 8).join(" ");
            p.textContent = limitedText + (words.length > 8 ? "..." : "");
        } else if (mediaQuery1.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 15).join(" ");
            p.textContent = limitedText + (words.length > 15 ? "..." : "");
        } else {
            p.textContent = fullText;
        }
    }

    window.addEventListener("load", limitWordsByScreenSizeTech);
    window.addEventListener("resize", limitWordsByScreenSizeTech);
</script>

<script>
    function limitWordsByScreenSizeGreenfield() {
        const p = document.getElementById("greenfield-text");
        const fullText =
            "Being a greenfield project, early investors stand to gain from significant property value appreciation and business expansion as the city develops from the ground up.";
        const mediaQuery1 = window.matchMedia("(min-width: 1160px) and (max-width: 1640px)");
        const mediaQuery2 = window.matchMedia("(min-device-width: 1000px) and (max-device-width: 1366px)");

        if (mediaQuery2.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 8).join(" ");
            p.textContent = limitedText + (words.length > 8 ? "..." : "");
        } else if (mediaQuery1.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 15).join(" ");
            p.textContent = limitedText + (words.length > 15 ? "..." : "");
        } else {
            p.textContent = fullText;
        }
    }

    window.addEventListener("load", limitWordsByScreenSizeGreenfield);
    window.addEventListener("resize", limitWordsByScreenSizeGreenfield);
</script>
<script>
    function limitWordsByScreenSizeSmartCity() {
        const p = document.getElementById("smart-city-text");
        const fullText =
            "As a flagship project under India’s Smart Cities Mission, Dholera enjoys continuous policy incentives and financial support, ensuring sustainable growth and long-term value.";

        const mediaQuery1 = window.matchMedia("(min-width: 1160px) and (max-width: 1640px)");
        const mediaQuery2 = window.matchMedia("(min-device-width: 1000px) and (max-device-width: 1366px)");

        if (mediaQuery2.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 8).join(" ");
            p.textContent = limitedText + (words.length > 8 ? "..." : "");
        } else if (mediaQuery1.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 15).join(" ");
            p.textContent = limitedText + (words.length > 15 ? "..." : "");
        } else {
            p.textContent = fullText;
        }
    }

    window.addEventListener("load", limitWordsByScreenSizeSmartCity);
    window.addEventListener("resize", limitWordsByScreenSizeSmartCity);
</script>
<script>
    function limitWordsByScreenSize() {
        const p = document.getElementById("limited-text");
        const fullText =
            "Located along the Delhi-Mumbai Industrial Corridor (DMIC), Dholera benefits from rapid, seamless connectivity to major cities like Ahmedabad, Bhavnagar, and Vadodara.";

        const mediaQuery1 = window.matchMedia("(min-width: 1160px) and (max-width: 1640px)");
        const mediaQuery2 = window.matchMedia("(min-device-width: 1000px) and (max-device-width: 1366px)");

        if (mediaQuery2.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 8).join(" ");
            p.textContent = limitedText + (words.length > 8 ? "..." : "");
        } else if (mediaQuery1.matches) {
            const words = fullText.split(" ");
            const limitedText = words.slice(0, 15).join(" ");
            p.textContent = limitedText + (words.length > 15 ? "..." : "");
        } else {
            p.textContent = fullText;
        }
    }

    window.addEventListener("load", limitWordsByScreenSize);
    window.addEventListener("resize", limitWordsByScreenSize);
</script>
