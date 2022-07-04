<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCrmCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->unsignedBigInteger('cus_status_id')->nullable();
            $table->foreign('cus_status_id', 'cus_status_fk_4119609')->references('id')->on('crm_statuses');
        });
    }
}
