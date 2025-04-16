<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use GrantHolle\Altcha\Rules\ValidAltcha;

class Altcha
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    public function handle(Request $request, Closure $next)
    {
        // Check for altcha token
        if (!$request->has('altcha')) {
            // Encode original request for resubmission
            $payload = base64_encode(json_encode([
                'url' => $request->url(),
                'method' => $request->method(),
                'data' => $request->except('_token'),
            ]));

            return response()->view('altcha.altcha-middleware', [
                'payload' => $payload,
                '_token' => csrf_token(),
                'originalUrl' => $request->fullUrl(),
            ]);
        }

        $request->validate([
            'altcha' => ['required', new ValidAltcha()],
        ]);

        $payload = json_decode(base64_decode($request->input('__payload')), true);
        // Merge original data back into current request
        $request->merge($payload['data']);
        
        return $next($request);
    }
}
