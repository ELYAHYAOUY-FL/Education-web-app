<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesseursTable extends Migration
{
    public function up()
    {
        Schema::create('professeurs', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sex');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('tel');
            $table->string('address');
            $table->string('diplom');
            $table->timestamps();
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
        });

        Schema::table('retards', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
        });

        Schema::create('emploi_temps_professeur', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('emploi_temps_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('emploi_temps_id')->references('id')->on('emploi_temps')->onDelete('cascade');

            $table->primary(['professeur_id', 'emploi_temps_id']);
        });

        Schema::create('matiere_professeur', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('matiere_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');

            $table->primary(['professeur_id', 'matiere_id']);
        });

        Schema::table('virements', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
        });

        Schema::table('devoirs', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
        });
        Schema::create('eleve_professuer', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('professeur_id');

            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');

            $table->primary(['eleve_id', 'professeur_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('emploi_temps_professeur');
        Schema::dropIfExists('matiere_professeur');

        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['professeur_id']);
            $table->dropColumn('professeur_id');
        });

        Schema::table('retards', function (Blueprint $table) {
           
            $table->dropForeign(['professeur_id']);
            $table->dropColumn('professeur_id');
        });

        Schema::table('virements', function (Blueprint $table) {
            $table->dropForeign(['professeur_id']);
            $table->dropColumn('professeur_id');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['professeur_id']);
            $table->dropColumn('professeur_id');
        });

        Schema::table('devoirs', function (Blueprint $table) {
            $table->dropForeign(['professeur_id']);
            $table->dropColumn('professeur_id');
        });

        Schema::dropIfExists('professeurs');
    }
}
