<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protwo extends Model
{

    protected $table = 'project_two';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'model', 'status', 'contractor', 'region', 'design', 'depth desc', 'lease', 'bidding_status', 'bs_remark', 'created_admin', 'updated_admin'];

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

    public function status_config($ind = NULL)
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

    public function ProtwoRecord()
    {
        return $this->hasMany('App\ProtwoRecord','pro_id','id')->orderBy('id','DESC');
    }

}