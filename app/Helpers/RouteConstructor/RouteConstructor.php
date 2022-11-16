<?php

namespace App\Helpers\RouteConstructor;

use App\Http\Controllers\OrganizationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppleController;

class RouteConstructor
{
    public static $inertiaRoutes = [
        'apples' => AppleController::class
    ];

    public static function constructApiRoutes()
    {
        foreach (static::$inertiaRoutes as $route => $controller) {
            Route::delete("/$route", [$controller, 'destroyByFilter']);
            Route::patch("/$route", [$controller, 'updateByFilter']);
        }
    }

    public static function constructWebRoutes()
    {
        foreach (static::$inertiaRoutes as $route => $controller) {
            Route::apiResource( "/api/" . $route, $controller);
            Route::delete("/api/$route", [$controller, 'destroyByFilter']);
            Route::patch("/api/$route", [$controller, 'updateByFilter']);
            Route::resource($route, $controller, ['as' => 'web_' . $route]);
        }
    }
}
