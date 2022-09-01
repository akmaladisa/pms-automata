<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('id_crew');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('salary_transfer');
            $table->string('remarks');
            $table->string('status');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crew_bank_accounts');
    }
}
