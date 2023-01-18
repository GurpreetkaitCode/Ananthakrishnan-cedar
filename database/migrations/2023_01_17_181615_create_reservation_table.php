<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_no')->nullable();
            $table->string('guest_first_name')->nullable();
            $table->string('guest_last_name')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('room')->nullable();
            $table->integer('unit_no')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('revenue')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();
            $table->string('notes')->nullable();
            $table->integer('total_days')->nullable();
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
        Schema::dropIfExists('reservation');
    }
}
