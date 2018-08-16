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

        if($admin['gid'] !== 1){
            $roles = array();
            switch ($admin['gid']){
                case 2:
                    $roles = config('admin.editor');
                    break;
                case 3:
                    $roles = config('admin.visitor');
                    break;
                default:
                    $roles = array();
                    break;
            }
            dd($roles);
            /*
            $action = $request->route()->getAction()['as'];
            if(!in_array($action,$roles)){
                return '无权限';
            }
            */
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