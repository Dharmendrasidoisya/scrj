<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Botble\Projects\Http\Controllers\ProjectsCategoryController;
use Botble\Projects\Http\Controllers\PostController;

use Botble\Projects\Http\Controllers\ProjectsPostController;


// Route::get('subcategory/{id}', [ProjectsCategoryController::class, 'showSubcategories'])->name('subcategory');
// Route::get('subcategory/{id}/{slug}', [ProjectsCategoryController::class, 'showSubcategories'])->name('subcategory');
Route::get('/subcategory/{id}', [ProjectsCategoryController::class, 'subcategory'])->name('subcategory');
Route::get('/projects-category/{id}', [ProjectsCategoryController::class, 'show'])->name('projectscategory.show');

// Route::get('/projectspost/{id}', [PostController::class, 'show'])->name('projectspost.show');
Route::get('/category/{id}/projects', [ProjectsCategoryController::class, 'showCategoryPosts'])->name('category.posts');

Route::get('/service-post/{id}', [ProjectsPostController::class, 'show'])->name('servicepost.show');


Route::group(['namespace' => 'Botble\Projects\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'projects'], function () {
            Route::group(['prefix' => 'projectsposts', 'as' => 'projectsposts.'], function () {
                Route::resource('', 'PostController')
                    ->parameters(['' => 'post']);

                Route::get('widgets/recent-projectsposts', [
                    'as' => 'widget.recent-projectsposts',
                    'uses' => 'PostController@getWidgetRecentprojectsposts',
                    'permission' => 'projectsposts.index',
                ]);
            });

            Route::group(['prefix' => 'projectscategories', 'as' => 'projectscategories.'], function () {
                Route::resource('', 'CategoryController')
                    ->parameters(['' => 'category']);

                Route::put('update-tree', [
                    'as' => 'update-tree',
                    'uses' => 'CategoryController@updateTree',
                    'permission' => 'projectscategories.index',
                ]);
            });

            Route::group(['prefix' => 'projectstags', 'as' => 'projectstags.'], function () {
                Route::resource('', 'TagController')
                    ->parameters(['' => 'tag']);

                Route::get('all', [
                    'as' => 'all',
                    'uses' => 'TagController@getAllprojectstags',
                    'permission' => 'projectstags.index',
                ]);
            });
        });

        Route::group(['prefix' => 'settings/projects', 'as' => 'projects.settings', 'permission' => 'projects.settings'], function () {
            Route::get('/', [
                'uses' => 'Settings\ProjectsSettingController@edit',
            ]);

            Route::put('/', [
                'as' => '.update',
                'uses' => 'Settings\ProjectsSettingController@update',
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
