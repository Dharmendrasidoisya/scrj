<?php

namespace Botble\News\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface TagInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getPopularnewstags(int $limit, array $with = ['slugable'], array $withCount = ['newsposts']): Collection;

    public function getAllnewstags(bool $active = true): Collection;
}
