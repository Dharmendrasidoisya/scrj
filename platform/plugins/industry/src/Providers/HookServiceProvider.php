<?php

namespace Botble\Industry\Providers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Industry\Models\Category;
use Botble\Industry\Models\Post;
use Botble\Industry\Models\Tag;
use Botble\Industry\Industry\IndustryService;
use Botble\Dashboard\Events\RenderingDashboardWidgets;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Media\Facades\RvMedia;
use Botble\Menu\Events\RenderingMenuOptions;
use Botble\Menu\Facades\Menu;
use Botble\Page\Models\Page;
use Botble\Page\Tables\PageTable;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Facades\Shortcode as ShortcodeFacade;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Slug\Models\Slug;
use Botble\Theme\Events\RenderingAdminBar;
use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\AdminBar;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Menu::addMenuOptionModel(Category::class);
        Menu::addMenuOptionModel(Tag::class);

        $this->app['events']->listen(RenderingMenuOptions::class, function () {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        });

        $this->app['events']->listen(RenderingDashboardWidgets::class, function () {
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 21, 2);
        });

        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2);

        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderIndustryPage'], 2, 2);
        }

        PageTable::beforeRendering(function () {
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        });

        $this->app['events']->listen(RenderingAdminBar::class, function () {
            AdminBar::registerLink(
                trans('plugins/industry::posts.post'),
                route('industryposts.create'),
                'add-new',
                'industryposts.create'
            );
        });

        if (function_exists('add_shortcode')) {
            shortcode()
                ->register(
                    $shortcodeName = 'industry-industryposts',
                    trans('plugins/industry::base.short_code_name'),
                    trans('plugins/industry::base.short_code_description'),
                    [$this, 'renderIndustryindustryposts']
                )
                ->setAdminConfig(
                    $shortcodeName,
                    function (array $attributes) {
                        $industrycategories = Category::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all();

                        return ShortcodeForm::createFromArray($attributes)
                            ->add('paginate', 'number', [
                                'label' => trans('plugins/industry::base.number_industryposts_per_page'),
                                'attr' => [
                                    'placeholder' => trans('plugins/industry::base.number_industryposts_per_page'),
                                ],
                            ])
                            ->add(
                                'category_ids[]',
                                SelectField::class,
                                SelectFieldOption::make()
                                    ->label(__('Select industrycategories'))
                                    ->choices($industrycategories)
                                    ->when(Arr::get($attributes, 'category_ids'), function (SelectFieldOption $option, $industrycategoriesIds) {
                                        $option->selected(explode(',', $industrycategoriesIds));
                                    })
                                    ->multiple()
                                    ->searchable()
                                    ->helperText(__('Leave industrycategories empty if you want to show industryposts from all industrycategories.'))
                                    ->toArray()
                            );
                    }
                );
        }

        $this->app['events']->listen(RenderingThemeOptionSettings::class, function () {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        });

        if (defined('THEME_FRONT_HEADER') && setting('industry_post_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $post) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($post) {
                    if (! $post instanceof Post) {
                        return $html;
                    }

                    $schemaType = setting('industry_post_schema_type', 'NewsArticle');

                    if (! in_array($schemaType, ['NewsArticle', 'News', 'Article', 'IndustryPosting'])) {
                        $schemaType = 'NewsArticle';
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => $schemaType,
                        'mainEntityOfPage' => [
                            '@type' => 'WebPage',
                            '@id' => $post->url,
                        ],
                        'headline' => BaseHelper::clean($post->name),
                        'description' => BaseHelper::clean($post->description),
                        'image' => [
                            '@type' => 'ImageObject',
                            'url' => RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()),
                        ],
                        'author' => [
                            '@type' => 'Person',
                            'url' => fn () => BaseHelper::getHomepageUrl(),
                            'name' => class_exists($post->author_type) ? $post->author->name : '',
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => theme_option('site_title'),
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                            ],
                        ],
                        'datePublished' => $post->created_at->toDateString(),
                        'dateModified' => $post->updated_at->toDateString(),
                    ];

                    return $html . Html::tag('script', json_encode($schema), ['type' => 'industry/ld+json'])
                            ->toHtml();
                }, 35);
            }, 35, 2);
        }
    }

    public function addThemeOptions(): void
    {
        $pages = Page::query()
            ->wherePublished()
            ->pluck('name', 'id')
            ->all();

        theme_option()
            ->setSection([
                'title' => trans('plugins/industry::base.settings.title'),
                'id' => 'opt-text-subsection-industry',
                'subsection' => true,
                'icon' => 'ti ti-edit',
                'fields' => [
                    [
                        'id' => 'industry_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/industry::base.industry_page_id'),
                        'attributes' => [
                            'name' => 'industry_page_id',
                            'list' => [0 => trans('plugins/industry::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_industryposts_in_a_category',
                        'type' => 'number',
                        'label' => trans('plugins/industry::base.number_industryposts_per_page_in_category'),
                        'attributes' => [
                            'name' => 'number_of_industryposts_in_a_category',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_industryposts_in_a_tag',
                        'type' => 'number',
                        'label' => trans('plugins/industry::base.number_industryposts_per_page_in_tag'),
                        'attributes' => [
                            'name' => 'number_of_industryposts_in_a_tag',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ]);
    }

    public function registerMenuOptions(): void
    {
        if (Auth::guard()->user()->hasPermission('industrycategories.index')) {
            Menu::registerMenuOptions(Category::class, trans('plugins/industry::categories.menu'));
        }

        if (Auth::guard()->user()->hasPermission('industrytags.index')) {
            Menu::registerMenuOptions(Tag::class, trans('plugins/industry::tags.menu'));
        }
    }

    public function registerDashboardWidgets(array $widgets, Collection $widgetSettings): array
    {
        if (! Auth::guard()->user()->hasPermission('industryposts.index')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/industry/js/industry.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('industryposts.index')
            ->setKey('widget_industryposts_recent')
            ->setTitle(trans('plugins/industry::posts.widget_industryposts_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('yellow')
            ->setRoute(route('industryposts.widget.recent-industryposts'))
            ->setBodyClass('')
            ->setColumn('col-md-6 col-sm-6')
            ->init($widgets, $widgetSettings);
    }

    public function handleSingleView(Slug|array $slug): Slug|array
    {
        return (new IndustryService())->handleFrontRoutes($slug);
    }

    public function renderIndustryindustryposts(Shortcode $shortcode): array|string
    {
        $categoryIds = ShortcodeFacade::fields()->getIds('category_ids', $shortcode);

        $industryposts = Post::query()
            ->wherePublished()
            ->orderByDesc('created_at')
            ->with('slugable')
            ->when(! empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereHas('industrycategories', function ($query) use ($categoryIds) {
                    $query->whereIn('industrycategories.id', $categoryIds);
                });
            })
            ->paginate((int)$shortcode->paginate ?: 12);

        $view = 'plugins/industry::themes.templates.industryposts';
        $themeView = Theme::getThemeNamespace() . '::views.templates.industryposts';

        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('industryposts'))->render();
    }

    public function renderIndustryPage(string|null $content, Page $page): string|null
    {
        if ($page->getKey() == $this->getIndustryPageId()) {
            $view = 'plugins/industry::themes.loop';

            if (view()->exists($viewPath = Theme::getThemeNamespace() . '::views.loop')) {
                $view = $viewPath;
            }

            return view($view, [
                'industryposts' => get_all_industryposts(true, (int)theme_option('number_of_industryposts_in_a_category', 12)),
            ])->render();
        }

        return $content;
    }

    public function addAdditionNameToPageName(string|null $name, Page $page): string|null
    {
        if ($page->getKey() == $this->getIndustryPageId()) {
            $subTitle = Html::tag('span', trans('plugins/industry::base.industry_page'), ['class' => 'additional-page-name'])
                ->toHtml();

            if (Str::contains($name, ' —')) {
                return $name . ', ' . $subTitle;
            }

            return $name . ' —' . $subTitle;
        }

        return $name;
    }

    protected function getIndustryPageId(): int|string|null
    {
        return theme_option('industry_page_id', setting('industry_page_id'));
    }
}
