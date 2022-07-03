<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHabitationTypeIdToHabitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitations', function (Blueprint $table) {
            $table->unsignedBigInteger('habitation_type_id')->nullable()->after('id');

            // type eliminato -> viene settato NULL nei record in cui era presente
            $table->foreign('habitation_type_id')
                  ->references('id')
                  ->on('habitation_types')->onDelete('set null');
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
            $table->dropForeign('habitations_habitation_type_id_foreign');

            $table->dropColumn('habitation_type_id');
        });
    }
}
