<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!$request->user() || !$request->user()->hasPermissionTo($permission)) {
            return redirect('/')->with('error', 'Accès non autorisé');
        }

        return $next($request);
    }
}
