<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class CheckTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:teams|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        return $next($request);
    }
}
