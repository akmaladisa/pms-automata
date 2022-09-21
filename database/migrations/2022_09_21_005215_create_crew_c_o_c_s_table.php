<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewCOCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_coc', function (Blueprint $table) {
            $table->id();
            $table->string('id_crew');
            $table->string('certificate_rank');
            $table->string('certificate_number');
            $table->date('confirmed');
            $table->string('institution_name');
            $table->string('certificate_scan')->nullable();
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
        Schema::dropIfExists('crew_coc');
    }
}
