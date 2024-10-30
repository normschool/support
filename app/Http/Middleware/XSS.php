<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;
use Mews\Purifier\Facades\Purifier;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            $input = (is_null($input)) ? null : Purifier::clean($input);
        });
        $request->merge($input);

        return $next($request);
    }
}
