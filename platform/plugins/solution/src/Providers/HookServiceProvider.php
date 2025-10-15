<?php

namespace Botble\Solution\Providers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Solution\Models\Category;
use Botble\Solution\Models\Post;
use Botble\Solution\Models\Tag;
use Botble\Solution\Services\SolutionService;
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
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderSolutionPage'], 2, 2);
        }

        PageTable::beforeRendering(function () {
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        });

        $this->app['events']->listen(RenderingAdminBar::class, function () {
            AdminBar::registerLink(
                trans('plugins/solution::posts.post'),
                route('sposts.create'),
                'add-new',
                'sposts.create'
            );
        });

        if (function_exists('add_shortcode')) {
            shortcode()
                ->register(
                    $shortcodeName = 'solution-sposts',
                    trans('plugins/solution::base.short_code_name'),
                    trans('plugins/solution::base.short_code_description'),
                    [$this, 'renderSolutionsposts']
                )
                ->setAdminConfig(
                    $shortcodeName,
                    function (array $attributes) {
                        $scategories = Category::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all();

                        return ShortcodeForm::createFromArray($attributes)
                            ->add('paginate', 'number', [
                                'label' => trans('plugins/solution::base.number_sposts_per_page'),
                                'attr' => [
                                    'placeholder' => trans('plugins/solution::base.number_sposts_per_page'),
                                ],
                            ])
                            ->add(
                                'category_ids[]',
                                SelectField::class,
                                SelectFieldOption::make()
                                    ->label(__('Select scategories'))
                                    ->choices($scategories)
                                    ->when(Arr::get($attributes, 'category_ids'), function (SelectFieldOption $option, $scategoriesIds) {
                                        $option->selected(explode(',', $scategoriesIds));
                                    })
                                    ->multiple()
                                    ->searchable()
                                    ->helperText(__('Leave scategories empty if you want to show sposts from all scategories.'))
                                    ->toArray()
                            );
                    }
                );
        }

        $this->app['events']->listen(RenderingThemeOptionSettings::class, function () {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        });

        if (defined('THEME_FRONT_HEADER') && setting('solution_post_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $post) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($post) {
                    if (! $post instanceof Post) {
                        return $html;
                    }

                    $schemaType = setting('solution_post_schema_type', 'NewsArticle');

                    if (! in_array($schemaType, ['NewsArticle', 'News', 'Article', 'SolutionPosting'])) {
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

                    return $html . Html::tag('script', json_encode($schema), ['type' => 'application/ld+json'])
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
                'title' => trans('plugins/solution::base.settings.title'),
                'id' => 'opt-text-subsection-solution',
                'subsection' => true,
                'icon' => 'ti ti-edit',
                'fields' => [
                    [
                        'id' => 'solution_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/solution::base.solution_page_id'),
                        'attributes' => [
                            'name' => 'solution_page_id',
                            'list' => [0 => trans('plugins/solution::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_sposts_in_a_category',
                        'type' => 'number',
                        'label' => trans('plugins/solution::base.number_sposts_per_page_in_category'),
                        'attributes' => [
                            'name' => 'number_of_sposts_in_a_category',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_sposts_in_a_tag',
                        'type' => 'number',
                        'label' => trans('plugins/solution::base.number_sposts_per_page_in_tag'),
                        'attributes' => [
                            'name' => 'number_of_sposts_in_a_tag',
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
        if (Auth::guard()->user()->hasPermission('scategories.index')) {
            Menu::registerMenuOptions(Category::class, trans('plugins/solution::categories.menu'));
        }

        if (Auth::guard()->user()->hasPermission('stags.index')) {
            Menu::registerMenuOptions(Tag::class, trans('plugins/solution::tags.menu'));
        }
    }

    public function registerDashboardWidgets(array $widgets, Collection $widgetSettings): array
    {
        if (! Auth::guard()->user()->hasPermission('sposts.index')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/solution/js/solution.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('sposts.index')
            ->setKey('widget_sposts_recent')
            ->setTitle(trans('plugins/solution::posts.widget_sposts_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('yellow')
            ->setRoute(route('sposts.widget.recent-sposts'))
            ->setBodyClass('')
            ->setColumn('col-md-6 col-sm-6')
            ->init($widgets, $widgetSettings);
    }

    public function handleSingleView(Slug|array $slug): Slug|array
    {
        return (new SolutionService())->handleFrontRoutes($slug);
    }

    public function renderSolutionsposts(Shortcode $shortcode): array|string
    {
        $categoryIds = ShortcodeFacade::fields()->getIds('category_ids', $shortcode);

        $sposts = Post::query()
            ->wherePublished()
            ->orderByDesc('created_at')
            ->with('slugable')
            ->when(! empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereHas('scategories', function ($query) use ($categoryIds) {
                    $query->whereIn('scategories.id', $categoryIds);
                });
            })
            ->paginate((int)$shortcode->paginate ?: 12);

        $view = 'plugins/solution::themes.templates.sposts';
        $themeView = Theme::getThemeNamespace() . '::views.templates.sposts';

        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('sposts'))->render();
    }

    public function renderSolutionPage(string|null $content, Page $page): string|null
    {
        if ($page->getKey() == $this->getSolutionPageId()) {
            $view = 'plugins/solution::themes.loop';

            if (view()->exists($viewPath = Theme::getThemeNamespace() . '::views.loop')) {
                $view = $viewPath;
            }

            return view($view, [
                'sposts' => get_all_sposts(true, (int)theme_option('number_of_sposts_in_a_category', 12)),
            ])->render();
        }

        return $content;
    }

    public function addAdditionNameToPageName(string|null $name, Page $page): string|null
    {
        if ($page->getKey() == $this->getSolutionPageId()) {
            $subTitle = Html::tag('span', trans('plugins/solution::base.solution_page'), ['class' => 'additional-page-name'])
                ->toHtml();

            if (Str::contains($name, ' —')) {
                return $name . ', ' . $subTitle;
            }

            return $name . ' —' . $subTitle;
        }

        return $name;
    }

    protected function getSolutionPageId(): int|string|null
    {
        return theme_option('solution_page_id', setting('solution_page_id'));
    }
}
