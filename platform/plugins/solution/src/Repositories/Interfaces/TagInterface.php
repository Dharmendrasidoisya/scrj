<?php

namespace Botble\Solution\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface TagInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getPopularstags(int $limit, array $with = ['slugable'], array $withCount = ['sposts']): Collection;

    public function getAllstags(bool $active = true): Collection;
}
