<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug');
            $table->mediumText('description');
            $table->decimal('price', 7,2);
            $table->string('address');
            $table->decimal('latitude', 7,5);
            $table->decimal('longitude', 8,5);
            $table->integer('guests_number');
            $table->integer('rooms_number');
            $table->integer('beds_number');
            $table->integer('bathrooms_number');
            $table->integer('square_meters')->nullable();
            $table->string('image');
            $table->boolean('visible');
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
        Schema::dropIfExists('habitations');
    }
}
