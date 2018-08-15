<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {

        $admin = Session::get('admin');
        if (!$admin['id']){
            return redirect('login');
        }

        //dd($request->route()->getAction()['as']);
        /*
        if($request->route()->getAction()['as'] == 'one_update'){
            return redirect('login');
        }
        */

        return $next($request);
    }
}