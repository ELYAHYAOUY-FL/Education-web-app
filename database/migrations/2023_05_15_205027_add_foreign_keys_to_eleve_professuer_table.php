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
        Schema::table('eleve_professuer', function (Blueprint $table) {
            $table->foreign(['professeur_id'])->references(['id'])->on('professeurs')->onDelete('CASCADE');
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
        Schema::table('eleve_professuer', function (Blueprint $table) {
            $table->dropForeign('eleve_professuer_professeur_id_foreign');
            $table->dropForeign('eleve_professuer_eleve_id_foreign');
        });
    }
};