<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $page_size = config('config.PAGE_SIZE') ? config('config.PAGE_SIZE') : 20;
        $admins = Admin::orderby('id','DESC')->where(function($query) use($request){
            if($user_name = $request->input('user_name')){
                $query->where('user_name','LIKE','%'.$user_name.'%');
            }
        })->paginate($page_size);

        return view('admin.index',[
            'admins' => $admins,
            'search' => $request->all(),
        ]);
    }

    public function create(Request $request)
    {
        $admin = new Admin();
        if ($request->isMethod('POST')){

            $validate = \Validator::make($request->input(),[
                'user_name' => 'required|min:2|max:50',
                'password' => 'required'
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'user_name' => '用户名',
                'password' => '密码'
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $data = [
                'user_name' => $request->input('user_name'),
                'password' => md5($request->input('password')),
                'nickname' => $request->input('nickname') ? $request->input('nickname'):'',
                'mobile' => $request->input('mobile') ? $request->input('mobile') : '',
                'email' => $request->input('email') ? $request->input('email'):'',
                'sex' => $request->input('sex') ? $request->input('sex'):0,
                'gid' => $request->input('gid') ? $request->input('gid'):3,
            ];
            if(Admin::create($data)){
                return redirect('admin/index');
            }else{
                return redirect()->back();
            }
        }
        return view('admin.create',[
            'admin' => $admin
        ]);
    }

    public function update(Request $request,$id)
    {
        $admin = Admin::find($id);

        if($request->isMethod('POST')){

            $validate = \Validator::make($request->input(),[
                'user_name' => 'required|min:2|max:50',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'user_name' => '用户名',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $admin->user_name = $request->input('user_name');
            if($request->input('password')){
                $admin->password = md5($request->input('password'));
            }
            $admin->nickname = $request->input('nickname');
            $admin->mobile = $request->input('mobile');
            $admin->email = $request->input('email');
            $admin->sex = $request->input('sex');
            $admin->gid = $request->input('gid');

            if($admin->save()){
                return redirect('admin/index');
            }else{
                return redirect()->back();
            }
        }

        return view('admin.update',[
            'admin' => $admin,
        ]);
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->back();
    }

    public function check_name(Request $request)
    {
        $user_name = $request->input('user_name');

        if($id = $request->input('id')){
            $res = Admin::where('id', '!=', $id)->where('user_name','=',$user_name)->first();
        }else{
            $res = Admin::where('user_name', '=', $user_name)->first();
        }

        if($res){
            return 'false';
        }else{
            return 'true';
        }
    }
}