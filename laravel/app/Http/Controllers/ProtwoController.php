<?php

namespace App\Http\Controllers;

use App\Protwo;
use App\ProtwoRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProtwoController extends Controller
{
    public $admin;
    public $gid;
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $protwo = new Protwo();
        $page_size = config('config.PAGE_SIZE') ? config('config.PAGE_SIZE') : 20;
        $projects = $protwo->orderby('id','DESC')->where(function($query) use($request){
            $this->condition($request,$query);
        })->paginate($page_size);
        $this->get_admin();
        $pro_config = [
            'model_config' => $protwo->model_config(),
            'region_config' => $protwo->region_config(),
            'status_config' => $protwo->status_config(),
            'bs_config' => $protwo->bs_config(),
        ];
        $operation = ($this->gid == 1 || $this->gid == 2) ? 'protwo/update' : 'protwo/detail';
        return view('protwo.index',[
            'projects' => $projects,
            'gid' => $this->gid,
            'operation' => $operation,
            'search' => $request->all(),
            'pro_config' => $pro_config,
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
        $protwo = new Protwo();
        $this->get_admin();
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
                'created_admin' => $this->admin['id'],
            ];
            if($res = Protwo::create($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $res->id,
                        'admin_id' => $this->admin['id'],
                        'content' => $record,
                    ];
                    ProtwoRecord::create($data);
                }
                return redirect()->route('protwo_update',[$res->id]);
            }else{
                return redirect()->back();
            }
        }

        return view('protwo.create',[
            'project' => $protwo,
            'gid' => $this->gid,
            'detail' => 0,
        ]);
    }

    public function detail($id)
    {
        $protwo = Protwo::find($id);
        $this->get_admin();
        return view('protwo.detail',[
            'project' => $protwo,
            'gid' => $this->gid,
            'detail' => 1,
        ]);
    }

    public function update(Request $request,$id)
    {
        $protwo = Protwo::find($id);
        $this->get_admin();
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
                'updated_admin' => $this->admin['id'],
            ];

            if($protwo->update($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $id,
                        'admin_id' => $this->admin['id'],
                        'content' => $record,
                    ];
                    ProtwoRecord::create($data);
                }
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }
        return view('protwo.update',[
            'project' => $protwo,
            'gid' => $this->gid,
            'detail' => 0,
        ]);
    }

    public function delete($id)
    {
        Protwo::find($id)->delete();
        return redirect('protwo/index');
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
        $num = ProtwoRecord::find($id)->delete();
        if($num){
            $data = [
                'status' => 1,
                'message' => 'success',
            ];
        }else{
            $data = [
                'status' => 0,
                'message' => 'fail',
            ];
        }
        return json_encode($data);
    }

    private function get_admin()
    {
        $this->admin = Session::get('admin');
        $this->gid = $this->admin['gid'] ? $this->admin['gid'] : 3;
    }

    public function toExcel(Request $request)
    {
        $projects = Protwo::orderby('id','DESC')->where(function($query) use($request){
            $this->condition($request,$query);
        })->get();
        $filename = '生产平台_'.date('Ymd',time()).'.csv';
        $title = ['ID','项目名称','开发方式','地区','项目状态','招投标状态','重大事件记录','记录人'];
        $data = array();
        foreach ($projects as $project){
            $data[] = [
                $project->id,
                $project->name,
                $project->model_config($project->model),
                $project->region_config($project->region),
                $project->status_config($project->status),
                $project->bs_config($project->bidding_status),
                count($project->ProtwoRecord) != 0 ? $project->ProtwoRecord[0]->content : '',
                count($project->ProtwoRecord) != 0 ? $project->ProtwoRecord[0]->Admin->user_name : '',
            ];
        }
        $this->exportToExcel($filename,$title,$data);
    }

    public function detailToExcel($id)
    {
        $project = Protwo::find($id);
        $filename = '项目详情_'. $project->id. '_'. date('Ymd',time()).'.csv';
        $title = ['项目名称', '项目值'];
        $data = [
            ['ID', $project->id],
            ['项目名称', $project->name],
            ['开发方式', $project->model_config($project->model)],
            ['项目状态', $project->status_config($project->status)],
            ['地区', $project->region_config($project->region)],
            ['油气田名称', $project->oil_name],
            ['油气田描述', $project->oil_desc],
            ['水深', $project->depth],
            ['油气田位置', $project->location],
            ['招投标状态', $project->bs_config($project->bidding_status)],
            ['招投标备注', $project->bs_remark],
        ];
        if(isset($project->shareholder) && $project->shareholder){
            $data = array_merge($data,$this->jsonExcel($project->shareholder,'股东权益人','股东权益人'));
        }
        if(isset($project->operator) && $project->operator){
            $data = array_merge($data,$this->jsonExcel($project->operator,'作业方','作业方'));
        }
        if(isset($project->p_power) && $project->p_power){
            $data = array_merge($data,$this->jsonExcel($project->p_power,'处理能力','处理能力'));
        }
        if(isset($project->s_power) && $project->s_power){
            $data = array_merge($data,$this->jsonExcel($project->s_power,'储存能力','储存能力'));
        }
        if(isset($project->product_time) && $project->product_time){
            $data = array_merge($data,$this->jsonExcel($project->product_time,'最终投资决定','最终投资决定和投产时间'));
        }
        if(isset($project->ProtwoRecord) && $project->ProtwoRecord){
            $data[] = ['项目重大事件记录',''];
            $data[] = ['记录时间','大事件内容'];
            foreach($project->ProtwoRecord as $key => $item){
                $data[] = [date( 'Y-m-d H:i:s',$item->created_at),$item->content];
            }
        }
        $this->exportToExcel($filename,$title,$data);
    }

    private function jsonExcel($object,$name,$item_name)
    {
        $data = array();
        $data[] = [$name,''];
        $data[] = ['记录时间',$item_name];
        foreach(json_decode($object,true) as $key => $item){
            $data[] = [$item['time'],$item['content']];
        }
        return $data;
    }

    /**
     * @creator Jimmy
     * @data 2018/1/05
     * @desc 数据导出到excel(csv文件)
     * @param $filename 导出的csv文件名称 如date("Y年m月j日").'-test.csv'
     * @param array $tileArray 所有列名称
     * @param array $dataArray 所有列数据
     */
    public function exportToExcel($filename, $tileArray=[], $dataArray=[]){
        ini_set('memory_limit','512M');
        ini_set('max_execution_time',0);
        ob_end_clean();
        ob_start();
        header("Content-Type: text/csv");
        header("Content-Disposition:filename=".$filename);
        $fp=fopen('php://output','w');
        fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码(比如微信昵称(乱七八糟的))
        fputcsv($fp,$tileArray);
        $index = 0;
        foreach ($dataArray as $item) {
            if($index==1000){
                $index=0;
                ob_flush();
                flush();
            }
            $index++;
            fputcsv($fp,$item);
        }

        ob_flush();
        flush();
        ob_end_clean();
    }


}
