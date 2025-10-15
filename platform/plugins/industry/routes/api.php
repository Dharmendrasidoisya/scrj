<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\Industry\Http\Controllers\API',
], function () {
    Route::get('search', 'PostController@getSearch');
    Route::get('industryposts', 'PostController@index');
    Route::get('industrycategories', 'CategoryController@index');
    Route::get('industrytags', 'TagController@index');

    Route::get('industryposts/filters', 'PostController@getFilters');
    Route::get('industryposts/{slug}', 'PostController@findBySlug');
    Route::get('industrycategories/filters', 'CategoryController@getFilters');
    Route::get('industrycategories/{slug}', 'CategoryController@findBySlug');
});
