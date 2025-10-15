<?php

namespace Botble\Industry\Http\Controllers\API;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Industry\Http\Resources\TagResource;
use Botble\Industry\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * List industrytags
     *
     * @group Industry
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
