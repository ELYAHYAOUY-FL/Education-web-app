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
        Schema::table('matiere_emploi', function (Blueprint $table) {
            $table->foreign(['matiere_id'], 'FK_matiere_emploi_matiere_id')->references(['id'])->on('matieres');
            $table->foreign(['emploi_id'], 'FK_matiere_emploi_emploi_id')->references(['id'])->on('emploi_temps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matiere_emploi', function (Blueprint $table) {
            $table->dropForeign('FK_matiere_emploi_matiere_id');
            $table->dropForeign('FK_matiere_emploi_emploi_id');
        });
    }
};
