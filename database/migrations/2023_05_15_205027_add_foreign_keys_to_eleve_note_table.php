<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eleve_note', function (Blueprint $table) {
            $table->foreign(['note_id'])->references(['id'])->on('notes')->onDelete('CASCADE');
            $table->foreign(['eleve_id'])->references(['id'])->on('eleves')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eleve_note', function (Blueprint $table) {
            $table->dropForeign('eleve_note_note_id_foreign');
            $table->dropForeign('eleve_note_eleve_id_foreign');
        });
    }
};
