<?php

namespace Botble\Solution\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Solution\Models\Category;
use Botble\Solution\Models\Post;
use Botble\Solution\Models\Tag;
use Botble\Solution\Repositories\Interfaces\PostInterface;
use Botble\Media\Facades\RvMedia;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Botble\Theme\Facades\AdminBar;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SolutionService
{
    public function handleFrontRoutes(Slug|array $slug): Slug|array|Builder
    {
        if (! $slug instanceof Slug) {
            return $slug;
        }

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (Auth::guard()->check() && request()->input('preview')) {
            Arr::forget($condition, 'status');
        }

        switch ($slug->reference_type) {
            case Post::class:
                /**
                 * @var Post $post
                 */
                $post = Post::query()
                    ->where($condition)
                    ->with(['scategories', 'stags', 'slugable', 'scategories.slugable', 'stags.slugable'])
                    ->firstOrFail();

                Helper::handleViewCount($post, 'viewed_post');

                SeoHelper::setTitle($post->name)
                    ->setDescription($post->description);

                $meta = new SeoOpenGraph();
                if ($post->image) {
                    $meta->setImage(RvMedia::getImageUrl($post->image));
                }
                $meta->setDescription($post->description);
                $meta->setUrl($post->url);
                $meta->setTitle($post->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($post->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/solution::posts.edit_this_post'),
                        route('sposts.edit', $post->getKey()),
                        null,
                        'sposts.edit'
                    );
                }

                if (function_exists('shortcode')) {
                    shortcode()->getCompiler()->setEditLink(route('sposts.edit', $post->id), 'sposts.edit');
                }

                $category = $post->scategories->sortByDesc('id')->first();
                if ($category) {
                    if ($category->parents->isNotEmpty()) {
                        foreach ($category->parents as $parentCategory) {
                            Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                        }
                    }

                    Theme::breadcrumb()->add($category->name, $category->url);
                }

                Theme::breadcrumb()->add($post->name, $post->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

                return [
                    'view' => 'post',
                    'default_view' => 'plugins/solution::themes.post',
                    'data' => compact('post'),
                    'slug' => $post->slug,
                ];
            case Category::class:
                $category = Category::query()
                    ->where($condition)
                    ->with(['slugable'])
                    ->firstOrFail();

                SeoHelper::setTitle($category->name)
                    ->setDescription($category->description);

                $meta = new SeoOpenGraph();
                if ($category->image) {
                    $meta->setImage(RvMedia::getImageUrl($category->image));
                }
                $meta->setDescription($category->description);
                $meta->setUrl($category->url);
                $meta->setTitle($category->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($category->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/solution::categories.edit_this_category'),
                        route('scategories.edit', $category->getKey()),
                        null,
                        'scategories.edit'
                    );
                }

                $allRelatedCategoryIds = array_merge([$category->getKey()], $category->activeChildren->pluck('id')->all());

                $sposts = app(PostInterface::class)
                    ->getByCategory($allRelatedCategoryIds, (int)theme_option('number_of_sposts_in_a_category', 12));

                if ($category->parents->isNotEmpty()) {
                    foreach ($category->parents->reverse() as $parentCategory) {
                        Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                    }
                }

                Theme::breadcrumb()->add($category->name, $category->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATEGORY_MODULE_SCREEN_NAME, $category);

                return [
                    'view' => 'category',
                    'default_view' => 'plugins/solution::themes.category',
                    'data' => compact('category', 'sposts'),
                    'slug' => $category->slug,
                ];
            case Tag::class:
                $stag = Tag::query()
                    ->where($condition)
                    ->with(['slugable'])
                    ->firstOrFail();

                SeoHelper::setTitle($stag->name)
                    ->setDescription($stag->description);

                $meta = new SeoOpenGraph();
                $meta->setDescription($stag->description);
                $meta->setUrl($stag->url);
                $meta->setTitle($stag->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                SeoHelper::meta()->setUrl($stag->url);

                if (function_exists('admin_bar')) {
                    AdminBar::registerLink(
                        trans('plugins/solution::tags.edit_this_tag'),
                        route('stags.edit', $stag->getKey()),
                        null,
                        'stags.edit'
                    );
                }

                $sposts = get_sposts_by_tag($stag->getKey(), (int)theme_option('number_of_sposts_in_a_tag', 12));

                Theme::breadcrumb()->add($stag->name, $stag->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, TAG_MODULE_SCREEN_NAME, $stag);

                return [
                    'view' => 'stag',
                    'default_view' => 'plugins/solution::themes.stag',
                    'data' => compact('stag', 'sposts'),
                    'slug' => $stag->slug,
                ];
        }

        return $slug;
    }
}
