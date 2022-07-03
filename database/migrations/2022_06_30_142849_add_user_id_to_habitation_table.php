<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToHabitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');

            // user eliminato -> di conseguenza tutti gli annunci pubblicati
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habitations', function (Blueprint $table) {
            $table->dropForeign('habitations_user_id_foreign');

            $table->dropColumn('user_id');
        });
    }
}
