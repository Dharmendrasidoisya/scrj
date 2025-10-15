<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\News\Http\Controllers\API',
], function () {
    Route::get('search', 'PostController@getSearch');
    Route::get('newsposts', 'PostController@index');
    Route::get('newscategories', 'CategoryController@index');
    Route::get('newstags', 'TagController@index');

    Route::get('newsposts/filters', 'PostController@getFilters');
    Route::get('newsposts/{slug}', 'PostController@findBySlug');
    Route::get('newscategories/filters', 'CategoryController@getFilters');
    Route::get('newscategories/{slug}', 'CategoryController@findBySlug');
});
