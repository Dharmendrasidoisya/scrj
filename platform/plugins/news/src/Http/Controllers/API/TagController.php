<?php

namespace Botble\News\Http\Controllers\API;

use Botble\Base\Http\Controllers\BaseController;
use Botble\News\Http\Resources\TagResource;
use Botble\News\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * List newstags
     *
     * @group News
     */
    public function index(Request $request)
    {
        $data = Tag::query()
            ->wherePublished()
            ->with('slugable')
            ->paginate($request->integer('per_page', 10) ?: 10);

        return $this
            ->httpResponse()
            ->setData(TagResource::collection($data))
            ->toApiResponse();
    }
}
