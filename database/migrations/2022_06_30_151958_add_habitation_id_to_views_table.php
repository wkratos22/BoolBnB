<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHabitationIdToViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('views', function (Blueprint $table) {
            $table->unsignedBigInteger('habitation_id')->after('id');

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
        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('views_habitation_id_foreign');

            $table->dropColumn('habitation_id');
        });
    }
}
