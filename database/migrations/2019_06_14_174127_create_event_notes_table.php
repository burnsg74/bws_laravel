<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.4.1)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateEventNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 255)->default('');
            $table->string('name', 255);
            $table->nullableTimestamps();

            $table->unique('code', 'code');

            

        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_notes');
    }
}
