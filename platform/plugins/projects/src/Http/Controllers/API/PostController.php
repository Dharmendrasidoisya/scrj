<?php

namespace Botble\Projects\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Projects\Http\Resources\ListPostResource;
use Botble\Projects\Http\Resources\PostResource;
use Botble\Projects\Models\Post;
use Botble\Projects\Repositories\Interfaces\PostInterface;
use Botble\Projects\Supports\FilterPost;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct(protected PostInterface $postRepository)
    {
    }

    /**
     * List projectsposts
     *
     * @group Projects
     */
    public function index(Request $request)
    {
        $data = $this->postRepository
            ->advancedGet([
                'with' => ['projectstags', 'projectscategories', 'author', 'slugable'],
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
     * @group Projects
     */
    public function getSearch(Request $request, PostInterface $postRepository)
    {
        $query = BaseHelper::stringify($request->input('q'));
        $projectsposts = $postRepository->getSearch($query);

        $data = [
            'items' => $projectsposts,
            'query' => $query,
            'count' => $projectsposts->count(),
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
     * Filters projectsposts
     *
     * @group Projects
     * @queryParam page                 Current page of the collection. Default: 1
     * @queryParam per_page             Maximum number of items to be returned in result set.Default: 10
     * @queryParam search               Limit results to those matching a string.
     * @queryParam after                Limit response to projectsposts published after a given ISO8601 compliant date.
     * @queryParam author               Limit result set to projectsposts assigned to specific authors.
     * @queryParam author_exclude       Ensure result set excludes projectsposts assigned to specific authors.
     * @queryParam before               Limit response to projectsposts published before a given ISO8601 compliant date.
     * @queryParam exclude              Ensure result set excludes specific IDs.
     * @queryParam include              Limit result set to specific IDs.
     * @queryParam order                Order sort attribute ascending or descending. Default: desc .One of: asc, desc
     * @queryParam order_by             Sort collection by object attribute. Default: updated_at. One of: author, created_at, updated_at, id,  slug, title
     * @queryParam projectscategories           Limit result set to all items that have the specified term assigned in the projectscategories taxonomy.
     * @queryParam projectscategories_exclude   Limit result set to all items except those that have the specified term assigned in the projectscategories taxonomy.
     * @queryParam projectstags                 Limit result set to all items that have the specified term assigned in the projectstags taxonomy.
     * @queryParam projectstags_exclude         Limit result set to all items except those that have the specified term assigned in the projectstags taxonomy.
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
     * @group Projects
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
