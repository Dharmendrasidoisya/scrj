<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Botble\News\Http\Controllers\NewsCategoryController;
use Botble\News\Http\Controllers\PostController;

use Botble\News\Http\Controllers\NewsPostController;


// Route::get('subcategory/{id}', [NewsCategoryController::class, 'showSubcategories'])->name('subcategory');
// Route::get('subcategory/{id}/{slug}', [NewsCategoryController::class, 'showSubcategories'])->name('subcategory');
Route::get('/subcategory/{id}', [NewsCategoryController::class, 'subcategory'])->name('subcategory');
Route::get('/news-category/{id}', [NewsCategoryController::class, 'show'])->name('newscategory.show');

// Route::get('/newspost/{id}', [PostController::class, 'show'])->name('newspost.show');
Route::get('/category/{id}/news', [NewsCategoryController::class, 'showCategoryPosts'])->name('category.posts');

Route::get('/service-post/{id}', [NewsPostController::class, 'show'])->name('servicepost.show');


Route::group(['namespace' => 'Botble\News\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'news'], function () {
            Route::group(['prefix' => 'newsposts', 'as' => 'newsposts.'], function () {
                Route::resource('', 'PostController')
                    ->parameters(['' => 'post']);

                Route::get('widgets/recent-newsposts', [
                    'as' => 'widget.recent-newsposts',
                    'uses' => 'PostController@getWidgetRecentnewsposts',
                    'permission' => 'newsposts.index',
                ]);
            });

            Route::group(['prefix' => 'newscategories', 'as' => 'newscategories.'], function () {
                Route::resource('', 'CategoryController')
                    ->parameters(['' => 'category']);

                Route::put('update-tree', [
                    'as' => 'update-tree',
                    'uses' => 'CategoryController@updateTree',
                    'permission' => 'newscategories.index',
                ]);
            });

            Route::group(['prefix' => 'newstags', 'as' => 'newstags.'], function () {
                Route::resource('', 'TagController')
                    ->parameters(['' => 'tag']);

                Route::get('all', [
                    'as' => 'all',
                    'uses' => 'TagController@getAllnewstags',
                    'permission' => 'newstags.index',
                ]);
            });
        });

        Route::group(['prefix' => 'settings/news', 'as' => 'news.settings', 'permission' => 'news.settings'], function () {
            Route::get('/', [
                'uses' => 'Settings\NewsSettingController@edit',
            ]);

            Route::put('/', [
                'as' => '.update',
                'uses' => 'Settings\NewsSettingController@update',
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
