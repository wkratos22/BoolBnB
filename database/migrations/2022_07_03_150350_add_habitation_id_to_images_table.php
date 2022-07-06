<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHabitationIdToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('habitation_id')->after('id');

            // annuncio eliminato -> di conseguenza anche le immagini ad esso associate
            $table->foreign('habitation_id')
                  ->references('id')
                  ->on('habitations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_habitation_id_foreign');

            $table->dropColumn('habitation_id');
        });
    }
}
