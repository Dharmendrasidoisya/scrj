<?php

namespace Botble\Industry\Industry\Abstracts;

use Botble\Industry\Models\Post;
use Illuminate\Http\Request;

abstract class StoretagserviceAbstract
{
    abstract public function execute(Request $request, Post $post): void;
}
