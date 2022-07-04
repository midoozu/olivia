<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_4806001')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_4806002')->references('id')->on('doctors');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id', 'branch_fk_4847351')->references('id')->on('inventories');
        });
    }
}
