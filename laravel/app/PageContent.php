<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{

    protected $table = 'page_content';

    protected $primaryKey = 'id';

    protected $fillable = ['page_id','content'];

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