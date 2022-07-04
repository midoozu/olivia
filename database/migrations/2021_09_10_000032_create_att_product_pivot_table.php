<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('att_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_4098756')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('att_id');
            $table->foreign('att_id', 'att_id_fk_4098756')->references('id')->on('atts')->onDelete('cascade');
        });
    }
}
