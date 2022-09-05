<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCrewMedicalRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_crew_medical_record', function(Blueprint $table) {
            $table->id();
            $table->string('id_crew');
            $table->integer('height');
            $table->integer('weight');
            $table->string('blood_type');
            $table->date('mcu_validity_date');
            $table->date('mcu_expired');
            $table->date('warning_period');
            $table->string('history_of_pain');
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
        Schema::dropIfExists('mst_crew_medical_record');
    }
}
