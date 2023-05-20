<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnneeScolaireTable extends Migration
{
    public function up()
    {
        Schema::create('annee_scolaire', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('annee_scolaire_eleve', function (Blueprint $table) {
            $table->unsignedBigInteger('annee_scolaire_id');
            $table->unsignedBigInteger('eleve_id');
            $table->timestamps();

            $table->foreign('annee_scolaire_id')->references('id')->on('annee_scolaire')->onDelete('cascade');
            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
        });

        Schema::create('annee_scolaire_classe', function (Blueprint $table) {
            $table->unsignedBigInteger('annee_scolaire_id');
            $table->unsignedBigInteger('classe_id');
            $table->timestamps();

            $table->foreign('annee_scolaire_id')->references('id')->on('annee_scolaire')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('annee_scolaire_classe');
        Schema::dropIfExists('annee_scolaire_eleve');
        Schema::dropIfExists('annee_scolaire');
    }
}