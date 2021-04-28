<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'id_user','id_event','name_leader', 'name_member',
        // 'contact_leader', 'schema', 'note'
        Schema::create('join_events', function (Blueprint $table) {
            $table->id();

            $table->string('id_user');
            $table->string('id_event');
            $table->string('name_leader');
            $table->string('name_member')->nullable();
            $table->string('contact_leader');
            $table->string('schema')->nullable();
            $table->string('note')->nullable();

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
        Schema::dropIfExists('join_events');
    }
}
