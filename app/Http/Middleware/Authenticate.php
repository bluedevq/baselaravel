<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $area = getArea();

        if (!getGuard()->check() && $request->ajax()) {
            return response()->json([], 401);
        }

        if (!getGuard()->check()) {
            return redirect()->route($area . '.login');
        }

        return $next($request);
    }
}
