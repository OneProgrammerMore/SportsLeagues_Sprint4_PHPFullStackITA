<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use GrantHolle\Altcha\Altcha;

class AltchaController extends Controller
{
    public function validateAltcha (Request $request) {
        return null;
    }
    public function challenge()
    {
        return app(Altcha::class)
            ->createChallenge();
    }
}