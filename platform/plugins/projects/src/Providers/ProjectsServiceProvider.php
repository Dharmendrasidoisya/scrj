<?php

namespace Botble\Projects\Providers;

use Botble\Api\Facades\ApiHelper;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Projects\Models\Category;
use Botble\Projects\Models\Post;
use Botble\Projects\Models\Tag;
use Botble\Projects\Repositories\Eloquent\CategoryRepository;
use Botble\Projects\Repositories\Eloquent\PostRepository;
use Botble\Projects\Repositories\Eloquent\TagRepository;
use Botble\Projects\Repositories\Interfaces\CategoryInterface;
use Botble\Projects\Repositories\Interfaces\PostInterface;
use Botble\Projects\Repositories\Interfaces\TagInterface;
use Botble\Language\Facades\Language;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Botble\Shortcode\View\View;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Events\ThemeRoutingBeforeEvent;
use Botble\Theme\Facades\SiteMapManager;

/**
 * @since 02/07/2016 09:50 AM
 */
class ProjectsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->bind(PostInterface::class, function () {
            return new PostRepository(new Post());
        });

        $this->app->bind(CategoryInterface::class, function () {
            return new CategoryRepository(new Category());
        });

        $this->app->bind(TagInterface::class, function () {
            return new TagRepository(new Tag());
        });
    }

    public function boot(): void
    {
        SlugHelper::registerModule(Post::class, 'Projects posts');
        SlugHelper::registerModule(Category::class, 'Projects categories');
        SlugHelper::registerModule(Tag::class, 'Projects projectstags');

        SlugHelper::setPrefix(Tag::class, 'stag', true);
        SlugHelper::setPrefix(Post::class, null, true);
        SlugHelper::setPrefix(Category::class, null, true);

        $this
            ->setNamespace('plugins/projects')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadMigrations()
            ->publishAssets();

        if (ApiHelper::enabled()) {
            $this->loadRoutes(['api']);
        }

        $this->app->register(EventServiceProvider::class);

        $this->app['events']->listen(ThemeRoutingBeforeEvent::class, function () {
            SiteMapManager::registerKey([
                'projects-categories',
                'projects-projectstags',
                'projects-posts-((?:19|20|21|22)\d{2})-(0?[1-9]|1[012])',
            ]);
        });

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::make()
                ->registerItem([
                    'id' => 'cms-plugins-projects',
                    'priority' => 5,
                    'name' => 'plugins/projects::base.menu_name',
                    'icon' => 'ti ti-article',
                ])
                ->registerItem([
                    'id' => 'cms-plugins-projects-post',
                    'priority' => 1,
                    'parent_id' => 'cms-plugins-projects',
                    'name' => 'Posts',
                    'route' => 'projectsposts.index',
                ])
                ->registerItem([
                    'id' => 'cms-plugins-projects-projectscategories',
                    'priority' => 2,
                    'parent_id' => 'cms-plugins-projects',
                    'name' => 'Categories',
                    'route' => 'projectscategories.index',
                ])
                ->registerItem([
                    'id' => 'cms-plugins-projects-projectstags',
                    'priority' => 3,
                    'parent_id' => 'cms-plugins-projects',
                    'name' => 'Tag',
                    'route' => 'projectstags.index',
                ]);
        });

        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('projects')
                    ->setTitle(trans('plugins/projects::base.settings.title'))
                    ->withIcon('ti ti-file-settings')
                    ->withDescription(trans('plugins/projects::base.settings.description'))
                    ->withPriority(120)
                    ->withRoute('projects.settings')
            );
        });

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (
                defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME') &&
                $this->app['config']->get('plugins.projects.general.use_language_v2')
            ) {
                LanguageAdvancedManager::registerModule(Post::class, [
                    'name',
                    'description',
                    'content',
                ]);

                LanguageAdvancedManager::registerModule(Category::class, [
                    'name',
                    'description',
                ]);

                LanguageAdvancedManager::registerModule(Tag::class, [
                    'name',
                    'description',
                ]);
            } else {
                Language::registerModule([Post::class, Category::class, Tag::class]);
            }
        }

        $this->app->booted(function () {
            SeoHelper::registerModule([Post::class, Category::class, Tag::class]);

            $configKey = 'packages.revision.general.supported';
            config()->set($configKey, array_merge(config($configKey, []), [Post::class]));

            $this->app->register(HookServiceProvider::class);
        });

        if (function_exists('shortcode')) {
            view()->composer([
                'plugins/projects::themes.post',
                'plugins/projects::themes.category',
                'plugins/projects::themes.stag',
            ], function (View $view) {
                $view->withShortcodes();
            });
        }
    }
}
