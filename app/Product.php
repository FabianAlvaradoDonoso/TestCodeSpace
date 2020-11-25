<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable= ['code', 'name' ,'stockMinimum', 'stockCurrent',
                          'pricePurchase', 'priceSale', 'dateAcquisition',
                          'dateExpiration', 'category_id', 'supplier_id',
                          'warehouse_id'];

    public function category(){
        return $this->belongsTo(Category::class)->select('id', 'name');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class)->select('id', 'name');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class)->select('id', 'name');
    }


    //En el caso de querer guardad las ventas, se podria crear un modelo de Venta con tabla pivote con
    //producto y hacer una relacion muchos a muchos.
}
