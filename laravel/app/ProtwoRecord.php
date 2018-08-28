<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProtwoRecord extends Model
{

    protected $table = 'project_two_record';

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

    public function Admin()
    {
        return $this->hasOne('App\Admin','id','admin_id');
    }

}