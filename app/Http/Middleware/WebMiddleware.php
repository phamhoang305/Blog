<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Route;
use Jenssegers\Agent\Agent;
use App\Models\AppSession;
class WebMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
    protected function isResponseObject($response)
    {
        return is_object($response) && $response instanceof Response;
    }

    protected function isHtmlResponse(Response $response)
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }
}
