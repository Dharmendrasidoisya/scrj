<?php

namespace Botble\Industry\Industry;

use Botble\Industry\Models\Post;
use Botble\Industry\Industry\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $post->industrycategories()->sync($request->input('industrycategories', []));
    }
}
