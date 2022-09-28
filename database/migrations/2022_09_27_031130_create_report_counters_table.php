<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_counters', function (Blueprint $table) {
            $table->id();
            $table->string('ship_name');
            $table->string("item_description");
            $table->string("part_no");
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer("last_running_hours");
            $table->integer("update_running_hours");
            $table->integer("total_running_hours");
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
        Schema::dropIfExists('report_counters');
    }
}
