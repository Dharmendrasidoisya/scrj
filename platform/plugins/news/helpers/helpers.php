<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\News\Repositories\Interfaces\CategoryInterface;
use Botble\News\Repositories\Interfaces\PostInterface;
use Botble\News\Repositories\Interfaces\TagInterface;
use Botble\News\Supports\PostFormat;
use Botble\Page\Models\Page;
use Botble\News\Models\Category;
use Botble\News\Models\Post;



use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (! function_exists('get_featured_newsposts')) {
    function get_featured_newsposts(int $limit, array $with = []): Collection
    {
        return app(PostInterface::class)->getFeatured($limit, $with);
    }
}

if (! function_exists('get_latest_newsposts')) {
    function get_latest_newsposts(int $limit, array $excepts = [], array $with = []): Collection
    {
        return app(PostInterface::class)->getListPostNonInList($excepts, $limit, $with);
    }
}

if (! function_exists('get_related_newsposts')) {
    function get_related_newsposts(int|string $id, int $limit): Collection
    {
        return app(PostInterface::class)->getRelated($id, $limit);
    }
}
if (! function_exists('get_featured_news_posts')) {
    function get_featured_news_posts(): Collection|LengthAwarePaginator|Post|null 
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
if (! function_exists('get_featured_news_categories')) {
    function get_featured_news_categories(): Collection|LengthAwarePaginator|Category|null
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
if (! function_exists('get_newsposts_by_category')) {
    function get_newsposts_by_category(int|string $categoryId, int $paginate = 12, int $limit = 0): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByCategory($categoryId, $paginate, $limit);
    }
}

if (! function_exists('get_newsposts_by_tag')) {
    function get_newsposts_by_tag(string $slug, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByTag($slug, $paginate);
    }
}

if (! function_exists('get_newsposts_by_user')) {
    function get_newsposts_by_user(int|string $authorId, int $paginate = 12): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getByUserId($authorId, $paginate);
    }
}

if (! function_exists('get_all_newsposts')) {
    function get_all_newsposts(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'newscategories', 'newscategories.slugable', 'author']
    ): Collection|LengthAwarePaginator {
        return app(PostInterface::class)->getAllnewsposts($perPage, $active, $with);
    }
}

if (! function_exists('get_recent_newsposts')) {
    function get_recent_newsposts(int $limit): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getRecentnewsposts($limit);
    }
}

if (! function_exists('get_featured_newscategories')) {
    function get_featured_newscategories(int $limit, array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getFeaturednewscategories($limit, $with);
    }
}

if (! function_exists('get_all_newscategories')) {
    function get_all_newscategories(array $condition = [], array $with = []): Collection|LengthAwarePaginator
    {
        return app(CategoryInterface::class)->getAllnewscategories($condition, $with);
    }
}

if (! function_exists('get_all_newstags')) {
    function get_all_newstags(bool $active = true): Collection|LengthAwarePaginator
    {
        return app(TagInterface::class)->getAllnewstags($active);
    }
}

if (! function_exists('get_popular_newstags')) {
    function get_popular_newstags(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['newsposts']
    ): Collection|LengthAwarePaginator {
        return app(TagInterface::class)->getPopularnewstags($limit, $with, $withCount);
    }
}

if (! function_exists('get_popular_newsposts')) {
    function get_popular_newsposts(int $limit = 10, array $args = []): Collection|LengthAwarePaginator
    {
        return app(PostInterface::class)->getPopularnewsposts($limit, $args);
    }
}

if (! function_exists('get_popular_newscategories')) {
    function get_popular_newscategories(
        int $limit = 10,
        array $with = ['slugable'],
        array $withCount = ['newsposts']
    ): Collection|LengthAwarePaginator {
        return app(CategoryInterface::class)->getPopularnewscategories($limit, $with, $withCount);
    }
}

if (! function_exists('get_category_by_id')) {
    function get_category_by_id(int|string $id): ?BaseModel
    {
        return app(CategoryInterface::class)->getCategoryById($id);
    }
}

if (! function_exists('get_newscategories')) {
    function get_newscategories(array $args = []): array
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryInterface::class);

        $newscategories = $repo->getnewscategories(Arr::get($args, 'select', ['*']), [
            'is_default' => 'DESC',
            'order' => 'ASC',
            'created_at' => 'DESC',
        ], Arr::get($args, 'condition', ['status' => BaseStatusEnum::PUBLISHED]));

        $newscategories = sort_item_with_children($newscategories);

        foreach ($newscategories as $category) {
            $depth = (int)$category->depth;
            $indentText = str_repeat($indent, $depth);
            $category->indent_text = $indentText;
        }

        return $newscategories;
    }
}

if (! function_exists('get_newscategories_with_children')) {
    function get_newscategories_with_children(): array
    {
        $newscategories = app(CategoryInterface::class)
            ->getAllnewscategoriesWithChildren(['status' => BaseStatusEnum::PUBLISHED], [], ['id', 'name', 'parent_id']);

        return app(SortItemsWithChildrenHelper::class)
            ->setChildrenProperty('child_cats')
            ->setItems($newscategories)
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

if (! function_exists('get_news_page_id')) {
    function get_news_page_id(): string|null
    {
        return theme_option('news_page_id', setting('news_page_id'));
    }
}

if (! function_exists('get_news_page_url')) {
    function get_news_page_url(): string
    {
        $newsPageId = (int)theme_option('news_page_id', setting('news_page_id'));

        if (! $newsPageId) {
            return BaseHelper::getHomepageUrl();
        }

        $newsPage = Page::query()->find($newsPageId);

        if (! $newsPage) {
            return BaseHelper::getHomepageUrl();
        }

        return $newsPage->url;
    }
}
