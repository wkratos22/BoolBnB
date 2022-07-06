<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
            Schema::create('habitation_tag', function (Blueprint $table) {
                $table->id();
    
                // annuncio eliminato -> di conseguenza anche la relazione nella tabella pivot
                $table->unsignedBigInteger('habitation_id');
                $table->foreign('habitation_id')->references('id')->on('habitations')->onDelete('cascade');
    
                // tag eliminato -> di conseguenza anche la relazione nella tabella pivot
                $table->unsignedBigInteger('tag_id');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

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
        Schema::dropIfExists('habitation_tag');
    }

}
