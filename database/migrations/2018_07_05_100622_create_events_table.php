<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dateFrom');
            $table->date('dateTo');
            $table->time('timeFrom');
            $table->time('timeTo');
            $table->string('title');
            $table->string('location')->nullable();
            $table->integer('groupId')->nullable();
            $table->text('description')->nullable();
            $table->boolean('fixed')->nullable();
            $table->integer('linkId')->nullable();

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
        Schema::dropIfExists('events');
    }
}
