<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_product', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_4806015')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_4806015')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
