<?php

namespace Botble\Projects\Http\Controllers\API;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Projects\Http\Resources\TagResource;
use Botble\Projects\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * List projectstags
     *
     * @group Projects
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
