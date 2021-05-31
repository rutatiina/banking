<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgBankingStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_banking_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //>> default columns
            $table->softDeletes();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            //<< default columns

            //>> table columns
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('hash', 35);
            $table->unsignedBigInteger('bank_account_id');
            $table->string('file_name', 250);
            $table->unsignedBigInteger('file_size');
            $table->unsignedInteger('file_rows');
            $table->unsignedInteger('file_columns');
            $table->string('saved_as', 250);
            $table->string('date_format', 20);
            $table->string('debit_format', 20);
            $table->string('credit_format', 20);
            $table->string('field_mapping', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_banking_statements');
    }
}
