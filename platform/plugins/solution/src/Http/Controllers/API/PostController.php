<?php

namespace Botble\Solution\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Solution\Http\Resources\ListPostResource;
use Botble\Solution\Http\Resources\PostResource;
use Botble\Solution\Models\Post;
use Botble\Solution\Repositories\Interfaces\PostInterface;
use Botble\Solution\Supports\FilterPost;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct(protected PostInterface $postRepository)
    {
    }

    /**
     * List sposts
     *
     * @group Solution
     */
    public function index(Request $request)
    {
        $data = $this->postRepository
            ->advancedGet([
                'with' => ['stags', 'scategories', 'author', 'slugable'],
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                'paginate' => [
                    'per_page' => $request->integer('per_page', 10),
                    'current_paged' => $request->integer('page', 1),
                ],
            ]);

        return $this
            ->httpResponse()
            ->setData(ListPostResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Search post
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Solution
     */
    public function getSearch(Request $request, PostInterface $postRepository)
    {
        $query = BaseHelper::stringify($request->input('q'));
        $sposts = $postRepository->getSearch($query);

        $data = [
            'items' => $sposts,
            'query' => $query,
            'count' => $sposts->count(),
        ];

        if ($data['count'] > 0) {
            return $this
                ->httpResponse()
                ->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data));
        }

        return $this
            ->httpResponse()
            ->setError()
            ->setMessage(trans('core/base::layouts.no_search_result'));
    }

    /**
     * Filters sposts
     *
     * @group Solution
     * @queryParam page                 Current page of the collection. Default: 1
     * @queryParam per_page             Maximum number of items to be returned in result set.Default: 10
     * @queryParam search               Limit results to those matching a string.
     * @queryParam after                Limit response to sposts published after a given ISO8601 compliant date.
     * @queryParam author               Limit result set to sposts assigned to specific authors.
     * @queryParam author_exclude       Ensure result set excludes sposts assigned to specific authors.
     * @queryParam before               Limit response to sposts published before a given ISO8601 compliant date.
     * @queryParam exclude              Ensure result set excludes specific IDs.
     * @queryParam include              Limit result set to specific IDs.
     * @queryParam order                Order sort attribute ascending or descending. Default: desc .One of: asc, desc
     * @queryParam order_by             Sort collection by object attribute. Default: updated_at. One of: author, created_at, updated_at, id,  slug, title
     * @queryParam scategories           Limit result set to all items that have the specified term assigned in the scategories taxonomy.
     * @queryParam scategories_exclude   Limit result set to all items except those that have the specified term assigned in the scategories taxonomy.
     * @queryParam stags                 Limit result set to all items that have the specified term assigned in the stags taxonomy.
     * @queryParam stags_exclude         Limit result set to all items except those that have the specified term assigned in the stags taxonomy.
     * @queryParam featured             Limit result set to items that are sticky.
     */
    public function getFilters(Request $request)
    {
        $filters = FilterPost::setFilters($request->input());

        $data = $this->postRepository->getFilters($filters);

        return $this
            ->httpResponse()
            ->setData(ListPostResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Get post by slug
     *
     * @group Solution
     * @queryParam slug Find by slug of post.
     */
    public function findBySlug(string $slug)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Post::class));

        if (! $slug) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage('Not found');
        }

        $post = Post::query()
            ->where([
                'id' => $slug->reference_id,
                'status' => BaseStatusEnum::PUBLISHED,
            ])
            ->first();

        if (! $post) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage('Not found');
        }

        return $this
            ->httpResponse()
            ->setData(new PostResource($post))
            ->toApiResponse();
    }
}
