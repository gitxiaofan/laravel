<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public $admin;
    public $gid;
    public function index(Request $request)
    {
        $page_size = config('config.PAGE_SIZE') ? config('config.PAGE_SIZE') : 20;
        $pages = Page::orderby('id','DESC')->where(function($query) use($request){
            if($title = $request->input('title')){
                $query->where('title','LIKE','%'.$title.'%');
            }
        })->paginate($page_size);

        return view('page.index',[
            'pages' => $pages,
            'search' => $request->all(),
        ]);
    }

    public function create(Request $request)
    {
        $page = new Page();
        if($request->isMethod('post')){

            $validate = \Validator::make($request->input(),[
                'title' => 'required|min:2|max:100',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'title' => '页面标题',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $this->get_admin();
            $data = [
                'title' => $request->input('title'),
                'admin_id' => $this->admin['id'],
            ];
            if($res = Page::create($data)){
                $content = $request->input('content') ? $request->input('content') : '';
                $data = [
                    'page_id' => $res->id,
                    'content' => $content,
                ];
                PageContent::create($data);
                return redirect('page/index');
            }else{
                return redirect()->back();
            }
        }
        return view('page.create',[
            'page' => $page,
        ]);
    }

    public function detail($id)
    {
        $page = Page::find($id);

        return view('page.detail',[
            'page' => $page,
        ]);
    }

    public function update(Request $request,$id)
    {
        $page = Page::find($id);
        if($request->isMethod('post')){

            $validate = \Validator::make($request->input(),[
                'title' => 'required|min:2|max:100',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'title' => '页面标题',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $this->get_admin();
            $data = [
                'title' => $request->input('title'),
                'admin_id' => $this->admin['id'],
            ];
            if($page->update($data)){
                $content = $request->input('content') ? $request->input('content') : '';
                $data = [
                    'page_id' => $id,
                    'content' => $content,
                ];
                $page->PageContent()->update($data);
                return redirect('page/index');
            }else{
                return redirect()->back();
            }
        }

        return view('page.update',[
            'page' => $page,
        ]);
    }

    public function delete($id)
    {
        Page::find($id)->delete();
        if($id){
            PageContent::where('page_id','=',$id)->delete();
        }
        return redirect('page/index');
    }

    private function get_admin()
    {
        $this->admin = Session::get('admin');
        $this->gid = $this->admin['gid'] ? $this->admin['gid'] : 3;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $extension = $photo->extension();
            $filename = time().mt_rand(100,999). '.'. $extension;
            $store_result = $photo->storeAs('public', $filename);
            $data = [
                'success' => true,
                'file_path' => '/storage/'. $filename,
            ];
            return response()->json($data);
        }
        $data = array(
            'success' => false
        );
        return response()->json($data);
    }

}