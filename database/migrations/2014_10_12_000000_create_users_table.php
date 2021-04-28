<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'name',
        // 'email',
        // 'password',
        // 'phone_number',
        // 'majors',
        // 'study_program',
        // 'year_generation',
        // 'gender',
        // 'address',
        // 'roles'
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('phone_number');
            $table->string('majors');
            $table->string('study_program');
            $table->string('year_generation');
            $table->string('gender');
            $table->text('address');
            $table->string('roles')->default('mahasiswa');
            $table->text('token_notif')->nullable();


            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();


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
        Schema::dropIfExists('users');
    }
}
