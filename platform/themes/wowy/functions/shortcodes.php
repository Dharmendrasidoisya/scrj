<?php

use Botble\Ads\Facades\AdsManager;
use Botble\Ads\Models\Ads;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Models\FlashSale;
use Botble\Ecommerce\Repositories\Interfaces\ProductCategoryInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

app()->booted(function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('simple-slider')) {
        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function () {
            return Theme::getThemeNamespace() . '::partials.shortcodes.sliders.main';
        }, 120);
    }

    add_shortcode('site-features', __('Site features'), __('Site features'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.site-features', compact('shortcode'));
    });

    shortcode()->setAdminConfig('site-features', function (array $attributes) {
        return Theme::partial('shortcodes.site-features-admin-config', compact('attributes'));
    });



    if (is_plugin_active('blog')) {

        add_shortcode(
            'Ads-blogs',
            __('Ads Blogs'),
            __('Ads Blogs'),

            function (Shortcode $shortcode) {
                $posts = get_featured_blog_posts(array_merge([
                    'take' => (int)$shortcode->limit ?: 50,
                ],));
                // dd($posts);
                return Theme::partial('shortcodes.Ads-blogs', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'shortcode' => $shortcode,
                    'posts' => $posts,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-blogs', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-blogs-admin-config', compact('attributes'));
        });
    }

    add_shortcode(
        'Ads-news',
        __('Ads News'),
        __('Ads News'),

        function (Shortcode $shortcode) {
            $posts = get_featured_blog_posts(array_merge([
                'take' => (int)$shortcode->limit ?: 50,
            ],));
            // dd($posts);
            return Theme::partial('shortcodes.Ads-news', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'icon' => $shortcode->icon, // Include the image attribute
                'shortcode' => $shortcode,
                'posts' => $posts,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-news', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-news-admin-config', compact('attributes'));
    });


    if (is_plugin_active('projects')) {

        add_shortcode(
            'Ads-services',
            __('Ads Services'),
            __('Ads Services'),

            function (Shortcode $shortcode) {
                $services = get_featured_projects_posts(array_merge([
                    'take' => (int)$shortcode->limit ?: 50,
                ],));
               
                return Theme::partial('shortcodes.Ads-services', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'shortcode' => $shortcode,
                    'services' => $services,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-services', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-services-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('projects')) {

        add_shortcode(
            'Ads-servicescategory',
            __('Ads Servicescategory'),
            __('Ads Servicescategory'),

            function (Shortcode $shortcode) {
                $servicescategory = get_featured_projects_categories(array_merge([
                    'take' => (int)$shortcode->limit ?: 50,
                ],));
                return Theme::partial('shortcodes.Ads-servicescategory', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'shortcode' => $shortcode,
                    'servicescategory' => $servicescategory,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-servicescategory', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-servicescategory-admin-config', compact('attributes'));
        });
    }
    if (is_plugin_active('ecommerce')) {
        add_shortcode(
            'featured-product-categories',
            __('Featured Product Categories'),
            __('Featured Product Categories'),
            function (Shortcode $shortcode) {
                $categories = get_featured_product_categories();

                return Theme::partial('shortcodes.featured-product-categories', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'categories' => $categories,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('featured-product-categories', function (array $attributes) {
            return Theme::partial('shortcodes.featured-product-categories-admin-config', compact('attributes'));
        });



        add_shortcode('featured-products', __('Featured products'), __('Featured products'), function (Shortcode $shortcode) {
            if (! is_plugin_active('ecommerce')) {
                return null;
            }

            $products = get_featured_products(array_merge([
                'take' => (int)$shortcode->limit ?: 8,
            ], EcommerceHelper::withReviewsParams()));

            return Theme::partial('shortcodes.featured-products', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'products' => $products,
                'shortcode' => $shortcode,
            ]);
        });

        shortcode()->setAdminConfig('featured-products', function (array $attributes) {
            return Theme::partial('shortcodes.featured-products-admin-config', compact('attributes'));
        });

        add_shortcode('flash-sale', __('Flash sale'), __('Flash sale'), function (Shortcode $shortcode) {
            $flashSales = FlashSale::query()
                ->notExpired()
                ->wherePublished()
                ->get();

            if (! $flashSales->count()) {
                return null;
            }

            $flashSale = $flashSales->first();

            if (! $flashSale || ! $flashSale->products->count()) {
                return null;
            }

            foreach ($flashSales as $item) {
                $item->load([
                    'products' => function (BelongsToMany $query) use ($shortcode) {
                        $reviewParams = EcommerceHelper::withReviewsParams();

                        if (EcommerceHelper::isReviewEnabled()) {
                            $query->withAvg($reviewParams['withAvg'][0], $reviewParams['withAvg'][1]);
                        }

                        return $query
                            ->wherePublished()
                            ->limit((int)$shortcode->limit ?: 2)
                            ->withCount($reviewParams['withCount'])
                            ->with(EcommerceHelper::withProductEagerLoadingRelations());
                    },
                ]);
            }

            return Theme::partial('shortcodes.flash-sale', [
                'title' => $shortcode->title,
                'showPopup' => $shortcode->show_popup,
                'flashSale' => $flashSale,
                'flashSales' => $flashSales,
            ]);
        });

        shortcode()->setAdminConfig('flash-sale', function (array $attributes) {
            return Theme::partial('shortcodes.flash-sale-admin-config', compact('attributes'));
        });

        add_shortcode(
            'product-collections',
            __('Product Collections'),
            __('Product Collections'),
            function (Shortcode $shortcode) {
                $productCollections = get_product_collections(
                    ['status' => BaseStatusEnum::PUBLISHED],
                    [],
                    ['id', 'name', 'slug']
                );

                if ($productCollections->isEmpty()) {
                    return null;
                }

                $limit = (int)$shortcode->limit ?: 8;

                $products = get_products_by_collections(array_merge([
                    'collections' => [
                        'by' => 'id',
                        'value_in' => [$productCollections->first()->id],
                    ],
                    'take' => $limit,
                    'with' => EcommerceHelper::withProductEagerLoadingRelations(),
                ], EcommerceHelper::withReviewsParams()));

                return Theme::partial('shortcodes.product-collections', [
                    'title' => $shortcode->title,
                    'productCollections' => $productCollections,
                    'limit' => $limit,
                    'products' => $products,
                ]);
            }
        );

        shortcode()->setAdminConfig('product-collections', function (array $attributes) {
            return Theme::partial('shortcodes.product-collections-admin-config', compact('attributes'));
        });

        add_shortcode(
            'product-category-products',
            __('Product category products'),
            __('Product category products'),
            function (Shortcode $shortcode) {
                $category = app(ProductCategoryInterface::class)->getFirstBy(
                    [
                        'status' => BaseStatusEnum::PUBLISHED,
                        'id' => (int)$shortcode->category_id,
                    ],
                    ['*'],
                    [
                        'activeChildren' => function ($query) {
                            return $query->limit(3);
                        },
                    ]
                );

                if (! $category) {
                    return null;
                }

                $limit = (int)$shortcode->limit ?: 8;

                $products = app(ProductInterface::class)->getProductsByCategories(array_merge([
                    'categories' => [
                        'by' => 'id',
                        'value_in' => array_merge([$category->id], $category->activeChildren->pluck('id')->all()),
                    ],
                    'take' => $limit,
                ], EcommerceHelper::withReviewsParams()));

                return Theme::partial('shortcodes.product-category-products', compact('category', 'products', 'limit'));
            }
        );

        shortcode()->setAdminConfig('product-category-products', function (array $attributes) {
            $categories = app(ProductCategoryInterface::class)->pluck(
                'name',
                'id',
                ['status' => BaseStatusEnum::PUBLISHED]
            );

            return Theme::partial(
                'shortcodes.product-category-products-admin-config',
                compact('categories', 'attributes')
            );
        });

        add_shortcode('featured-brands', __('Featured Brands'), __('Featured Brands'), function (Shortcode $shortcode) {
            $brands = get_featured_brands();

            return Theme::partial('shortcodes.featured-brands', [
                'title' => $shortcode->title,
                'brands' => $brands,
                'shortcode' => $shortcode,
            ]);
        });

        shortcode()->setAdminConfig('featured-brands', function (array $attributes) {
            return Theme::partial('shortcodes.featured-brands-admin-config', compact('attributes'));
        });
    }



    if (is_plugin_active('ads')) {
        add_shortcode('theme-ads', __('Theme ads'), __('Theme ads'), function (Shortcode $shortcode) {
            $keys = get_ads_keys_from_shortcode($shortcode);

            return display_ads($keys);
        });

        shortcode()->setAdminConfig('theme-ads', function (array $attributes) {
            $ads = Ads::query()
                ->wherePublished()
                ->notExpired()
                ->get();

            return Theme::partial('shortcodes.ads.config-in-admin', compact('ads', 'attributes'));
        });

        AdsManager::load();

        function display_ad($ads, $class = ''): ?string
        {
            if (! ($ads instanceof BaseModel)) {
                $ads = AdsManager::getData()
                    ->where('key', $ads)
                    ->first();
            }

            if (! $ads || ! $ads->image) {
                return null;
            }

            if (
                $ads->location &&
                $ads->location != 'not_set' &&
                view()->exists(Theme::getThemeNamespace() . '::partials.shortcodes.ads.' . $ads->location)
            ) {
                return Theme::partial('shortcodes.ads.' . $ads->location, compact('ads', 'class'));
            }

            return Theme::partial('shortcodes.ads.item', compact('ads', 'class'));
        }

        function get_ads_keys_from_shortcode(Shortcode $shortcode): array
        {
            $keys = collect($shortcode->toArray())
                ->sortKeys()
                ->filter(function ($value, $key) use ($shortcode) {
                    return Str::startsWith($key, 'ads_') ||
                        ($shortcode->name == 'theme-ads' && Str::startsWith($key, 'key_'));
                });

            return array_filter($keys->toArray() + [$shortcode->ads]);
        }

        function display_ads(array $keys): string
        {
            $keys = collect($keys);

            return Theme::partial('shortcodes.ads.items', compact('keys'));
        }

        if (is_plugin_active('simple-slider')) {
            add_filter(SHORTCODE_REGISTER_CONTENT_IN_ADMIN, function ($data, $key, $attributes) {
                if ($key == 'simple-slider') {
                    $ads = Ads::query()
                        ->wherePublished()
                        ->notExpired()
                        ->get();

                    return $data . Theme::partial('shortcodes.includes.autoplay-settings', compact('attributes')) . Theme::partial('shortcodes.ads.config-in-admin', compact('ads', 'attributes'));
                }

                return $data;
            }, 50, 3);
        }
    }

    if (is_plugin_active('blog')) {
        add_shortcode('featured-news', __('Featured News'), __('Featured News'), function (Shortcode $shortcode) {
            $posts = app(PostInterface::class)->getFeatured(4, ['slugable', 'categories', 'categories.slugable']);

            return Theme::partial('shortcodes.featured-news', ['title' => $shortcode->title, 'posts' => $posts]);
        });

        shortcode()->setAdminConfig('featured-news', function (array $attributes) {
            return Theme::partial('shortcodes.featured-news-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace() . '::partials.shortcodes.contact-form';
        }, 120);
    }

    if (is_plugin_active('newsletter')) {
        add_shortcode('newsletter-form', __('Newsletter Form'), __('Newsletter Form'), function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.newsletter-form', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
            ]);
        });

        shortcode()->setAdminConfig('newsletter-form', function (array $attributes) {
            return Theme::partial('shortcodes.newsletter-form-admin-config', compact('attributes'));
        });
    }

    add_shortcode('our-offices', __('Our offices'), __('Our offices'), function () {
        return Theme::partial('shortcodes.our-offices');
    });

    shortcode()->setAdminConfig('our-offices', function (array $attributes) {
        return Theme::partial('shortcodes.our-offices-admin-config', compact('attributes'));
    });

    if (is_plugin_active('faq')) {
        add_shortcode(
            'faqs',
            __('FAQs'),
            __('List of FAQs'),
            function (Shortcode $shortcode) {
                $params = [
                    'condition' => [
                        'status' => BaseStatusEnum::PUBLISHED,
                    ],
                    'with' => [
                        'faqs' => function ($query) {
                            $query->wherePublished();
                        },
                    ],
                    'order_by' => [
                        'faq_categories.order' => 'ASC',
                        'faq_categories.created_at' => 'DESC',
                    ],
                ];

                if ($shortcode->category_id) {
                    $params['condition']['id'] = $shortcode->category_id;
                }

                $categories = app(FaqCategoryInterface::class)->advancedGet($params);

                return Theme::partial('shortcodes.faqs', [
                    'categories' => $categories,
                    'title' => $shortcode->title,
                    'description' => $shortcode->description,
                    'description2' => $shortcode->description2,
					  'description3' => $shortcode->description3,
                    'description4' => $shortcode->description4,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('faqs', function (array $attributes) {
            $categories = app(FaqCategoryInterface::class)->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

            return Theme::partial('shortcodes.faqs-admin-config', compact('attributes', 'categories'));
        });
    }
    // add_shortcode(
    //     'section',
    //     __('SECTION'),
    //     __('List of FAQs'),
    //     function (Shortcode $shortcode) {
    //         $params = [
    //             'condition' => [
    //                 'status' => BaseStatusEnum::PUBLISHED,
    //             ],
    //             'with' => [
    //                 'section' => function ($query) {
    //                     $query->wherePublished();
    //                 },
    //             ],
    //             'order_by' => [
    //                 'faq_categories.order' => 'ASC',
    //                 'faq_categories.created_at' => 'DESC',
    //             ],
    //         ];

    //         if ($shortcode->category_id) {
    //             $params['condition']['id'] = $shortcode->category_id;
    //         }

    //         $categories = app(FaqCategoryInterface::class)->advancedGet($params);

    //         return Theme::partial('shortcodes.section', [
    //             'categories' => $categories,
    //             'title' => $shortcode->title,
    //             'description' => $shortcode->description,
    //             'description2' => $shortcode->description2,
    //             'shortcode' => $shortcode,
    //         ]);
    //     }
    // );

    // shortcode()->setAdminConfig('section', function (array $attributes) {
    //     $categories = app(FaqCategoryInterface::class)->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

    //     return Theme::partial('shortcodes.section-admin-config', compact('attributes', 'categories'));
    // });

    // if (is_plugin_active('projects')) {
    //     add_shortcode(
    //         'Ads-section',
    //         __('Ads section'),
    //         __('Ads section'),
    //         function (Shortcode $shortcode) {
    //             return Theme::partial('shortcodes.Ads-popup', [
    //                 'title' => $shortcode->title,
    //                 'description' => $shortcode->description,
    //                 'description2' => $shortcode->description2,
    //                 'description3' => $shortcode->description3,

    //                 'shortcode' => $shortcode,
    //             ]);
    //         }
    //     );

    //     shortcode()->setAdminConfig('section', function (array $attributes) {
    //         return Theme::partial('shortcodes.section-admin-config', compact('attributes'));
    //     });
    // }
	 add_shortcode(
        'channelpartner-form',
        __('channelpartner-form'),
        __('channelpartner-form'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.channelpartner-form', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'description2' => $shortcode->description2,
                'description3' => $shortcode->description3,
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('channelpartner-form', function (array $attributes) {
        return Theme::partial('shortcodes.channelpartner-form-admin-config', compact('attributes'));
    });
  add_shortcode(
        'Ads-homepopup',
        __('Ads homepopup'),
        __('Ads homepopup'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-homepopup', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'description2' => $shortcode->description2,
                'description3' => $shortcode->description3,
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-homepopup', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-homepopup-admin-config', compact('attributes'));
    });

    add_shortcode(
        'Ads-darksection',
        __('Ads Darksection'),
        __('Ads Darksection'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-darksection', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'description2' => $shortcode->description2,
                'description3' => $shortcode->description3,

                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-darksection', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-darksection-admin-config', compact('attributes'));
    });

    //ads india extra code for wowy
    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-popup',
            __('Ads Popup'),    
            __('Ads Popup'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-popup', [
                    'title' => $shortcode->title,
                    'description' => $shortcode->description,
                    'description2' => $shortcode->description2,
                    'description3' => $shortcode->description3,

                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-popup', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-popup-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-slider',
            __('Ads Slider'),
            __('Ads Slider'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-slider', [
                    'title' => $shortcode->title,
                    'description' => $shortcode->description,
                    'description2' => $shortcode->description2,
                    'description3' => $shortcode->description3,

                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-slider', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-slider-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-home-icons',
            __('Ads Home Icons'),
            __('Ads Home Icons'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-icons', [
                    'title' => $shortcode->title,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-icons', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-icons-admin-config', compact('attributes'));
        });
    }


    add_shortcode(
        'Ads-dholera-smart-city',
        __('Ads Dholera Smart City'),
        __('Ads Dholera Smart City'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-dholera-smart-city', [
                'title' => $shortcode->title,
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-dholera-smart-city', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-dholera-smart-city-admin-config', compact('attributes'));
    });




    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-home-weare',
            __('Ads Home Weare'),
            __('Ads Home Weare'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-weare', [
                    'title' => $shortcode->title,
                    'description' => $shortcode->description,
                    'description2' => $shortcode->description2,
                    'description3' => $shortcode->description3,
                    'description4' => $shortcode->description4,
                    'description5' => $shortcode->description5,
                    'description6' => $shortcode->description6,
                    'icon1' => $shortcode->icon1,
                    'icon2' => $shortcode->icon2,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-weare', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-weare-admin-config', compact('attributes'));
        });
    }


    if (is_plugin_active('ecommerce')) {
        add_shortcode(
            'Ads-home-expertise',
            __('Ads Home Expertise'),
            __('Ads Home Expertise'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-expertise', [
                    'title' => $shortcode->title,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-expertise', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-expertise-admin-config', compact('attributes'));
        });
    }
    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-home-excellence',
            __('Ads Home Excellence'),
            __('Ads Home Excellence'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-excellence', [
                    'title' => $shortcode->title,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-excellence', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-excellence-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('projects')) {
        add_shortcode(
            'Ads-home-clientlogo',
            __('Ads Home Clientlogo'),
            __('Ads Home Clientlogo'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-clientlogo', [
                    'title' => $shortcode->title,
                    'icon' => $shortcode->icon,
                    'icon2' => $shortcode->icon2,
                    'icon3' => $shortcode->icon3,
                    'icon4' => $shortcode->icon4,
                    'icon5' => $shortcode->icon5,
                    'icon6' => $shortcode->icon6,
                    'icon7' => $shortcode->icon7,
                    'icon8' => $shortcode->icon8,
                    'icon9' => $shortcode->icon9,
                    'icon10' => $shortcode->icon10,
                    'icon11' => $shortcode->icon11,
                    'icon12' => $shortcode->icon12,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-clientlogo', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-clientlogo-admin-config', compact('attributes'));
        });
    }
    if (is_plugin_active('ecommerce')) {
        add_shortcode(
            'Ads-home-inquiry',
            __('Ads Home Inquiry'),
            __('Ads Home Inquiry'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-home-inquiry', [
                    'title' => $shortcode->title,
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-home-inquiry', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-home-inquiry-admin-config', compact('attributes'));
        });
    }

    // if (is_plugin_active('ecommerce')) {

    add_shortcode(
        'Ads-about-us',
        __('Ads About Us'),
        __('Ads About Us'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-about-us', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'icon' => $shortcode->icon, // Include the image attribute
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-about-us', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-about-us-admin-config', compact('attributes'));
    });


    add_shortcode(
        'Ads-dholera',
        __('Ads About Dholera'),
        __('Ads About Dholera'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-dholera', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'icon' => $shortcode->icon, // Include the image attribute
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-dholera', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-dholera-admin-config', compact('attributes'));
    });


    // }
    if (is_plugin_active('ecommerce')) {

        add_shortcode(
            'Ads-news',
            __('Ads News'),
            __('Ads News'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-news', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-news', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-news-admin-config', compact('attributes'));
        });
    }
    if (is_plugin_active('ecommerce')) {

        add_shortcode(
            'Ads-industry',
            __('Ads Industry'),
            __('Ads Industry'),
            function (Shortcode $shortcode) {
                return Theme::partial('shortcodes.Ads-industry', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'shortcode' => $shortcode,
                ]);
            }
        );

        shortcode()->setAdminConfig('Ads-industry', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-industry-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('solution')) {

        add_shortcode(
            'Ads-solution',
            __('Ads Solution'),
            __('Ads Solution'),
            function (Shortcode $shortcode) {
                $solution = get_featured_sposts(array_merge([
                    'take' => (int)$shortcode->limit ?: 50,
                ],));
                return Theme::partial('shortcodes.Ads-solution', [
                    'title' => $shortcode->title,
                    'headertitle' => $shortcode->headertitle,
                    'description' => $shortcode->description,
                    'icon' => $shortcode->icon, // Include the image attribute
                    'solution' => $solution,
                ]);
            }
            // function (Shortcode $shortcode) {
            //     return Theme::partial('shortcodes.Ads-solution', [
            //         'title' => $shortcode->title,
            //         'headertitle' => $shortcode->headertitle,
            //         'description' => $shortcode->description,
            //         'icon' => $shortcode->icon, // Include the image attribute
            //         'shortcode' => $shortcode,
            //     ]);
            // }
        );

        shortcode()->setAdminConfig('Ads-solution', function (array $attributes) {
            return Theme::partial('shortcodes.Ads-solution-admin-config', compact('attributes'));
        });
    }
    // if (is_plugin_active('ecommerce')) {

    //     add_shortcode(
    //         'Ads-product-categories',
    //         __('Ads Product-categories'),
    //         __('Ads Product-categories'),
    //         function (Shortcode $shortcode) {
    //             return Theme::partial('shortcodes.Ads-product-categories', [
    //                 'title' => $shortcode->title,
    //                 'headertitle' => $shortcode->headertitle,
    //                 'description' => $shortcode->description,
    //                 'icon' => $shortcode->icon, // Include the image attribute
    //                 'shortcode' => $shortcode,
    //             ]);
    //         }
    //     );

    //     shortcode()->setAdminConfig('Ads-product-categories', function (array $attributes) {
    //         return Theme::partial('shortcodes.Ads-product-categories-admin-config', compact('attributes'));
    //     });

    // }

    // if (is_plugin_active('ecommerce')) {
    add_shortcode(
        'Ads-contact',
        __('Ads Contact'),
        __('Ads Contact'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-contact', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-contact', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-contact-admin-config', compact('attributes'));
    });
 add_shortcode(
        'Ads-policy',
        __('Ads policy'),
        __('Ads policy'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-policy', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'icon' => $shortcode->icon, // Include the image attribute
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-policy', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-policy-admin-config', compact('attributes'));
    });
 add_shortcode(
        'Ads-terms',
        __('Ads terms'),
        __('Ads terms'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-terms', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'icon' => $shortcode->icon, // Include the image attribute
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-terms', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-terms-admin-config', compact('attributes'));
    });
    add_shortcode(
        'Ads-transport-dholera-smart-city',
        __('Ads Transport-Dholera-Smart-City'),
        __('Ads Transport-Dholera-Smart-City'),
        function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.Ads-transport-dholera-smart-city', [
                'title' => $shortcode->title,
                'headertitle' => $shortcode->headertitle,
                'description' => $shortcode->description,
                'shortcode' => $shortcode,
            ]);
        }
    );

    shortcode()->setAdminConfig('Ads-transport-dholera-smart-city', function (array $attributes) {
        return Theme::partial('shortcodes.Ads-transport-dholera-smart-city-admin-config', compact('attributes'));
    });

    // }

    // if (is_plugin_active('ecommerce')) {
    //     add_shortcode(
    //         'Ads-contact',
    //         __('Ads Contact'),
    //         __('Ads Contact'),
    //         function (Shortcode $shortcode) {
    //             return Theme::partial('shortcodes.Ads-contact', [
    //                 'title' => $shortcode->title,
    //                 'headertitle' => $shortcode->headertitle,
    //                 'description' => $shortcode->description,
    //                 'shortcode' => $shortcode,
    //             ]);
    //         }
    //     );

    //     shortcode()->setAdminConfig('Ads-contact', function (array $attributes) {
    //         return Theme::partial('shortcodes.Ads-contact-admin-config', compact('attributes'));
    //     });
    // }
});
