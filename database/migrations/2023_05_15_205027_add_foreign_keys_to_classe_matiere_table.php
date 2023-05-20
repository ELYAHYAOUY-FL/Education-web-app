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
        Schema::table('classe_matiere', function (Blueprint $table) {
            $table->foreign(['matiere_id'], 'classe_matiere_ibfk_2')->references(['id'])->on('matieres');
            $table->foreign(['classe_id'], 'classe_matiere_ibfk_1')->references(['id'])->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classe_matiere', function (Blueprint $table) {
            $table->dropForeign('classe_matiere_ibfk_2');
            $table->dropForeign('classe_matiere_ibfk_1');
        });
    }
};
