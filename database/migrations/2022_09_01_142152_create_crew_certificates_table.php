<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_name');
            $table->string('certificate_number');
            $table->string('certificate_type');
            $table->string('issued_at');
            $table->string('certificate_scan')->nullable();
            $table->date('issued_date');
            $table->date('expired_date');
            $table->date('warning_periode');
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
        Schema::dropIfExists('crew_certificates');
    }
}
