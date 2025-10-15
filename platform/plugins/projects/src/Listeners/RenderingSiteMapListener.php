<?php

namespace Botble\Projects\Listeners;

use Botble\Projects\Models\Category;
use Botble\Projects\Models\Post;
use Botble\Projects\Models\Tag;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Theme\Facades\SiteMapManager;
use Illuminate\Support\Arr;

class RenderingSiteMapListener
{
    public function handle(RenderingSiteMapEvent $event): void
    {
        if ($key = $event->key) {
            switch ($key) {
                case 'projects-projectscategories':
                    $projectscategories = Category::query()
                        ->with('slugable')
                        ->wherePublished()
                        ->select(['id', 'name', 'updated_at'])
                        ->orderByDesc('created_at')
                        ->get();

                    foreach ($projectscategories as $category) {
                        SiteMapManager::add($category->url, $category->updated_at, '0.8');
                    }

                    break;
                case 'projects-projectstags':
                    $projectstags = Tag::query()
                        ->with('slugable')
                        ->wherePublished()
                        ->orderByDesc('created_at')
                        ->select(['id', 'name', 'updated_at'])
                        ->get();

                    foreach ($projectstags as $stag) {
                        SiteMapManager::add($stag->url, $stag->updated_at, '0.3', 'weekly');
                    }

                    break;
            }

            if (preg_match('/^projects-projectsposts-((?:19|20|21|22)\d{2})-(0?[1-9]|1[012])$/', $key, $matches)) {
                if (($year = Arr::get($matches, 1)) && ($month = Arr::get($matches, 2))) {
                    $projectsposts = Post::query()
                        ->wherePublished()
                        ->whereYear('updated_at', $year)
                        ->whereMonth('updated_at', $month)
                        ->latest('updated_at')
                        ->select(['id', 'name', 'updated_at'])
                        ->with(['slugable'])
                        ->get();

                    foreach ($projectsposts as $post) {
                        if (! $post->slugable) {
                            continue;
                        }

                        SiteMapManager::add($post->url, $post->updated_at, '0.8');
                    }
                }
            }

            return;
        }

        $projectsposts = Post::query()
            ->selectRaw('YEAR(updated_at) as updated_year, MONTH(updated_at) as updated_month, MAX(updated_at) as updated_at')
            ->wherePublished()
            ->groupBy('updated_year', 'updated_month')
            ->orderByDesc('updated_year')
            ->orderByDesc('updated_month')
            ->get();

        if ($projectsposts->isNotEmpty()) {
            foreach ($projectsposts as $post) {
                $key = sprintf('projects-projectsposts-%s-%s', $post->updated_year, str_pad($post->updated_month, 2, '0', STR_PAD_LEFT));
                SiteMapManager::addSitemap(SiteMapManager::route($key), $post->updated_at);
            }
        }

        $categoryLastUpdated = Category::query()
            ->wherePublished()
            ->latest('updated_at')
            ->value('updated_at');

        if ($categoryLastUpdated) {
            SiteMapManager::addSitemap(SiteMapManager::route('projects-projectscategories'), $categoryLastUpdated);
        }

        $tagLastUpdated = Tag::query()
            ->wherePublished()
            ->latest('updated_at')
            ->value('updated_at');

        if ($tagLastUpdated) {
            SiteMapManager::addSitemap(SiteMapManager::route('projects-projectstags'), $tagLastUpdated);
        }
    }
}
