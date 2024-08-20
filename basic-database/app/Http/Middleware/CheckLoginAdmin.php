<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * Request $request tiếp nhận các request
     *  Closure $next có cho phép request tiếp tục đến controller không
     */
    public function handle(Request $request, Closure $next): Response
    {
        echo 'Middleware web start...';
        return $next($request);
    }
}
