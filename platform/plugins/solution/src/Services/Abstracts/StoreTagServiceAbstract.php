<?php

namespace Botble\Solution\Services\Abstracts;

use Botble\Solution\Models\Post;
use Illuminate\Http\Request;

abstract class StoreTagServiceAbstract
{
    abstract public function execute(Request $request, Post $post): void;
}
