<?php

namespace App\Http\Middleware;

use App\AdminStatus;
use Closure;
use Illuminate\Support\Facades\Session;

class AdminVisitor
{
    public function handle($request, Closure $next)
    {

        $admin = Session::get('admin');
        if (!$admin['id']){
            return $next($request);
        }

        if($admin['gid'] !== 1 && $admin['gid'] == 3){
            $this->update_visited_time($request,$admin['id']);
        }

        return $next($request);
    }

    private function update_visited_time($request,$admin_id)
    {
        $ip = ip2long($request->getClientIp());
        $admin_status = AdminStatus::where('admin_id','=',$admin_id)->where('ip','=',$ip)->first();
        if(!$admin_status){
            $admin_status = new AdminStatus();
        }
        $admin_status->admin_id = $admin_id;
        $admin_status->ip = $ip;
        $admin_status->last_visited_time = time();
        $admin_status->save();
    }
}