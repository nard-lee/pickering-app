<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) 
        {
            return '/login';
        }
    }
}
