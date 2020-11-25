<?php

namespace App;

use App\CareerCourse;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable= ['name', 'code'];

    public function careers()
    {
        return $this->belongsToMany('App\Career')->withPivot('id');;
    }
}
