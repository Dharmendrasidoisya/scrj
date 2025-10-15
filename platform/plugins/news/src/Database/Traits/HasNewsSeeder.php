<?php

namespace Botble\News\Database\Traits;

use Botble\ACL\Models\User;
use Botble\News\Models\Category;
use Botble\News\Models\Post;
use Botble\News\Models\Tag;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait HasNewsSeeder
{
    protected function createNewsnewscategories(array $newscategories, bool $truncate = true): void
    {
        if ($truncate) {
            Category::query()->truncate();
        }

        $faker = $this->fake();

        foreach ($newscategories as $index => $item) {
            $item['description'] ??= $faker->text();
            $item['shortdescription'] ??= $faker->text();
            $item['is_featured'] ??= ! isset($item['parent_id']) && $index != 0;
            $item['author_id'] ??= 1;
            $item['parent_id'] ??= 0;

            $category = $this->createNewsCategory(Arr::except($item, 'children'));

            if (Arr::has($item, 'children')) {
                foreach (Arr::get($item, 'children', []) as $child) {
                    $child['parent_id'] = $category->getKey();

                    $this->createNewsCategory($child);
                }
            }

            $this->createMetadata($category, $item);
        }
    }

    protected function createNewsnewstags(array $newstags, bool $truncate = true): void
    {
        if ($truncate) {
            Tag::query()->truncate();
        }

        foreach ($newstags as $item) {
            /**
             * @var Tag $stag
             */
            $stag = Tag::query()->create(Arr::except($item, ['metadata']));

            SlugHelper::createSlug($stag);

            $this->createMetadata($stag, $item);
        }
    }

    protected function createNewsnewsposts(array $newsposts, bool $truncate = true): void
    {
        if ($truncate) {
            Post::query()->truncate();
            DB::table('post_categories')->truncate();
            DB::table('post_newstags')->truncate();
        }

        $faker = $this->fake();

        $categoryIds = Category::query()->pluck('id');
        $tagIds = Tag::query()->pluck('id');
        $userIds = User::query()->pluck('id');

        foreach ($newsposts as $item) {
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

            $post->newscategories()->sync(array_unique([
                $categoryIds->random(),
                $categoryIds->random(),
            ]));

            $post->newstags()->sync(array_unique([
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

    protected function createNewsCategory(array $item): Category
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
