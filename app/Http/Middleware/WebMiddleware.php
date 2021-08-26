<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Route;
use Jenssegers\Agent\Agent;
use App\Models\AppSession;
class WebMiddleware
{
    public function handle($Request, Closure $next)
    {
        return $next($Request);
    }
}
