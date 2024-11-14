<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelsettingMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        $Settings = SiteSettings::pluck('data','name')->toArray();

        view()->share(['Settings'=>$Settings]);

        return $next($request);
    }
}
