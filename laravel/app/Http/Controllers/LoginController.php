<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index(Request $request)
    {
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
                $admin = [
                    'id' => $res->id,
                    'gid' => $res->gid,
                    'user_name' => $res->user_name,
                    'nickname' => $res->nickname,
                    'mobile' => $res->mobile,
                    'email' => $res->email,
                ];
                Session::put('admin',$admin);
                return redirect('index');
            }else{
                return redirect()->back()->withErrors(['用户名或密码错误'])->withInput();
            }
        }
        return view('login.index');
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect('login');
    }
}