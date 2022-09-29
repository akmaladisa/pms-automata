<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('ship_name');
            $table->string('item_description');
            $table->string('part_no');
            $table->string('departement');
            $table->string('vendor');
            $table->integer('stock');
            $table->string('unit_stock');
            $table->integer('stock_minimum');
            $table->string('unit_stock_minimum');
            $table->string('location');
            $table->date('date');
            $table->string('remarks');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
