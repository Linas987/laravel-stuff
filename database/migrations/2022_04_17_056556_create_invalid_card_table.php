<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvalidCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invalid_card', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->string('session_name',100);
            $table->string('Observations',1000);
            $table->string('name');
            $table->string('surname');
            $table->date('updated_at');
            $table->date('created_at');

            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invalid_card');
    }
}
