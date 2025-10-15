<?php

namespace Botble\News\Repositories\Eloquent;

use Botble\News\Repositories\Interfaces\TagInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Illuminate\Support\Collection;

class TagRepository extends RepositoriesAbstract implements TagInterface
{
    public function getDataSiteMap(): Collection
    {
        $data = $this->model
            ->with('slugable')
            ->wherePublished()
            ->orderByDesc('created_at')
            ->select(['id', 'name', 'updated_at']);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getPopularnewstags(int $limit, array $with = ['slugable'], array $withCount = ['newsposts']): Collection
    {
        $data = $this->model
            ->with($with)
            ->withCount($withCount)
            ->orderByDesc('newsposts_count')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getAllnewstags($active = true): Collection
    {
        $data = $this->model;
        if ($active) {
            $data = $data->wherePublished();
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
