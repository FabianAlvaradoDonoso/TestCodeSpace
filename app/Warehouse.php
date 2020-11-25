<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable= ['name', 'description' ,'phone', 'address'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
