<?php

namespace Botble\Solution\Services;

use Botble\Solution\Models\Post;
use Botble\Solution\Services\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $post->scategories()->sync($request->input('scategories', []));
    }
}
