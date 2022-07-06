<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitation_service', function (Blueprint $table) {
            $table->id();

            // annuncio eliminato -> di conseguenza anche la relazione nella tabella pivot
            $table->unsignedBigInteger('habitation_id');
            $table->foreign('habitation_id')->references('id')->on('habitations')->onDelete('cascade');

            // service eliminato -> di conseguenza anche la relazione nella tabella pivot
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
        Schema::dropIfExists('habitation_service');
    }
}
