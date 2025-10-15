<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Industry\Repositories\Interfaces\CategoryInterface;
use Botble\Industry\Repositories\Interfaces\PostInterface;
use Botble\Industry\Repositories\Interfaces\TagInterface;
use Botble\Industry\Supports\PostFormat;
use Botble\Page\Models\Page;
use Botble\Industry\Models\Category;
use Botble\Industry\Models\Post;



use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (! function_exists('get_featured_industryposts')) {
    function get_featured_industryposts(int $limit, array $with = []): Collection
    {
        return app(PostInterface::class)->getFeatured($limit, $with);
    }
}

if (! function_exists('get_latest_industryposts')) {
    function get_latest_industryposts(int $limit, array $excepts = [], array $with = []): Collection
    {
        return app(PostInterface::class)->getListPostNonInList($excepts, $limit, $with);
    }
}

if (! function_exists('get_related_industryposts')) {
    function get_related_industryposts(int|string $id, int $limit): Collection
    {
        return app(PostInterface::class)->getRelated($id, $limit);
    }
}
if (! function_exists('get_featured_industry_posts')) {
    function get_featured_industry_posts(): Collection|LengthAwarePaginator|Post|null 
    {
        return Post::query()
            // ->where('is_featured', true)
            ->wherePublished()  
            // ->orderBy('order')
            ->orderByDesc('created_at')
            ->with('slugable')
            ->get();
    }
}
if (! function_exists('get_featured_industry_categories')) {
    function get_featured_industry_categories(): Collection|LengthAwarePaginator|Category|null
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
if (! function_exists('get_industryposts_by_category')) {
    function get_industryposts_by_category(int|string $categoryId, int $paginate = 12, int $limit = 0): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByCategory($categoryId, $paginate, $limit);
    }
}

if (! function_exists('get_industryposts_by_tag')) {
    function get_industryposts_by_tag(string $slug, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByTag($slug, $paginate);
    }
}

if (! function_exists('get_industryposts_by_user')) {
    function get_industryposts_by_user(int|string $authorId, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByUserId($authorId, $paginate);
    }
}

if (! function_exists('get_all_industryposts')) {
    function get_all_industryposts(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'industrycategories', 'industrycategories.slugable', 'author']
    ): Collection|LengthAwarePaginator {
        return app(PostInterface::class)->getAllindustryposts($perPage, $active, $with);
    }
}

if (! function_exists('get_recent_industryposts')) {
    function get_recent_industryposts(int $limit): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getRecentindustryposts($limit);
    }
}

if (! function_exists('get_featured_industrycategories')) {
    function get_featured_industrycategories(int $limit, array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getFeaturedindustrycategories($limit, $with);
    }
}

if (! function_exists('get_all_industrycategories')) {
    function get_all_industrycategories(array $condition = [], array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getAllindustrycategories($condition, $with);
    }
}

if (! function_exists('get_all_industrytags')) {
    function get_all_industrytags(bool $active = true): Collection|LengthAwarePaginator
    {
        return app(TagInterface::class)->getAllindustrytags($active);
    }
}

if (! function_exists('get_popular_industrytags')) {
    function get_popular_industrytags(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['industryposts']
    ): Collection|LengthAwarePaginator {
        return app(TagInterface::class)->getPopularindustrytags($limit, $with, $withCount);
    }
}

if (! function_exists('get_popular_industryposts')) {
    function get_popular_industryposts(int $limit = 10, array $args = []): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getPopularindustryposts($limit, $args);
    }
}

if (! function_exists('get_popular_industrycategories')) {
    function get_popular_industrycategories(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['industryposts']
    ): Collection|LengthAwarePaginator {
        return app(CategoryInterface::class)->getPopularindustrycategories($limit, $with, $withCount);
    }
}

if (! function_exists('get_category_by_id')) {
    function get_category_by_id(int|string $id): ?BaseModel
    {
        return app(CategoryInterface::class)->getCategoryById($id);
    }
}

if (! function_exists('get_industrycategories')) {
    function get_industrycategories(array $args = []): array
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryInterface::class);

        $industrycategories = $repo->getindustrycategories(Arr::get($args, 'select', ['*']), [
            'is_default' => 'DESC',
            'order' => 'ASC',
            'created_at' => 'DESC',
        ], Arr::get($args, 'condition', ['status' => BaseStatusEnum::PUBLISHED]));

        $industrycategories = sort_item_with_children($industrycategories);

        foreach ($industrycategories as $category) {
            $depth = (int)$category->depth;
            $indentText = str_repeat($indent, $depth);
            $category->indent_text = $indentText;
        }

        return $industrycategories;
    }
}

if (! function_exists('get_industrycategories_with_children')) {
    function get_industrycategories_with_children(): array
    {
        $industrycategories = app(CategoryInterface::class)
            ->getAllindustrycategoriesWithChildren(['status' => BaseStatusEnum::PUBLISHED], [], ['id', 'name', 'parent_id']);

        return app(SortItemsWithChildrenHelper::class)
            ->setChildrenProperty('child_cats')
            ->setItems($industrycategories)
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

if (! function_exists('get_industry_page_id')) {
    function get_industry_page_id(): string|null
    {
        return theme_option('industry_page_id', setting('industry_page_id'));
    }
}

if (! function_exists('get_industry_page_url')) {
    function get_industry_page_url(): string
    {
        $industryPageId = (int)theme_option('industry_page_id', setting('industry_page_id'));

        if (! $industryPageId) {
            return BaseHelper::getHomepageUrl();
        }

        $industryPage = Page::query()->find($industryPageId);

        if (! $industryPage) {
            return BaseHelper::getHomepageUrl();
        }

        return $industryPage->url;
    }
}
