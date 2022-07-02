<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
            Schema::create('habitations_tags', function (Blueprint $table) {
                $table->id();
    
                $table->unsignedBigInteger('habitation_id');
                $table->foreign('habitation_id')->references('id')->on('habitations')->onDelete('cascade');
    
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
        Schema::dropIfExists('habitations_tags');
    }

}
