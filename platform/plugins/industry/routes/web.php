<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Botble\Industry\Http\Controllers\IndustryCategoryController;
use Botble\Industry\Http\Controllers\PostController;

use Botble\Industry\Http\Controllers\IndustryPostController;


// Route::get('subcategory/{id}', [IndustryCategoryController::class, 'showSubcategories'])->name('subcategory');
// Route::get('subcategory/{id}/{slug}', [IndustryCategoryController::class, 'showSubcategories'])->name('subcategory');
Route::get('/subcategory/{id}', [IndustryCategoryController::class, 'subcategory'])->name('subcategory');
Route::get('/industry-category/{id}', [IndustryCategoryController::class, 'show'])->name('industrycategory.show');

// Route::get('/industrypost/{id}', [PostController::class, 'show'])->name('industrypost.show');
Route::get('/category/{id}/industry', [IndustryCategoryController::class, 'showCategoryPosts'])->name('category.posts');

Route::get('/service-post/{id}', [IndustryPostController::class, 'show'])->name('servicepost.show');


Route::group(['namespace' => 'Botble\Industry\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'industry'], function () {
            Route::group(['prefix' => 'industryposts', 'as' => 'industryposts.'], function () {
                Route::resource('', 'PostController')
                    ->parameters(['' => 'post']);

                Route::get('widgets/recent-industryposts', [
                    'as' => 'widget.recent-industryposts',
                    'uses' => 'PostController@getWidgetRecentindustryposts',
                    'permission' => 'industryposts.index',
                ]);
            });

            Route::group(['prefix' => 'industrycategories', 'as' => 'industrycategories.'], function () {
                Route::resource('', 'CategoryController')
                    ->parameters(['' => 'category']);

                Route::put('update-tree', [
                    'as' => 'update-tree',
                    'uses' => 'CategoryController@updateTree',
                    'permission' => 'industrycategories.index',
                ]);
            });

            Route::group(['prefix' => 'industrytags', 'as' => 'industrytags.'], function () {
                Route::resource('', 'TagController')
                    ->parameters(['' => 'tag']);

                Route::get('all', [
                    'as' => 'all',
                    'uses' => 'TagController@getAllindustrytags',
                    'permission' => 'industrytags.index',
                ]);
            });
        });

        Route::group(['prefix' => 'settings/industry', 'as' => 'industry.settings', 'permission' => 'industry.settings'], function () {
            Route::get('/', [
                'uses' => 'Settings\IndustrySettingController@edit',
            ]);

            Route::put('/', [
                'as' => '.update',
                'uses' => 'Settings\IndustrySettingController@update',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Theme::registerRoutes(function () {
            Route::get('search', [
                'as' => 'public.search',
                'uses' => 'PublicController@getSearch',
            ]);
        });
    }
});
