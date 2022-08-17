<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstItemUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_item_unit', function(Blueprint $table){
            $table->string('code_unit')->primary();
            $table->string('code_main_group')->unique();
            $table->string('code_group')->unique();
            $table->string('code_sub_group')->unique();
            $table->string('unit_name');
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
        Schema::dropIfExists('mst_item_unit');
    }
}
