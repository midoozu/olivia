<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id', 'size_fk_4096096')->references('id')->on('sizes');
            $table->unsignedBigInteger('inv_name_id')->nullable();
            $table->foreign('inv_name_id', 'inv_name_fk_4403331')->references('id')->on('inventories');
        });
    }
}
