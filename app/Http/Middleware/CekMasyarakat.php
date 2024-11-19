<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekMasyarakat
{
    public function handle($ghazwanRequest, Closure $ghazwanNext): Response
    {
        if (Auth::guard('masyarakat')->check()) {
            return $ghazwanNext($ghazwanRequest);
        }

        return redirect('/');
    }
}

