<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proone extends Model
{

    protected $table = 'project_one';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'model',
        'status',
        'region',
        'oil_name',
        'oil_desc',
        'depth',
        'shareholder',
        'location',
        'operator',
        'p_power',
        's_power',
        'bidding_status',
        'bs_remark',
        'product_time',
        'created_admin',
        'updated_admin',
        'contractor',
        'design',
        'lease',
        'desc',
        'type',
        'port',
        'background',
        'working_range',
    ];

    public function freshTimestamp()
    {
        return time();
    }

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

    public function fromDateTime($value)
    {
        return $value;
    }

    public function model_config($ind = NULL)
    {
        $arr = [
            1 => 'FPSO',
            2 => 'FLNG',
            3 => 'Semi',
            4 => 'TLP',
            5 => 'Jacket',
            6 => 'Concrete',
            7 => 'Others',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : 'Unknown';
        }
        return $arr;
    }

    public function model_two_config($ind = NULL)
    {
        $arr = [
            1 => 'Jackup',
            2 => 'Semisub',
            3 => 'Drillship',
            4 => 'Others',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : 'Unknown';
        }
        return $arr;
    }

    public function model_three_config($ind = NULL)
    {
        $arr = [
            1 => 'S Lay',
            2 => 'J lay',
            3 => 'S Lay + J Lay',
            4 => 'SSCV',
            5 => 'Others',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : 'Unknown';
        }
        return $arr;
    }

    public function model_four_config($ind = NULL)
    {
        $arr = [
            1 => '新造',
            2 => '租赁',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function status_config($ind = NULL)
    {
        $arr = [
            1 => '计划中',
            2 => '预前端设计',
            3 => '前端设计',
            4 => '设计、采购、建造',
            5 => '最终投资决定',
            6 => '建造中',
            7 => '已交付',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : 'Unknown';
        }
        return $arr;
    }

    public function status_two_config($ind = NULL)
    {
        $arr = [
            1 => '计划中',
            2 => '招标中',
            3 => '设计、采购、建造',
            4 => '建造中',
            5 => '已交付',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : 'Unknown';
        }
        return $arr;
    }

    public function region_config($ind = NULL)
    {
        $arr = [
            1 => '亚洲',
            2 => '欧洲',
            3 => '北美',
            4 => '南美',
            5 => '大洋洲',
            6 => '中东',
            7 => '非洲',
            8 => '其他',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function region_two_config($ind = NULL)
    {
        $arr = [
            1 => '全球水域',
            2 => '恶劣水域',
            3 => '一般水域',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function bs_config($ind = NULL)
    {
        $arr = [
            1 => '招标未开始',
            2 => '招标邀请将要发出',
            3 => '招标邀请已发出',
            4 => '标书已经提交',
            5 => '已授标',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function type_config($ind = NUll)
    {
        $arr = [
            1 => '浮式生产装置',
            2 => '钻井生活平台',
            3 => '起重铺管船',
            4 => '浮式储存和再气化船',
            5 => '液化天然气模块',
            6 => '水下设施和工程',
            7 => '更多项目',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function ProoneRecord()
    {
        return $this->hasMany('App\ProoneRecord','pro_id','id')->orderBy('id','DESC');
    }

}