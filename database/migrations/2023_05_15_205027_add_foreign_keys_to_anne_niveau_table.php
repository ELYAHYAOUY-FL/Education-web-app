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
        Schema::table('anne_niveau', function (Blueprint $table) {
            $table->foreign(['anneScolaire_id'], 'FK_anne_niveau_id')->references(['id'])->on('annee_scolaire');
            $table->foreign(['niveauScolaire_id'], 'FK_anne_niveau_anne_niveau_id')->references(['id'])->on('niveau_scolaires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anne_niveau', function (Blueprint $table) {
            $table->dropForeign('FK_anne_niveau_id');
            $table->dropForeign('FK_anne_niveau_anne_niveau_id');
        });
    }
};
