<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = 'admin';

    protected $primaryKey = 'id';

    protected $fillable = ['user_name','password','nickname','email','mobile','sex'];

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

    public function sex($ind = NULL)
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
}