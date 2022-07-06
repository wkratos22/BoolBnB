<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHabitationIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('habitation_id')->after('id');

            // annuncio eliminato -> di conseguenza anche i relativi messaggi
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_habitation_id_foreign');

            $table->dropColumn('habitation_id');
        });
    }
}
