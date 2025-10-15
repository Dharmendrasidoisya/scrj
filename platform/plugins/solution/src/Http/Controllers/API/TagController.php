<?php

namespace Botble\Solution\Http\Controllers\API;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Solution\Http\Resources\TagResource;
use Botble\Solution\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * List stags
     *
     * @group Solution
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
