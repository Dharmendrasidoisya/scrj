<?php

namespace Botble\News\News\Abstracts;

use Botble\News\Models\Post;
use Illuminate\Http\Request;

abstract class StoretagserviceAbstract
{
    abstract public function execute(Request $request, Post $post): void;
}
