<?php

namespace Botble\Projects\Projects\Abstracts;

use Botble\Projects\Models\Post;
use Illuminate\Http\Request;

abstract class StoretagserviceAbstract
{
    abstract public function execute(Request $request, Post $post): void;
}
