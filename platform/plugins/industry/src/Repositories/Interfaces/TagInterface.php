<?php

namespace Botble\Industry\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface TagInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getPopularindustrytags(int $limit, array $with = ['slugable'], array $withCount = ['industryposts']): Collection;

    public function getAllindustrytags(bool $active = true): Collection;
}
