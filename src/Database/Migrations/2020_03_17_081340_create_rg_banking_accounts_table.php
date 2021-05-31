<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgBankingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_banking_accounts', function (Blueprint $table) {
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
            $table->unsignedInteger('bank_id');
            $table->string('external_key', 250);
            $table->unsignedBigInteger('financial_account_code');
            $table->string('type', 50);
            $table->string('name', 100);
            $table->string('number', 250);
            $table->string('country_code', 2);
            $table->string('currency', 4);
            $table->string('code', 50)->nullable();
            $table->string('description', 250)->nullable();
            $table->unsignedTinyInteger('primary')->nullable();
            $table->unsignedTinyInteger('active')->nullable();
            $table->string('routing_number', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_banking_accounts');
    }
}
