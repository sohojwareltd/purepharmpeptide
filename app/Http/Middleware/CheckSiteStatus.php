<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if site is active from environment variable
        $siteActive = env('SITE_ACTIVE', true);
        
        // If site is not active and not accessing admin panel
        if (!$siteActive && !$request->is('admin/*') && !$request->is('livewire/*')) {
            return response()->view('coming-soon');
        }

        return $next($request);
    }
}
