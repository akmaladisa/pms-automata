<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCrewWo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_crew_wo', function(Blueprint $table){
            $table->id();
            $table->string('id_crew');
            $table->string('company_nm');
            $table->string('last_position');
            $table->integer('year_in');
            $table->integer('year_out');
            $table->string('certificate')->nullable();
            $table->string('remarks');
            $table->string('status');
            $table->timestampsTz();
            $table->string('created_user');
            $table->string('updated_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_crew_wo');
    }
}
