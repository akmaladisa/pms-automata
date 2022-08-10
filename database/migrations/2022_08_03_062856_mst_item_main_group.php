<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstItemMainGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_item_main_group', function(Blueprint $table){
            $table->id();
            $table->string('kode_barang');
            $table->string('code_main_group');
            $table->string('main_group_name');
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
        Schema::dropIfExists('mst_item_main_group');
    }
}
