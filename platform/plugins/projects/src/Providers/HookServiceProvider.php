<?php

namespace Botble\Projects\Providers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Projects\Models\Category;
use Botble\Projects\Models\Post;
use Botble\Projects\Models\Tag;
use Botble\Projects\Projects\ProjectsService;
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
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderProjectsPage'], 2, 2);
        }

        PageTable::beforeRendering(function () {
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        });

        $this->app['events']->listen(RenderingAdminBar::class, function () {
            AdminBar::registerLink(
                trans('plugins/projects::posts.post'),
                route('projectsposts.create'),
                'add-new',
                'projectsposts.create'
            );
        });

        if (function_exists('add_shortcode')) {
            shortcode()
                ->register(
                    $shortcodeName = 'projects-projectsposts',
                    trans('plugins/projects::base.short_code_name'),
                    trans('plugins/projects::base.short_code_description'),
                    [$this, 'renderProjectsprojectsposts']
                )
                ->setAdminConfig(
                    $shortcodeName,
                    function (array $attributes) {
                        $projectscategories = Category::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all();

                        return ShortcodeForm::createFromArray($attributes)
                            ->add('paginate', 'number', [
                                'label' => trans('plugins/projects::base.number_projectsposts_per_page'),
                                'attr' => [
                                    'placeholder' => trans('plugins/projects::base.number_projectsposts_per_page'),
                                ],
                            ])
                            ->add(
                                'category_ids[]',
                                SelectField::class,
                                SelectFieldOption::make()
                                    ->label(__('Select projectscategories'))
                                    ->choices($projectscategories)
                                    ->when(Arr::get($attributes, 'category_ids'), function (SelectFieldOption $option, $projectscategoriesIds) {
                                        $option->selected(explode(',', $projectscategoriesIds));
                                    })
                                    ->multiple()
                                    ->searchable()
                                    ->helperText(__('Leave projectscategories empty if you want to show projectsposts from all projectscategories.'))
                                    ->toArray()
                            );
                    }
                );
        }

        $this->app['events']->listen(RenderingThemeOptionSettings::class, function () {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        });

        if (defined('THEME_FRONT_HEADER') && setting('projects_post_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $post) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($post) {
                    if (! $post instanceof Post) {
                        return $html;
                    }

                    $schemaType = setting('projects_post_schema_type', 'NewsArticle');

                    if (! in_array($schemaType, ['NewsArticle', 'News', 'Article', 'ProjectsPosting'])) {
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
                'title' => trans('plugins/projects::base.settings.title'),
                'id' => 'opt-text-subsection-projects',
                'subsection' => true,
                'icon' => 'ti ti-edit',
                'fields' => [
                    [
                        'id' => 'projects_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/projects::base.projects_page_id'),
                        'attributes' => [
                            'name' => 'projects_page_id',
                            'list' => [0 => trans('plugins/projects::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_projectsposts_in_a_category',
                        'type' => 'number',
                        'label' => trans('plugins/projects::base.number_projectsposts_per_page_in_category'),
                        'attributes' => [
                            'name' => 'number_of_projectsposts_in_a_category',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_projectsposts_in_a_tag',
                        'type' => 'number',
                        'label' => trans('plugins/projects::base.number_projectsposts_per_page_in_tag'),
                        'attributes' => [
                            'name' => 'number_of_projectsposts_in_a_tag',
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
        if (Auth::guard()->user()->hasPermission('projectscategories.index')) {
            Menu::registerMenuOptions(Category::class, trans('plugins/projects::categories.menu'));
        }

        if (Auth::guard()->user()->hasPermission('projectstags.index')) {
            Menu::registerMenuOptions(Tag::class, trans('plugins/projects::tags.menu'));
        }
    }

    public function registerDashboardWidgets(array $widgets, Collection $widgetSettings): array
    {
        if (! Auth::guard()->user()->hasPermission('projectsposts.index')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/projects/js/projects.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('projectsposts.index')
            ->setKey('widget_projectsposts_recent')
            ->setTitle(trans('plugins/projects::posts.widget_projectsposts_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('yellow')
            ->setRoute(route('projectsposts.widget.recent-projectsposts'))
            ->setBodyClass('')
            ->setColumn('col-md-6 col-sm-6')
            ->init($widgets, $widgetSettings);
    }

    public function handleSingleView(Slug|array $slug): Slug|array
    {
        return (new ProjectsService())->handleFrontRoutes($slug);
    }

    public function renderProjectsprojectsposts(Shortcode $shortcode): array|string
    {
        $categoryIds = ShortcodeFacade::fields()->getIds('category_ids', $shortcode);

        $projectsposts = Post::query()
            ->wherePublished()
            ->orderByDesc('created_at')
            ->with('slugable')
            ->when(! empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereHas('projectscategories', function ($query) use ($categoryIds) {
                    $query->whereIn('projectscategories.id', $categoryIds);
                });
            })
            ->paginate((int)$shortcode->paginate ?: 12);

        $view = 'plugins/projects::themes.templates.projectsposts';
        $themeView = Theme::getThemeNamespace() . '::views.templates.projectsposts';

        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('projectsposts'))->render();
    }

    public function renderProjectsPage(string|null $content, Page $page): string|null
    {
        if ($page->getKey() == $this->getProjectsPageId()) {
            $view = 'plugins/projects::themes.loop';

            if (view()->exists($viewPath = Theme::getThemeNamespace() . '::views.loop')) {
                $view = $viewPath;
            }

            return view($view, [
                'projectsposts' => get_all_projectsposts(true, (int)theme_option('number_of_projectsposts_in_a_category', 12)),
            ])->render();
        }

        return $content;
    }

    public function addAdditionNameToPageName(string|null $name, Page $page): string|null
    {
        if ($page->getKey() == $this->getProjectsPageId()) {
            $subTitle = Html::tag('span', trans('plugins/projects::base.projects_page'), ['class' => 'additional-page-name'])
                ->toHtml();

            if (Str::contains($name, ' —')) {
                return $name . ', ' . $subTitle;
            }

            return $name . ' —' . $subTitle;
        }

        return $name;
    }

    protected function getProjectsPageId(): int|string|null
    {
        return theme_option('projects_page_id', setting('projects_page_id'));
    }
}
