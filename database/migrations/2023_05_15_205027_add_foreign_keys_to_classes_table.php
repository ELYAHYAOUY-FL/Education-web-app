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
        Schema::table('classes', function (Blueprint $table) {
            $table->foreign(['emploi_id'], 'fk_classes_emploi_temps_id')->references(['id'])->on('emploi_temps')->onDelete('CASCADE');
            $table->foreign(['niveau_scolaire_id'])->references(['id'])->on('niveau_scolaires')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign('fk_classes_emploi_temps_id');
            $table->dropForeign('classes_niveau_scolaire_id_foreign');
        });
    }
};
