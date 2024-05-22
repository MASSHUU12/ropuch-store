<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $str_abilities): Response
    {
        $abilities = explode(',', $str_abilities);

        foreach ($abilities as $ability) {
            if ($request->user()->tokenCan($ability)) return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
