<?php

namespace Botble\News\News;

use Botble\News\Models\Post;
use Botble\News\News\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $post->newscategories()->sync($request->input('newscategories', []));
    }
}
