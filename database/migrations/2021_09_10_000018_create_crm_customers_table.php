<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('crm_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable()->unique();
            $table->string('gov')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
