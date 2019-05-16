<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelUtama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('main_tables');
        Schema::create('main_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid')->unique();
            $table->string('ad');
            $table->string('direction');
            $table->string('opr');
            $table->string('airline');
            $table->string('callsign');
            $table->string('regno');
            $table->string('time');
            $table->string('new_time');
            $table->string('est');
            $table->string('airport');
            $table->string('nbd');
            $table->string('act');
            $table->string('bay');
            $table->string('block');
            $table->string('bridge');
            $table->string('status');
            $table->string('scope');
            $table->string('datehour');
            $table->string('via');
            $table->string('aircraft');
            $table->string('arr');
            $table->string('dep');
            $table->string('desks');
            $table->string('gate');
            $table->string('belt');
            $table->string('closed');
            $table->string('delay_reason');
            $table->string('scheduled');
            $table->string('opr_time');
            $table->string('desk_open');
            $table->string('desk_close');
            $table->string('desks_custom');
            $table->string('ap');
            $table->string('complete');
            $table->string('codeshare');
            $table->string('noopr');
            $table->string('terminal');
            $table->string('key');
            $table->string('runway');
            $table->string('modified');
            $table->string('airport_name');
            $table->string('closed_opr');
            $table->string('fstat');
            $table->string('bag_first');
            $table->string('bag_last');
            $table->string('gate_close');
            $table->string('callsign2');
            $table->string('note');
            $table->string('ftype');
            $table->string('delay');
            $table->string('delay_level');
            $table->string('status_label');
            $table->string('diverted');
            $table->string('first_block');
            $table->string('airports3');
            $table->string('bridge_dock');
            $table->string('bridge_undock');
            $table->string('ok');
            $table->string('via1');
            $table->string('via2');
            $table->string('via3');
            $table->string('key_v2');
            $table->string('desks_range');
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
        Schema::dropIfExists('main_tables');
    }
}
