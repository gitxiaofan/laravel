<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        $admin = Session::get('admin');
        if (isset($admin) && $admin['id']){
            return $next($request);
        }

        return redirect('login');
    }
}