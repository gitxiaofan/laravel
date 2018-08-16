<?php

namespace App\Http\Controllers;

use App\Proone;
use App\ProoneRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProoneController extends Controller
{

    public function index(Request $request)
    {
        $projects = Proone::orderby('id','DESC')->where(function($query) use($request){
            $this->condition($request,$query);
        })->paginate(20);
        return view('proone.index',[
            'projects' => $projects,
        ]);
    }

    private function condition($request,$query)
    {
        if($name = $request->input('name')){
            $query->where('name','LIKE','%'.$name.'%');
        }
        if($model = $request->input('model')){
            $query->where('model','=',$model);
        }
        if($status = $request->input('status')){
            $query->where('status','=',$status);
        }
        if($region = $request->input('region')){
            $query->where('region','=',$region);
        }
        if($bidding_status = $request->input('bidding_status')){
            $query->where('bidding_status','=',$bidding_status);
        }
    }

    public function create(Request $request)
    {
        $proone = new Proone();

        if($request->isMethod('post')){

            $validate = \Validator::make($request->input(),[
                'name' => 'required|min:2|max:100',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'name' => '项目名称',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if($shareholders = $request->input('shareholder')){
                $shareholder = $this->data_json($shareholders);
            }
            if($operators = $request->input('operator')){
                $operator = $this->data_json($operators);
            }
            if($p_powers = $request->input('p_power')){
                $p_power = $this->data_json($p_powers);
            }
            if($s_powers = $request->input('s_power')){
                $s_power = $this->data_json($s_powers);
            }
            if($product_times = $request->input('product_time')){
                $product_time = $this->data_json($product_times);
            }
            $admin = Session::get('admin');
            $data = [
                'name' => $request->input('name') ? $request->input('name') : '',
                'model' => intval($request->input('model')),
                'status' => intval($request->input('status')),
                'region' => intval($request->input('region')),
                'oil_name' => $request->input('oil_name') ? $request->input('oil_name') : '',
                'oil_desc' => $request->input('oil_desc') ? $request->input('oil_desc') : '',
                'depth' => $request->input('depth') ? $request->input('depth') : '',
                'shareholder' => isset($shareholder) ? $shareholder : '',
                'location' => $request->input('location') ? $request->input('location') : '',
                'operator' => isset($operator) ? $operator : '',
                'p_power' => isset($p_power) ? $p_power : '',
                's_power' => isset($s_power) ? $s_power : '',
                'bidding_status' => intval($request->input('bidding_status')),
                'bs_remark' => $request->input('bs_remark') ? $request->input('bs_remark') : '',
                'product_time' => isset($product_time) ? $product_time : '',
                'created_admin' => $admin['id'],
            ];
            if($res = Proone::create($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $res->id,
                        'admin_id' => $admin['id'],
                        'content' => $record,
                    ];
                    ProoneRecord::create($data);
                }
                return redirect('proone/index');
            }else{
                return redirect()->back();
            }
        }

        return view('proone.create',[
            'project' => $proone,
        ]);
    }

    public function update(Request $request,$id)
    {
        $proone = Proone::find($id);
        if($request->isMethod('post')){

            $validate = \Validator::make($request->input(),[
                'name' => 'required|min:2|max:100',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
            ],[
                'name' => '项目名称',
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if($shareholders = $request->input('shareholder')){
                $shareholder = $this->data_json($shareholders);
            }
            if($operators = $request->input('operator')){
                $operator = $this->data_json($operators);
            }
            if($p_powers = $request->input('p_power')){
                $p_power = $this->data_json($p_powers);
            }
            if($s_powers = $request->input('s_power')){
                $s_power = $this->data_json($s_powers);
            }
            if($product_times = $request->input('product_time')){
                $product_time = $this->data_json($product_times);
            }
            $admin = Session::get('admin');
            $data = [
                'name' => $request->input('name') ? $request->input('name') : '',
                'model' => intval($request->input('model')),
                'status' => intval($request->input('status')),
                'region' => intval($request->input('region')),
                'oil_name' => $request->input('oil_name') ? $request->input('oil_name') : '',
                'oil_desc' => $request->input('oil_desc') ? $request->input('oil_desc') : '',
                'depth' => $request->input('depth') ? $request->input('depth') : '',
                'shareholder' => isset($shareholder) ? $shareholder : '',
                'location' => $request->input('location') ? $request->input('location') : '',
                'operator' => isset($operator) ? $operator : '',
                'p_power' => isset($p_power) ? $p_power : '',
                's_power' => isset($s_power) ? $s_power : '',
                'bidding_status' => intval($request->input('bidding_status')),
                'bs_remark' => $request->input('bs_remark') ? $request->input('bs_remark') : '',
                'product_time' => isset($product_time) ? $product_time : '',
                'updated_admin' => $admin['id'],
            ];

            if($proone->update($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $id,
                        'admin_id' => $admin['id'],
                        'content' => $record,
                    ];
                    ProoneRecord::create($data);
                }
                return redirect('proone/index');
            }else{
                return redirect()->back();
            }
        }
        return view('proone.update',[
            'project' => $proone,
        ]);
    }

    public function delete($id)
    {
        Proone::find($id)->delete();
        return redirect('proone/index');
    }

    private function data_json($input)
    {
        $list = '';
        foreach ($input['time'] as $key => $val){
            $list[] = [
                'time' => $val,
                'content' => $input['content'][$key],
            ];
        }
        return json_encode($list);
    }

    public function deleteRecord($id)
    {
        $num = ProoneRecord::find($id)->delete();
        return $num;
    }

}