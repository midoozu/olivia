<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_service', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_4805968')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_4805968')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
