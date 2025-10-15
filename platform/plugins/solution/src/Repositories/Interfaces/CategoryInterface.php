<?php

namespace Botble\Solution\Repositories\Interfaces;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Solution\Models\Category;
use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryInterface extends RepositoryInterface
{
    public function getDataSiteMap(): Collection;

    public function getFeaturedscategories(int|null $limit, array $with = []): Collection;

    public function getAllscategories(array $condition = [], array $with = []): Collection;

    public function getCategoryById(int|string|null $id): ?Category;

    public function getscategories(array $select, array $orderBy, array $conditions = ['status' => BaseStatusEnum::PUBLISHED]): Collection;

    public function getAllRelatedChildrenIds(int|string|null|BaseModel $id): array;

    public function getAllscategoriesWithChildren(array $condition = [], array $with = [], array $select = ['*']): Collection;

    public function getFilters(array $filters): LengthAwarePaginator;

    public function getPopularscategories(int $limit, array $with = ['slugable'], array $withCount = ['sposts']): Collection;
}
