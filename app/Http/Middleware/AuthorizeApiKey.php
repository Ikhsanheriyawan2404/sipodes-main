<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Key;
use Illuminate\Http\Request;

class AuthorizeApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $value = request()->header('X-Authorization');
        if ($value === Key::first()->key) {
            return $next($request);
        }

        return response([
            'errors' => [[
                'message' => 'Unauthorized'
            ]]
        ], 401);
    }
}
