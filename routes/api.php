<?php

use App\Http\Controllers\API\Admin\Types\TypeCreateController;
use App\Http\Controllers\API\Admin\Types\TypeDeleteController;
use App\Http\Controllers\API\Admin\Types\TypeShowController;
use App\Http\Controllers\API\Admin\Types\TypesIndexController;
use App\Http\Controllers\API\Admin\Types\TypeUpdateController;
use App\Http\Middleware\HasAccessToProject;

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::prefix('types')->name('types.')->group(function () {
        Route::post('/', TypeCreateController::class)->name('create');
        Route::get('/', TypesIndexController::class)->name('index');
        Route::prefix('/{type}')->group(function () {
            Route::get('/', TypeShowController::class)->name('show');
            Route::delete('/', TypeDeleteController::class)->name('delete');
            Route::put('/', TypeUpdateController::class)->name('delete');
        });
    });
});
Route::middleware('role:user')->group(function () {
    Route::prefix('projects')->middleware(HasAccessToProject::class)->name('projects.')->group(function () {
        Route::post('/', TypeCreateController::class)->name('create');
        Route::get('/', TypesIndexController::class)->name('index');
        Route::prefix('/{project}')->group(function () {
            Route::get('/', TypeShowController::class)->name('show');
            Route::delete('/', TypeDeleteController::class)->name('delete');
            Route::put('/', TypeUpdateController::class)->name('delete');

            Route::prefix('entities')->name('entities.')->group(function () {
                Route::post('/', TypeCreateController::class)->name('create');
                Route::get('/', TypesIndexController::class)->name('index');
                Route::prefix('/{entity}')->group(function () {
                    Route::get('/', TypeShowController::class)->name('show');
                    Route::delete('/', TypeDeleteController::class)->name('delete');
                    Route::put('/', TypeUpdateController::class)->name('delete');
                });
            });
            Route::prefix('attributes')->name('attributes.')->group(function () {
                Route::post('/', TypeCreateController::class)->name('create');
                Route::get('/', TypesIndexController::class)->name('index');
                Route::prefix('/{attribute}')->group(function () {
                    Route::get('/', TypeShowController::class)->name('show');
                    Route::delete('/', TypeDeleteController::class)->name('delete');
                    Route::put('/', TypeUpdateController::class)->name('delete');
                });
            });
            Route::prefix('relations')->name('relations.')->group(function () {
                Route::post('/', TypeCreateController::class)->name('create');
                Route::get('/', TypesIndexController::class)->name('index');
                Route::prefix('/{relation}')->group(function () {
                    Route::get('/', TypeShowController::class)->name('show');
                    Route::delete('/', TypeDeleteController::class)->name('delete');
                    Route::put('/', TypeUpdateController::class)->name('delete');
                });
            });
        });
    });
});
