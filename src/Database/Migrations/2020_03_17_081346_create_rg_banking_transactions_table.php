<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgBankingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_banking_transactions', function (Blueprint $table) {
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
            $table->unsignedBigInteger('bank_account_id');
            $table->string('name', 50)->comment('name of transaction e.g. expense, drawing, payment etc'); //name of transaction e.g. expense, drawing, payment etc
            $table->unsignedBigInteger('debit_financial_account_code');
            $table->unsignedBigInteger('credit_financial_account_code');
            $table->date('date');
            //$table->date('value_date');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->string('contact_name', 250)->nullable();
            $table->unsignedDecimal('debit', 20, 5);
            $table->unsignedDecimal('credit', 20, 5);
            $table->string('currency', 4);
            $table->string('method', 50)->nullable()->comment('cash, transfer,cheque,check, credit card etc');
            $table->string('reference', 250)->nullable();
            $table->string('description', 250)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_banking_transactions');
    }
}
