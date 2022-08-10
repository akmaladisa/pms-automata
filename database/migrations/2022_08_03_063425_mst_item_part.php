<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstItemPart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_item_part', function(Blueprint $table){
            $table->id();
            $table->string('code_part');
            $table->string('code_main_group');
            $table->string('code_group');
            $table->string('code_sub_group');
            $table->string('code_unit');
            $table->string('code_component');
            $table->string('part_name');
            $table->boolean('is_deleted');
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
        Schema::dropIfExists('mst_item_part');
    }
}
