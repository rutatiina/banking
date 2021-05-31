<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgBankingTransactionImportQueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_banking_transaction_import_que', function (Blueprint $table) {
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
            $table->string('hash', 32);
            $table->unsignedBigInteger('txn_id');
            $table->unsignedBigInteger('statement_id');
            $table->date('date');
            $table->date('value_date')->nullable();
            $table->string('description', 250)->nullable();
            $table->string('contact', 100)->nullable();
            $table->string('reference', 250)->nullable();
            $table->unsignedDecimal('debit', 20, 5);
            $table->unsignedDecimal('credit', 20, 5);
            $table->unsignedDecimal('balance', 20, 5);
            $table->string('currency', 4);
            $table->unsignedBigInteger('rule_id')->nullable();
            $table->string('status', 20);
            $table->string('error_message', 250)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_banking_transaction_import_que');
    }
}
