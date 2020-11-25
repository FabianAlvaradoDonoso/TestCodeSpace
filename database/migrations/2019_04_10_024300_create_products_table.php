<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->integer('stockMinimum');
            $table->integer('stockCurrent');
            $table->integer('pricePurchase');
            $table->integer('priceSale');
            $table->date('dateAcquisition');
            $table->date('dateExpiration')->nullable();
            $table->boolean('expirate');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->unsignedInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
