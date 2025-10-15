<?php
namespace Botble\Solution\Http\Controllers;

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Botble\Solution\Http\Controllers\SolutionController;
use Botble\Base\Http\Controllers\BaseController;

Route::get('/solutions/details/{id}', [SolutionController::class, 'showDetails'])->name('solutions.details');

Route::group(['namespace' => 'Botble\Solution\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'solution'], function () {
            Route::group(['prefix' => 'sposts', 'as' => 'sposts.'], function () {
                Route::resource('', 'PostController')
                    ->parameters(['' => 'post']);

                Route::get('widgets/recent-sposts', [
                    'as' => 'widget.recent-sposts',
                    'uses' => 'PostController@getWidgetRecentsposts',
                    'permission' => 'sposts.index',
                ]);
            });

            Route::group(['prefix' => 'scategories', 'as' => 'scategories.'], function () {
                Route::resource('', 'CategoryController')
                    ->parameters(['' => 'category']);

                Route::put('update-tree', [
                    'as' => 'update-tree',
                    'uses' => 'CategoryController@updateTree',
                    'permission' => 'scategories.index',
                ]);
            });

            Route::group(['prefix' => 'stags', 'as' => 'stags.'], function () {
                Route::resource('', 'TagController')
                    ->parameters(['' => 'tag']);

                Route::get('all', [
                    'as' => 'all',
                    'uses' => 'TagController@getAllstags',
                    'permission' => 'stags.index',
                ]);
            });
        });

        Route::group(['prefix' => 'settings/solution', 'as' => 'solution.settings', 'permission' => 'solution.settings'], function () {
            Route::get('/', [
                'uses' => 'Settings\SolutionSettingController@edit',
            ]);

            Route::put('/', [
                'as' => '.update',
                'uses' => 'Settings\SolutionSettingController@update',
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
