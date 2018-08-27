<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        $admin = Session::get('admin');
        if ($admin['id']){
            return redirect('index');
        }
        if($request->isMethod('post')){
            $validate = \Validator::make($request->input(),[
                'user_name' => 'required',
                'password' => 'required',
            ],[
                'required' => ':attribute 为必填项'
            ],[
                'user_name' => '用户名',
                'password' => '密码',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $res = Admin::where('user_name','=',$request->input('user_name'))
                ->where('password','=',md5($request->input('password')))
                ->first();
            if($res){
                if($res->status == 2){
                    return redirect()->back()->withErrors(['您的账户已被冻结，请联系管理员处理！'])->withInput();
                }
                $admin = [
                    'id' => $res->id,
                    'gid' => $res->gid,
                    'user_name' => $res->user_name,
                    'nickname' => $res->nickname,
                    'mobile' => $res->mobile,
                    'email' => $res->email,
                ];
                //创建访问时间
                if($admin['gid'] == 3){
                    $this->update_admin_status($request,$res);
                }
                Session::put('admin',$admin);
                return redirect('index');
            }else{
                return redirect()->back()->withErrors(['用户名或密码错误'])->withInput();
            }
        }
        return view('login.index');
    }

    public function logout(Request $request)
    {
        $admin = Session::get('admin');
        if($admin['gid'] == 3){
            $ip = ip2long($request->getClientIp());
            $admin_status = AdminStatus::where('admin_id','=',$admin['id'])->where('ip','=',$ip)->first();
            if($admin_status){
                $admin_status->delete();
            }
        }
        Session::forget('admin');
        return redirect('login');
    }

    private function update_admin_status($request,$admin)
    {
        $ip = ip2long($request->getClientIp());
        $session_expiretime = config('session.lifetime');
        if(!$ip || $session_expiretime){
            return;
        }
        $admin_status = AdminStatus::where('admin_id','=',$admin->id)->where('last_visited_time','>=',time() - $session_expiretime * 60)->first();
        if($admin_status){
            if($admin_status->ip == $ip){
                $admin_status->last_visited_time = time();
                $admin_status->save();
            }else{
                $this->update_vistited_time($admin->id,$ip);
                $admin->status = 2;
                $admin->save();
            }
        }else{
            $this->update_vistited_time($admin->id,$ip);
        }

    }

    private function update_vistited_time($admin_id,$ip)
    {
        $admin_status = new AdminStatus();
        $admin_status->admin_id = $admin_id;
        $admin_status->ip = $ip;
        $admin_status->last_visited_time = time();
        $admin_status->save();
    }
}