<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncomesTable extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedBigInteger('income_category_id')->nullable();
            $table->foreign('income_category_id', 'income_category_fk_4086372')->references('id')->on('income_categories');
            $table->unsignedBigInteger('cs_name_id')->nullable();
            $table->foreign('cs_name_id', 'cs_name_fk_4152626')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id', 'branch_fk_4793715')->references('id')->on('inventories');
        });
    }
}
