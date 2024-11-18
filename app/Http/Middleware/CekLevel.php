<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($ghazwanRequest, Closure $ghazwanNext, ...$ghazwanLevels): Response
    {
        if(in_array($ghazwanRequest->user()->level, $ghazwanLevels)){
            return $ghazwanNext($ghazwanRequest);

        }

        return redirect('/');
    }
}
