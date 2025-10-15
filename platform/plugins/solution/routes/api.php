<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\Solution\Http\Controllers\API',
], function () {
    Route::get('search', 'PostController@getSearch');
    Route::get('sposts', 'PostController@index');
    Route::get('scategories', 'CategoryController@index');
    Route::get('stags', 'TagController@index');

    Route::get('sposts/filters', 'PostController@getFilters');
    Route::get('sposts/{slug}', 'PostController@findBySlug');
    Route::get('scategories/filters', 'CategoryController@getFilters');
    Route::get('scategories/{slug}', 'CategoryController@findBySlug');
});
