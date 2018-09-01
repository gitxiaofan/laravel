<?php

namespace App\Http\Controllers;

use App\Proone;
use App\ProoneMore;
use App\ProoneRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProoneController extends Controller
{
    public $admin;
    public $gid;
    public function __construct()
    {

    }

    public function index(Request $request,$type)
    {
        $proone = new Proone();
        $page_size = config('config.PAGE_SIZE') ? config('config.PAGE_SIZE') : 20;
        $projects = $proone->orderby('id','DESC')->where('type','=',$type)->where(function($query) use($request){
            $this->condition($request,$query);
        })->paginate($page_size);
        $this->get_admin();
        $pro_config = $this->get_config($proone,$type);
        $operation = ($this->gid == 1 || $this->gid == 2) ? 'proone/update' : 'proone/detail';
        return view('proone.index',[
            'projects' => $projects,
            'gid' => $this->gid,
            'operation' => $operation,
            'search' => $request->all(),
            'pro_config' => $pro_config,
            'type' => $type,
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
        if($contractor = $request->input('contractor')){
            $query->where('contractor','LIKE','%'.$contractor.'%');
        }
        if($operator = $request->input('operator')){
            $json_operator = str_replace('\\','\\\\',trim(json_encode($operator),'"'));
            $query->where('operator','LIKE','%'.$json_operator.'%');
        }
    }

    public function create(Request $request,$type)
    {
        $proone = new Proone();
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
                'type' => $type,
                'contractor' => $request->input('contractor') ? $request->input('contractor') : '',
                'design' => $request->input('design') ? $request->input('design') : '',
                'desc' => $request->input('desc') ? $request->input('desc') : '',
                'lease' => $request->input('lease') ? $request->input('lease') : '',
                'port' => $request->input('port') ? $request->input('port') : '',
                'background' => $request->input('background') ? $request->input('background') : '',
                'working_range' => $request->input('working_range') ? $request->input('working_range') : '',
            ];
            if($res = Proone::create($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $res->id,
                        'admin_id' => $this->admin['id'],
                        'content' => $record,
                    ];
                    ProoneRecord::create($data);
                }
                if($more = $request->input('more')){
                    $data = array();
                    foreach ($more as $v){
                        $data[] = [
                            'pro_id' => $res->id,
                            'name' => $v['name'] ? $v['name'] : '',
                            'value' => $v['value'] ? $v['value'] : '',
                            'sort' => $v['sort'] ? intval($v['sort']) : 0,
                        ];
                    }
                    $proone_more = new ProoneMore();
                    $proone_more->insert($data);
                }
                return redirect()->route('proone_update',[$res->id]);
            }else{
                return redirect()->back();
            }
        }

        return view('proone.create',[
            'project' => $proone,
            'gid' => $this->gid,
            'detail' => 0,
            'type' => $type,
            'pro_config' => $this->get_config($proone,$type),
        ]);
    }

    public function detail($id)
    {
        $proone = Proone::find($id);
        $this->get_admin();
        return view('proone.detail',[
            'project' => $proone,
            'gid' => $this->gid,
            'detail' => 1,
            'type' => $proone->type,
            'pro_config' => $this->get_config($proone,$proone->type),
        ]);
    }

    public function update(Request $request,$id)
    {
        $proone = Proone::find($id);
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
                'type' => $proone->type,
                'contractor' => $request->input('contractor') ? $request->input('contractor') : '',
                'design' => $request->input('design') ? $request->input('design') : '',
                'desc' => $request->input('desc') ? $request->input('desc') : '',
                'lease' => $request->input('lease') ? $request->input('lease') : '',
                'port' => $request->input('port') ? $request->input('port') : '',
                'background' => $request->input('background') ? $request->input('background') : '',
                'working_range' => $request->input('working_range') ? $request->input('working_range') : '',
            ];

            if($proone->update($data)){
                if($record = $request->input('event_record')){
                    $data = [
                        'pro_id' => $id,
                        'admin_id' => $this->admin['id'],
                        'content' => $record,
                    ];
                    ProoneRecord::create($data);
                }
                if($more = $request->input('more')){
                    $data = array();
                    foreach ($more as $v){
                        $data[] = [
                            'id' => $v['id'],
                            'value' => $v['value'] ? $v['value'] : '',
                        ];
                    }
                    $proone_more = new ProoneMore();
                    $proone_more->updateBatch($data);
                }
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }
        return view('proone.update',[
            'project' => $proone,
            'gid' => $this->gid,
            'detail' => 0,
            'type' => $proone->type,
            'pro_config' => $this->get_config($proone,$proone->type),
        ]);
    }

    public function delete($id)
    {
        $project = Proone::find($id);
        $type = $project->type;
        $project->delete();
        if ($id){
            ProoneRecord::where('pro_id','=',$id)->delete();
            ProoneMore::where('pro_id','=',$id)->delete();
        }
        return redirect('proone/index/'. $type);
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

    public function toExcel(Request $request,$type)
    {
        $proone = new Proone();
        $pro_config = $this->get_config($proone,$type);
        $projects = $proone->orderby('id','DESC')->where('type','=',$type)->where(function($query) use($request){
            $this->condition($request,$query);
        })->get();
        $filename = $proone->type_config($type).'_'. date('Ymd',time()).'.csv';
        switch ($type){
            case 1:
            case 4:
                $title = ['ID','项目名称','开发方式','地区','项目状态','招投标状态','重大事件记录','记录人'];
                $data = array();
                foreach ($projects as $project){
                    $data[] = [
                        $project->id,
                        $project->name,
                        $pro_config['model_config'][$project->model],
                        $pro_config['region_config'][$project->region],
                        $pro_config['status_config'][$project->status],
                        $project->bs_config($project->bidding_status),
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '',
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '',
                    ];
                }
                break;
            case 2:
            case 3:
                $title = ['ID','项目名称','平台型式','承包商','项目状态','招投标状态','重大事件记录','记录人'];
                $data = array();
                foreach ($projects as $project){
                    $data[] = [
                        $project->id,
                        $project->name,
                        $pro_config['model_config'][$project->model],
                        $project->contractor,
                        $pro_config['status_config'][$project->status],
                        $project->bs_config($project->bidding_status),
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '',
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '',
                    ];
                }
                break;
            case 5:
            case 6:
                $title = ['ID','项目名称','作业方','地区','项目状态','招投标状态','重大事件记录','记录人'];
                $data = array();
                foreach ($projects as $project){
                    $data[] = [
                        $project->id,
                        $project->name,
                        count($operator = json_decode($project->operator,true)) != 0 ? $operator[0]['content'] : '',
                        $pro_config['region_config'][$project->region],
                        $pro_config['status_config'][$project->status],
                        $project->bs_config($project->bidding_status),
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '',
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '',
                    ];
                }
                break;
            default:
                $title = ['ID','项目名称','项目状态','招投标状态','重大事件记录','记录人'];
                $data = array();
                foreach ($projects as $project){
                    $data[] = [
                        $project->id,
                        $project->name,
                        $pro_config['status_config'][$project->status],
                        $project->bs_config($project->bidding_status),
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '',
                        count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '',
                    ];
                }
                break;
        }

        $this->exportToExcel($filename,$title,$data);
    }

    public function detailToExcel($id)
    {
        $project = Proone::find($id);
        $pro_config = $this->get_config($project,$project->type);
        $filename = '项目详情_'. $project->id. '_'. date('Ymd',time()).'.csv';
        $title = ['项目名称', '项目值'];
        switch ($project->type){
            case 1:
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['开发方式', $pro_config['model_config'][$project->model]],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['地区', $pro_config['region_config'][$project->region]],
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
                break;
            case 2:
            case 3:
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['平台型式', $pro_config['model_config'][$project->model]],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['承包商', $project->contractor],
                    ['目标市场地区', $pro_config['region_config'][$project->region]],
                    ['平台设计', $project->design],
                    ['工作水深', $project->depth],
                    ['项目描述', $project->desc],
                    ['租约状态', $project->lease],
                    ['招投标状态', $project->bs_config($project->bidding_status)],
                    ['招投标备注', $project->bs_remark],
                ];
                break;
            case 4:
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['港口地', $project->port],
                    ['开发方式', $pro_config['model_config'][$project->model]],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['地区', $pro_config['region_config'][$project->region]],
                    ['项目背景', $project->background],
                    ['招投标状态', $project->bs_config($project->bidding_status)],
                    ['招投标备注', $project->bs_remark],
                ];
                if(isset($project->shareholder) && $project->shareholder){
                    $data = array_merge($data,$this->jsonExcel($project->shareholder,'股东权益人','股东权益人'));
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
                break;
            case 5:
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['港口地', $project->port],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['地区', $pro_config['region_config'][$project->region]],
                    ['项目描述', $project->desc],
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
                if(isset($project->product_time) && $project->product_time){
                    $data = array_merge($data,$this->jsonExcel($project->product_time,'最终投资决定','最终投资决定和投产时间'));
                }
                break;
            case 6:
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['地区', $pro_config['region_config'][$project->region]],
                    ['油气田名称', $project->oil_name],
                    ['油气田描述', $project->oil_desc],
                    ['水深', $project->depth],
                    ['油气田位置', $project->location],
                    ['工作范围', $project->working_range],
                    ['招投标状态', $project->bs_config($project->bidding_status)],
                    ['招投标备注', $project->bs_remark],
                ];
                if(isset($project->shareholder) && $project->shareholder){
                    $data = array_merge($data,$this->jsonExcel($project->shareholder,'股东权益人','股东权益人'));
                }
                if(isset($project->operator) && $project->operator){
                    $data = array_merge($data,$this->jsonExcel($project->operator,'作业方','作业方'));
                }
                if(isset($project->product_time) && $project->product_time){
                    $data = array_merge($data,$this->jsonExcel($project->product_time,'最终投资决定','最终投资决定和投产时间'));
                }
                break;

            default :
                $data = [
                    ['ID', $project->id],
                    ['项目名称', $project->name],
                    ['项目类别', $project->type_config($project->type)],
                    ['项目状态', $pro_config['status_config'][$project->status]],
                    ['地区', $pro_config['region_config'][$project->region]],
                    ['招投标状态', $project->bs_config($project->bidding_status)],
                    ['招投标备注', $project->bs_remark],
                ];
                break;

        }

        if(isset($project->ProoneRecord) && $project->ProoneRecord){
            $data[] = ['项目重大事件记录',''];
            $data[] = ['记录时间','大事件内容'];
            foreach($project->ProoneRecord as $key => $item){
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

    private function get_config($proone,$type)
    {
        switch ($type){
            case 1:
                $model_config = $proone->model_config();
                $status_config = $proone->status_config();
                $region_config = $proone->region_config();
                break;
            case 2:
                $model_config = $proone->model_two_config();
                $status_config = $proone->status_two_config();
                $region_config = $proone->region_two_config();
                break;
            case 3:
                $model_config = $proone->model_three_config();
                $status_config = $proone->status_two_config();
                $region_config = $proone->region_two_config();
                break;
            case 4:
                $model_config = $proone->model_four_config();
                $status_config = $proone->status_config();
                $region_config = $proone->region_config();
                break;
            case 5:
                $model_config = $proone->model_config();
                $status_config = $proone->status_config();
                $region_config = $proone->region_config();
                break;
            case 6:
                $model_config = $proone->model_config();
                $status_config = $proone->status_config();
                $region_config = $proone->region_config();
                break;
            default:
                $model_config = $proone->model_config();
                $status_config = $proone->status_config();
                $region_config = $proone->region_config();
                break;
        }

        $pro_config = [
            'model_config' => $model_config,
            'region_config' => $region_config,
            'status_config' => $status_config,
            'bs_config' => $proone->bs_config(),
            'type_config' => $proone->type_config(),
        ];
        return $pro_config;
    }


}
