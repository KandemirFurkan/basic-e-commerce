<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $Settings = SiteSettings::pluck('data','name')->toArray();

        $categories= Category::where('status','1')->with('subcategory')->withCount('items')->get();

        view()->share(['Settings'=>$Settings,'categories'=>$categories]);
        return $next($request);
    }
}
