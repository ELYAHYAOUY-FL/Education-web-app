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
        Schema::create('retards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('motif');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->unsignedBigInteger('professeur_id')->index('retards_professeur_id_foreign');
            $table->unsignedBigInteger('eleve_id')->index('retards_eleve_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retards');
    }
};
