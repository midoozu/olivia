<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start_time');
            $table->datetime('finish_time');
            $table->float('weight', 5, 2)->nullable();
            $table->string('circum')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('comment')->nullable();
            $table->integer('pulse')->nullable();
            $table->boolean('follow_up')->default(0)->nullable();
            $table->boolean('check_in')->default(0)->nullable();
            $table->boolean('check_out')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
