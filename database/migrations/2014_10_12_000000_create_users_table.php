<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->unsignedInteger('role_id');
                $table->foreign('role_id')->references('id')->on('roles');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->boolean('active')->nullable()->default(false);
                $table->boolean('first_login')->default(false);
                $table->unsignedTinyInteger('login_attempts');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        }
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
