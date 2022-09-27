<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_counters', function (Blueprint $table) {
            $table->id();
            $table->string('ship_name');
            $table->string('item_description');
            $table->string('part_no');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('last_running_hours');
            $table->string('unit_running');
            $table->integer('running_hours_today');
            $table->integer('update_running_hours');
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
        Schema::dropIfExists('list_counters');
    }
}
