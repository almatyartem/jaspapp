<?php

namespace App\Services\Swagger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\Swagger\Helpers;

class SetJsonResponseMiddleware
{
    use Helpers;

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }



}
