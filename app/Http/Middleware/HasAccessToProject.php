<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAccessToProject
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->organisation->id === $request->route()->parameters['project']->organisation->id) {
            return $next($request);
        }

        abort(403);
    }
}
