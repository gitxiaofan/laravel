<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProoneRecord extends Model
{

    protected $table = 'project_one_record';

    protected $primaryKey = 'id';

    protected $fillable = ['pro_id','admin_id','content'];

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

}