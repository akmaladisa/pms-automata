<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_country', function( Blueprint $table ){
            $table->string('id_country')->primary();
            $table->string('country_nm');
            $table->string('description');
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
        Schema::dropIfExists('mst_country');
    }
}
