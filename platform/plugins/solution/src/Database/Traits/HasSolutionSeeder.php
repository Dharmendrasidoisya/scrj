<?php

namespace Botble\Solution\Database\Traits;

use Botble\ACL\Models\User;
use Botble\Solution\Models\Category;
use Botble\Solution\Models\Post;
use Botble\Solution\Models\Tag;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait HasSolutionSeeder
{
    protected function createSolutionscategories(array $scategories, bool $truncate = true): void
    {
        if ($truncate) {
            Category::query()->truncate();
        }

        $faker = $this->fake();

        foreach ($scategories as $index => $item) {
            $item['description'] ??= $faker->text();
            $item['is_featured'] ??= ! isset($item['parent_id']) && $index != 0;
            $item['author_id'] ??= 1;
            $item['parent_id'] ??= 0;

            $category = $this->createSolutionCategory(Arr::except($item, 'children'));

            if (Arr::has($item, 'children')) {
                foreach (Arr::get($item, 'children', []) as $child) {
                    $child['parent_id'] = $category->getKey();

                    $this->createSolutionCategory($child);
                }
            }

            $this->createMetadata($category, $item);
        }
    }

    protected function createSolutionstags(array $stags, bool $truncate = true): void
    {
        if ($truncate) {
            Tag::query()->truncate();
        }

        foreach ($stags as $item) {
            /**
             * @var Tag $stag
             */
            $stag = Tag::query()->create(Arr::except($item, ['metadata']));

            SlugHelper::createSlug($stag);

            $this->createMetadata($stag, $item);
        }
    }

    protected function createSolutionsposts(array $sposts, bool $truncate = true): void
    {
        if ($truncate) {
            Post::query()->truncate();
            DB::table('post_categories')->truncate();
            DB::table('post_stags')->truncate();
        }

        $faker = $this->fake();

        $categoryIds = Category::query()->pluck('id');
        $tagIds = Tag::query()->pluck('id');
        $userIds = User::query()->pluck('id');

        foreach ($sposts as $item) {
            $item['views'] ??= $faker->numberBetween(100, 2500);
            $item['description'] ??= $faker->realText();
            $item['is_featured'] ??= $faker->boolean();
            $item['content'] ??= $this->removeBaseUrlFromString((string) $item['content']);
            $item['author_id'] ??= $userIds->random();
            $item['author_type'] ??= User::class;

            /**
             * @var Post $post
             */
            $post = Post::query()->create(Arr::except($item, ['metadata']));

            $post->scategories()->sync(array_unique([
                $categoryIds->random(),
                $categoryIds->random(),
            ]));

            $post->stags()->sync(array_unique([
                $tagIds->random(),
                $tagIds->random(),
                $tagIds->random(),
            ]));

            SlugHelper::createSlug($post);

            $this->createMetadata($post, $item);
        }
    }

    protected function getCategoryId(string $name): int|string
    {
        return Category::query()->where('name', $name)->value('id');
    }

    protected function createSolutionCategory(array $item): Category
    {
        /**
         * @var Category $category
         */
        $category = Category::query()->create(Arr::except($item, ['metadata']));

        SlugHelper::createSlug($category);

        $this->createMetadata($category, $item);

        return $category;
    }
}
