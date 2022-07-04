<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttsTable extends Migration
{
    public function up()
    {
        Schema::create('atts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
