<?php

namespace Botble\News\News\Abstracts;

use Botble\News\Models\Post;
use Illuminate\Http\Request;

abstract class StoreCategoryServiceAbstract
{
    public function __construct()
    {
    }

    abstract public function execute(Request $request, Post $post): void;
}
