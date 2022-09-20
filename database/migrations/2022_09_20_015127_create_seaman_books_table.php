<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeamanBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seaman_books', function (Blueprint $table) {
            $table->id();
            $table->string('id_crew');
            $table->string('number');
            $table->string('institution_name');
            $table->date('issued_date');
            $table->date('expired_date');
            $table->date('warning_period');
            $table->string('book_scan')->nullable();
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
        Schema::dropIfExists('seaman_books');
    }
}
