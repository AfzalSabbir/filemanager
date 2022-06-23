<?php

namespace Backpack\FileManager\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class FileMangerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if($elfinder_default = Session::get('elfinder_default')) {
            Config::set('elfinder.default', $elfinder_default);
        }
        return $next($request);
    }
}
