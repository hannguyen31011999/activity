<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_created');
            $table->string('activity_name');
            $table->date('date_start');
            $table->string('address');
            $table->tinyInteger('total_user')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('costs_incurred')->nullable();
            $table->integer('total_revenue')->nullable();
            $table->integer('total_expenditure')->nullable();
            $table->text('activity_url');
            $table->tinyInteger('status_activity');
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
        Schema::dropIfExists('activity');
    }
}
