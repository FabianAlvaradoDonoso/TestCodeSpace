<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable= ['name', 'code'];

    public function courses()
    {
        return $this->belongsToMany('App\Course')->withPivot('id');
    }
}
