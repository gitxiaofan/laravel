<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminStatus extends Model
{

    protected $table = 'admin_status';

    protected $primaryKey = 'id';

    protected $fillable = ['admin_id', 'ip', 'last_visited_time'];

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