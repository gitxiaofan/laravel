<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = 'admin';

    protected $primaryKey = 'id';

    protected $fillable = ['user_name','password','nickname','email','mobile','sex','gid','status'];

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

    public function sex_config($ind = NULL)
    {
        $arr = [
            1 => '男',
            2 => '女',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '保密';
        }
        return $arr;
    }

    public function role_config($ind = NULL)
    {
        $arr = [
            3 => '访客',
            2 => '编辑',
            1 => '管理员',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

    public function status_config($ind = NULL)
    {
        $arr = [
            1 => '正常',
            2 => '冻结',
        ];

        if ($ind !== NULL){
            return array_key_exists($ind,$arr) ? $arr[$ind] : '未知';
        }
        return $arr;
    }

}