<?php

namespace App\Http\Controllers;

use App\Proone;
use App\ProoneRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProoneController extends Controller
{

    public function index()
    {
        $projects = Proone::orderby('id','DESC')->paginate(20);

        return view('proone.index',[
            'projects' => $projects,
        ]);
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
            ];
            if($res = Proone::create($data)){
                if($record = $request->input('event_record')){
                    $admin = Session::get('admin');
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
        $proone_records = ProoneRecord::where('pro_id','=',$id)->get();
        //dd($proone_records);
        return view('proone.update',[
            'project' => $proone,
            'project_record' => $proone_records,
        ]);
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

}