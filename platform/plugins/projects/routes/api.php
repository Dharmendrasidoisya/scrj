<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\Projects\Http\Controllers\API',
], function () {
    Route::get('search', 'PostController@getSearch');
    Route::get('projectsposts', 'PostController@index');
    Route::get('projectscategories', 'CategoryController@index');
    Route::get('projectstags', 'TagController@index');

    Route::get('projectsposts/filters', 'PostController@getFilters');
    Route::get('projectsposts/{slug}', 'PostController@findBySlug');
    Route::get('projectscategories/filters', 'CategoryController@getFilters');
    Route::get('projectscategories/{slug}', 'CategoryController@findBySlug');
});
