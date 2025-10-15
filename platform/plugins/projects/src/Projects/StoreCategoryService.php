<?php

namespace Botble\Projects\Projects;

use Botble\Projects\Models\Post;
use Botble\Projects\Projects\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $post->projectscategories()->sync($request->input('projectscategories', []));
    }
}
