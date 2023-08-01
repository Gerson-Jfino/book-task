<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('activities')){
            Schema::create('activities', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('name');
                $table->string('manager', 255);
                $table->unsignedInteger('status_id');
                $table->foreign('status_id')->references('id')->on('status');
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('owner', 255);
                $table->date('start_date');
                $table->date('due_date')->nullable();
                $table->date('final_date');
                $table->text('status_situation')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
