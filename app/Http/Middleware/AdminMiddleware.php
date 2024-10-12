<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, что пользователь авторизован и имеет роль администратора
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Или перенаправление на страницу авторизации /login
        }

        return $next($request);
    }
}

