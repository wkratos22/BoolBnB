<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitation_sponsorship', function (Blueprint $table) {
            $table->id();

            // annuncio eliminato -> di conseguenza anche la relazione nella tabella pivot
            $table->unsignedBigInteger('habitation_id');
            $table->foreign('habitation_id')->references('id')->on('habitations')->onDelete('cascade');

            // sponsor eliminato -> di conseguenza anche la relazione nella tabella pivot
            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');

            $table->dateTime('start_date');
            $table->dateTime('end_date');

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
        Schema::dropIfExists('habitation_sponsorship');
    }
}
