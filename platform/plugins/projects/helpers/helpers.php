<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Projects\Repositories\Interfaces\CategoryInterface;
use Botble\Projects\Repositories\Interfaces\PostInterface;
use Botble\Projects\Repositories\Interfaces\TagInterface;
use Botble\Projects\Supports\PostFormat;
use Botble\Page\Models\Page;
use Botble\Projects\Models\Category;
use Botble\Projects\Models\Post;



use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (! function_exists('get_featured_projectsposts')) {
    function get_featured_projectsposts(int $limit, array $with = []): Collection
    {
        return app(PostInterface::class)->getFeatured($limit, $with);
    }
}

if (! function_exists('get_latest_projectsposts')) {
    function get_latest_projectsposts(int $limit, array $excepts = [], array $with = []): Collection
    {
        return app(PostInterface::class)->getListPostNonInList($excepts, $limit, $with);
    }
}

if (! function_exists('get_related_projectsposts')) {
    function get_related_projectsposts(int|string $id, int $limit): Collection
    {
        return app(PostInterface::class)->getRelated($id, $limit);
    }
}
if (! function_exists('get_featured_projects_posts')) {
    function get_featured_projects_posts(): Collection|LengthAwarePaginator|Post|null 
    {
        return Post::query()
            // ->where('is_featured', true)
            ->wherePublished()
            ->orderBy('id', 'asc') 
            ->with('slugable')
            ->get();
    }
}
if (! function_exists('get_featured_projects_categories')) {
    function get_featured_projects_categories(): Collection|LengthAwarePaginator|Category|null
    {
        return Category::query()
            ->where('is_featured', true)
            ->wherePublished()
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->with('slugable')
            ->get();
    }
}
if (! function_exists('get_projectsposts_by_category')) {
    function get_projectsposts_by_category(int|string $categoryId, int $paginate = 12, int $limit = 0): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByCategory($categoryId, $paginate, $limit);
    }
}

if (! function_exists('get_projectsposts_by_tag')) {
    function get_projectsposts_by_tag(string $slug, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByTag($slug, $paginate);
    }
}

if (! function_exists('get_projectsposts_by_user')) {
    function get_projectsposts_by_user(int|string $authorId, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByUserId($authorId, $paginate);
    }
}

if (! function_exists('get_all_projectsposts')) {
    function get_all_projectsposts(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'projectscategories', 'projectscategories.slugable', 'author']
    ): Collection|LengthAwarePaginator {
        return app(PostInterface::class)->getAllprojectsposts($perPage, $active, $with);
    }
}

if (! function_exists('get_recent_projectsposts')) {
    function get_recent_projectsposts(int $limit): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getRecentprojectsposts($limit);
    }
}

if (! function_exists('get_featured_projectscategories')) {
    function get_featured_projectscategories(int $limit, array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getFeaturedprojectscategories($limit, $with);
    }
}

if (! function_exists('get_all_projectscategories')) {
    function get_all_projectscategories(array $condition = [], array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getAllprojectscategories($condition, $with);
    }
}

if (! function_exists('get_all_projectstags')) {
    function get_all_projectstags(bool $active = true): Collection|LengthAwarePaginator
    {
        return app(TagInterface::class)->getAllprojectstags($active);
    }
}

if (! function_exists('get_popular_projectstags')) {
    function get_popular_projectstags(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['projectsposts']
    ): Collection|LengthAwarePaginator {
        return app(TagInterface::class)->getPopularprojectstags($limit, $with, $withCount);
    }
}

if (! function_exists('get_popular_projectsposts')) {
    function get_popular_projectsposts(int $limit = 10, array $args = []): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getPopularprojectsposts($limit, $args);
    }
}

if (! function_exists('get_popular_projectscategories')) {
    function get_popular_projectscategories(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['projectsposts']
    ): Collection|LengthAwarePaginator {
        return app(CategoryInterface::class)->getPopularprojectscategories($limit, $with, $withCount);
    }
}

if (! function_exists('get_category_by_id')) {
    function get_category_by_id(int|string $id): ?BaseModel
    {
        return app(CategoryInterface::class)->getCategoryById($id);
    }
}

if (! function_exists('get_projectscategories')) {
    function get_projectscategories(array $args = []): array
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryInterface::class);

        $projectscategories = $repo->getprojectscategories(Arr::get($args, 'select', ['*']), [
            'is_default' => 'DESC',
            'order' => 'ASC',
            'created_at' => 'DESC',
        ], Arr::get($args, 'condition', ['status' => BaseStatusEnum::PUBLISHED]));

        $projectscategories = sort_item_with_children($projectscategories);

        foreach ($projectscategories as $category) {
            $depth = (int)$category->depth;
            $indentText = str_repeat($indent, $depth);
            $category->indent_text = $indentText;
        }

        return $projectscategories;
    }
}

if (! function_exists('get_projectscategories_with_children')) {
    function get_projectscategories_with_children(): array
    {
        $projectscategories = app(CategoryInterface::class)
            ->getAllprojectscategoriesWithChildren(['status' => BaseStatusEnum::PUBLISHED], [], ['id', 'name', 'parent_id']);

        return app(SortItemsWithChildrenHelper::class)
            ->setChildrenProperty('child_cats')
            ->setItems($projectscategories)
            ->sort();
    }
}

if (! function_exists('register_post_format')) {
    function register_post_format(array $formats): void
    {
        PostFormat::registerPostFormat($formats);
    }
}

if (! function_exists('get_post_formats')) {
    function get_post_formats(bool $toArray = false): array
    {
        return PostFormat::getPostFormats($toArray);
    }
}

if (! function_exists('get_projects_page_id')) {
    function get_projects_page_id(): string|null
    {
        return theme_option('projects_page_id', setting('projects_page_id'));
    }
}

if (! function_exists('get_projects_page_url')) {
    function get_projects_page_url(): string
    {
        $projectsPageId = (int)theme_option('projects_page_id', setting('projects_page_id'));

        if (! $projectsPageId) {
            return BaseHelper::getHomepageUrl();
        }

        $projectsPage = Page::query()->find($projectsPageId);

        if (! $projectsPage) {
            return BaseHelper::getHomepageUrl();
        }

        return $projectsPage->url;
    }
}
