<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCrewEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_crew_education', function(Blueprint $table){
            $table->id();
            $table->string('id_crew');
            $table->string('instance_nm');
            $table->string('scan_certificate')->nullable();
            $table->string('more_information');
            $table->string('status');
            $table->string('year_in');
            $table->string('year_out');
            $table->timestampsTz();
            $table->string('created_user');
            $table->string('updated_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_crew_education');
    }
}
