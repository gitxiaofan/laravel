<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'page';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'cat_id', 'keywords', 'brief', 'admin_id'];

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

    public function PageContent()
    {
        return $this->hasOne('App\PageContent','page_id','id');
    }


}