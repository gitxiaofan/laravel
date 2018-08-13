<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proone extends Model
{

    protected $table = 'project_one';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'model', 'status', 'region', 'oil_name', 'oil_desc', 'depth', 'shareholder', 'location', 'operator', 'p_power', 's_power', 'bidding_status', 'bs_remark', 'product_time'];

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

    public function status_config($ind = NULL)
    {
        $arr = [
            1 => 'Planning',
            2 => 'Pre-FEED',
            3 => 'FEED',
            4 => 'EPC',
            5 => 'FID',
            6 => 'Building',
            7 => 'Deliver',
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

    public function ProoneRecord()
    {
        return $this->hasMany('App\ProoneRecord','pro_id','id')->orderBy('id','DESC');
    }

}