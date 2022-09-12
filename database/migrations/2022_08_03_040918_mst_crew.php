<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCrew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_crew', function(Blueprint $table){
            $table->string('id_crew')->primary();
            $table->string('full_name');
            $table->string('email');
            $table->foreignId('identity_type');
            $table->string('identity_number');
            $table->string('job_title');
            $table->string('country');
            $table->string('phone');
            $table->string('whatsapp_phone');
            $table->string('gender');
            $table->string('status_merital');
            $table->string('pob');
            $table->date('dob');
            $table->string('duty_on_ship');
            $table->string('address');
            $table->date('join_date');
            $table->string('note');
            $table->string('status');
            $table->date('join_port');
            $table->text('photo')->nullable();
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
        Schema::dropIfExists('mst_crew');
    }
}
