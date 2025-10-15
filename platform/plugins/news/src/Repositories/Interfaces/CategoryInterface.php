<?php

namespace Botble\News\Repositories\Interfaces;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\News\Models\Category;
use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getFeaturednewscategories(int|null $limit, array $with = []): Collection;

    public function getAllnewscategories(array $condition = [], array $with = []): Collection;

    public function getCategoryById(int|string|null $id): ?Category;

    public function getnewscategories(array $select, array $orderBy, array $conditions = ['status' => BaseStatusEnum::PUBLISHED]): Collection;

    public function getAllRelatedChildrenIds(int|string|null|BaseModel $id): array;

    public function getAllnewscategoriesWithChildren(array $condition = [], array $with = [], array $select = ['*']): Collection;

    public function getFilters(array $filters): LengthAwarePaginator;

    public function getPopularnewscategories(int $limit, array $with = ['slugable'], array $withCount = ['newsposts']): Collection;
}
