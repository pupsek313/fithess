<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = config('app.admin_key');

       
        if (empty($key)) {
            abort(403, 'Нужен ключ администратора');
        }

     
        if ($request->query('key') === $key) {
            $request->session()->put('is_admin', true);
        }

        if (! $request->session()->get('is_admin')) {
            abort(403, 'Нужен ключ администратора');
        }

        return $next($request);
    }
}