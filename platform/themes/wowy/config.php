<?php

use Botble\Base\Facades\BaseHelper;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these events can be overridden by package config.
    |
    */

    'events' => [

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme) {
            $version = get_cms_version();
            $theme->asset()->usePath()->add('style-css', 'css/style.css', [], [], $version);
            /*Ads India Start*/
            
                /*Ads India CSS Start*/

            $theme->asset()->usePath()->add('ads-bootstrap-min-css', 'css/adsindia/vendor/bootstrap/css/bootstrap.min.css');
            $theme->asset()->usePath()->add('ads-all-min-css', 'css/adsindia/vendor/fontawesome-free/css/all.min.css');
            $theme->asset()->usePath()->add('ads-animate-min-css', 'css/adsindia/vendor/animate/animate.compat.css');
            $theme->asset()->usePath()->add('ads-simple-line-icons-min-css', 'css/adsindia/vendor/simple-line-icons/css/simple-line-icons.min.css');
            $theme->asset()->usePath()->add('ads-owl-carousel-min-css', 'css/adsindia/vendor/owl.carousel/assets/owl.carousel.min.css');
            $theme->asset()->usePath()->add('ads-owl-theme-default-min-css', 'css/adsindia/vendor/owl.carousel/assets/owl.theme.default.min.css');
            $theme->asset()->usePath()->add('ads-magnific-popup-min-css', 'css/adsindia/vendor/magnific-popup/magnific-popup.min.css');
            $theme->asset()->usePath()->add('ads-theme-min-css', 'css/adsindia/adstheme/theme.css');
            $theme->asset()->usePath()->add('ads-theme-elements-css', 'css/adsindia/adstheme/theme-elements.css');
            $theme->asset()->usePath()->add('ads-theme-blog-css', 'css/adsindia/adstheme/theme-blog.css');
            $theme->asset()->usePath()->add('ads-theme-shop-css', 'css/adsindia/adstheme/theme-shop.css');
            $theme->asset()->usePath()->add('ads-swiper-min-css', 'css/adsindia/adstheme/swiper.min.css');

 

            // $theme->asset()->usePath()->add('ads-demo-accounting-1-css', 'css/adsindia/adstheme/demos/demo-accounting-1.css');

            $theme->asset()->usePath()->add('ads-skin-accounting-1-css', 'css/adsindia/adstheme/skins/skin-accounting-1.css');
            $theme->asset()->usePath()->add('custom1-css', 'css/adsindia/adstheme/customwtsapp.css');
            $theme->asset()->usePath()->add('whatsup1-css', 'css/adsindia/adstheme/whatsup.css');
            $theme->asset()->usePath()->add('header', 'css/adsindia/adstheme/header.css');
            $theme->asset()->usePath()->add('footer', 'css/adsindia/adstheme/footerinner.css');
            $theme->asset()->usePath()->add('slider', 'css/adsindia/adstheme/slider.css');
            $theme->asset()->usePath()->add('popup', 'css/adsindia/adstheme/popup.css');
            $theme->asset()->usePath()->add('Ads-home-weare', 'css/adsindia/adstheme/Ads-home-weare.css');
            $theme->asset()->usePath()->add('Ads-dholera-smart-city', 'css/adsindia/adstheme/Ads-dholera-smart-city.css');
            $theme->asset()->usePath()->add('Ads-transport-dholera-smart-city', 'css/adsindia/adstheme/Ads-transport-dholera-smart-city.css');
            $theme->asset()->usePath()->add('Ads-services', 'css/adsindia/adstheme/Ads-services.css');
            $theme->asset()->usePath()->add('Ads-dark', 'css/adsindia/adstheme/Ads-dark.css');

                /*Ads India CSS End*/

                /*Ads India JS Start*/
                // $theme->asset()->container('footer')->usePath()->add('popup', 'css/adsindia/js/views/popup.js');
            $theme->asset()->container('footer')->usePath()->add('ads-plugins-min-js', 'css/adsindia/vendor/plugins/js/plugins.min.js');
			

           	$theme->asset()->container('footer')->usePath()->add('ads-theme-js', 'css/adsindia/js/theme.js');
            $theme->asset()->container('footer')->usePath()->add('ads-demo-accounting-1-js', 'css/adsindia/js/demos/demo-accounting-1.js');
            $theme->asset()->container('footer')->usePath()->add('ads-theme-init-js', 'css/adsindia/js/theme.init.js');
            $theme->asset()->container('footer')->usePath()->add('ads-view-contact-js', 'css/adsindia/js/views/view.contact.js');
            $theme->asset()->container('footer')->usePath()->add('whatsup-js', 'css/adsindia/js/views/whatsup.js');
            // $theme->asset()->container('footer')->usePath()->add('popup', 'css/adsindia/js/views/popup.js');

           
       
            $theme->asset()->container('footer')->usePath()->add('backend', 'js/backend.js', [], [], $version);

            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post', 'ecommerce.product'], function (View $view) {
                    $view->withShortcodes();
                });
            }
        },
    ],
];
