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
        Schema::table('salle_emploi', function (Blueprint $table) {
            $table->foreign(['salle_id'], 'FK_salle_emploi_emploi_salle_emploi_id')->references(['id'])->on('salles');
            $table->foreign(['emploi_id'], 'FK_salle_emploi_emploi_id')->references(['id'])->on('emploi_temps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salle_emploi', function (Blueprint $table) {
            $table->dropForeign('FK_salle_emploi_emploi_salle_emploi_id');
            $table->dropForeign('FK_salle_emploi_emploi_id');
        });
    }
};
