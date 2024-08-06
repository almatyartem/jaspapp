<?php

use App\Services\Swagger\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::get("/".config("swagger.url"), [DocumentationController::class, "showViewDocumentation"]);
    Route::get("/".config("swagger.url")."/json", [DocumentationController::class, "showJsonDocumentation"])->name("swagger.json");
});
