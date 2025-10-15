<?php

namespace Botble\Projects\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface TagInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getPopularprojectstags(int $limit, array $with = ['slugable'], array $withCount = ['projectsposts']): Collection;

    public function getAllprojectstags(bool $active = true): Collection;
}
