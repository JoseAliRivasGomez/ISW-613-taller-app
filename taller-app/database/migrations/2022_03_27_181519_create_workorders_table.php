<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('user_id');
            $table->string('car_initial_state');
            $table->timestamp('car_initial_date');
            $table->string('car_final_state');
            $table->timestamp('car_final_date');
            $table->double('car_workorder_price');
            $table->timestamps(); //this must be on every migration
            /*NOW THE REFERENCES FOR FOREIGN KEYS*/ 
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('state_id')->references('id')->on('workorder_states');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workorders');
    }
};
