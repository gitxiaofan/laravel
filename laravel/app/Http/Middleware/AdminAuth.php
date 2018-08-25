<?php

namespace App\Http\Middleware;

use App\AdminStatus;
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
            $action = $request->route()->getAction()['as'];
            if(!$roles || !in_array($action,$roles)){
                return redirect('role');
            }
        }

        return $next($request);
    }
}