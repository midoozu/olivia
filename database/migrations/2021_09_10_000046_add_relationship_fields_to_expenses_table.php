<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->foreign('expense_category_id', 'expense_category_fk_4086364')->references('id')->on('expense_categories');
            $table->unsignedBigInteger('cs_expenses_id')->nullable();
            $table->foreign('cs_expenses_id', 'cs_expenses_fk_4350906')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id', 'branch_fk_4793714')->references('id')->on('inventories');
        });
    }
}
