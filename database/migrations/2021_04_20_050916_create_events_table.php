<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
    //     'time_start',
    //   'time_reglimit'
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('id_user');
            $table->string('name');
            $table->string('cost');
            $table->text('poster_event')->nullable();
            $table->string('category');
            $table->text('location');
            $table->text('description');
            $table->text('benefits');
            $table->text('requirements');
            $table->string('organizer');
            $table->string('contact_organizer');
            $table->text('status');
            $table->text('time_start');
            $table->text('time_reglimit');

            $table->softDeletes();
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
