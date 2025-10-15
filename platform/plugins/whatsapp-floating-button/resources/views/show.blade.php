<div id="whatsapp-floating-button"></div>

<?php
$wpemail = DB::table('settings')->where('key', 'whatsapp-floating-button.email')->first();
$wppopup_title = DB::table('settings')->where('key', 'whatsapp-floating-button.popup_title')->first();
$wppopup_message = DB::table('settings')->where('key', 'whatsapp-floating-button.popup_message')->first();
$wprole = DB::table('settings')->where('key', 'whatsapp-floating-button.role')->first();
$wpcompnyname = DB::table('settings')->where('key', 'whatsapp-floating-button.compnyname')->first();

// dd($wp);

?>

{{-- 
<style>

    
    #whatsapp-floating-button {
        left: {{ setting('whatsapp-floating-button.position', 'right') ? 'auto' : setting('whatsapp-floating-button.offset_x', 20) . 'px' }} !important;
        right: {{ setting('whatsapp-floating-button.position', 'right') ? setting('whatsapp-floating-button.offset_x', 20) . 'px' : 'auto' }} !important;
        bottom: {{ setting('whatsapp-floating-button.offset_y', 20) }}px !important;
    }
</style>
<script>
    window.addEventListener('load', function() {
        const whatsappFloatingButton = document.getElementById('whatsapp-floating-button');

        if (whatsappFloatingButton) {
            $(whatsappFloatingButton).floatingWhatsApp({
                phone: "{{ setting('whatsapp-floating-button.phone_number') }}",
                popupMessage: "{{ Str::limit(setting('whatsapp-floating-button.popup_message'), 220)}}",
                showPopup: "{{ setting('whatsapp-floating-button.show_popup', false) }}",
                headerTitle: "{{ setting('whatsapp-floating-button.popup_title') }}",
                position: "{{ setting('whatsapp-floating-button.position', 'right') }}",
                size: "{{ setting('whatsapp-floating-button.size', 60) }}px",
                backgroundColor: '#25D366',
                showOnIE: !0,
                autoOpenTimeout: 0,
                headerColor: '#128C7E',
                zIndex: {{ setting('whatsapp-floating-button.z_index', 999) }},
            });
        }
    });
</script> --}}

<div id="qlwapp" class="qlwapp qlwapp-free qlwapp-bubble qlwapp-bottom-left qlwapp-all qlwapp-rounded">
    <div class="qlwapp-container">
        <div class="qlwapp-box">
            <div class="qlwapp-header">
                <i class="qlwapp-close" data-action="close">&times;</i>
                <div class="qlwapp-description">
                    <div class="qlwapp-description-container">
                        <h3>{{ $wppopup_title->value ?? '' }}</h3>
                        <p> {{ $wppopup_message->value ?? '' }}</p><a
                            href="mailto:{{ $wpemail->value ?? '' }}">{{ $wpemail->value ?? '' }}</a>
                    </div>
                </div>
            </div>
            <div class="qlwapp-body">
                @if (theme_option('phone'))
                    <a class="qlwapp-account" data-action="open" data-phone="{{ theme_option('phone') }}"
                        data-message="Hello! I just visited your website and am interested in Know more about your projects. I have one query"
                        role="button" tabindex="0" target="_blank">

                        <div class="qlwapp-avatar">
                            <div class="qlwapp-avatar-container">
                                <img alt="SCRJ Group" data-src="{{ asset('storage/favicon.png') }}"
                                    style="height: 48px;"
                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    class="lazyload"
                                    style="--smush-placeholder-width: 300px; --smush-placeholder-aspect-ratio: 300/140;">
                            </div>
                        </div>
                        <div class="qlwapp-info">
                            <span class="qlwapp-label">{{ $wprole->value ?? '' }} <strong
                                    style="font-size: 16px;
                                  color: #D2B579;">Click
                                    Here</strong></span>
                            <span class="qlwapp-name">{!! $wpcompnyname->value ?? '' !!}</span>
                        </div>
                    </a>
                @endif
            </div>
            <div class="qlwapp-footer">
                <p>Power by Ads India in SCRJ</p>
            </div>
        </div>
        @if (theme_option('phone'))
            <a class="qlwapp-toggle" data-action="box" data-phone="{{ theme_option('phone') }}"
                data-message="Hello! I just visited your website and am interested in Know more about your projects. I have one query"
                role="button" tabindex="0" target="_blank">
        @endif
        <!-- <i class="qlwapp-icon qlwapp-whatsapp-icon"></i>
    <i class="qlwapp-close" data-action="close">&times;</i> -->
        <img loading="lazy" src="{{ asset('themes/wowy/ads/img/wt.png') }}" alt="whatsapp" style="width: 65px;">
        <i class="qlwapp-close" style=" background: #000;" data-action="close">&times;</i>
        </a>
    </div>
     
</div>
