<?php

namespace Botble\Solution\Services\Abstracts;

use Botble\Solution\Models\Post;
use Illuminate\Http\Request;

abstract class StoreCategoryServiceAbstract
{
    public function __construct()
    {
    }

    abstract public function execute(Request $request, Post $post): void;
}
