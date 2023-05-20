<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevesTable extends Migration
{
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('nom_francais');
            $table->string('nom_arabe');
            $table->string('prenom_francais');
            $table->string('prenom_arabe');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sex');
            $table->string('photo')->nullable();
            $table->string('CNE')->unique();
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('eleve_parent', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('parent_id');

            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');

            $table->primary(['eleve_id', 'parent_id']);
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');

            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
        });

        Schema::table('retards', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');

            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');

            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleve_parent');
        Schema::dropIfExists('absences');
        Schema::dropIfExists('retards');
        Schema::dropIfExists('notes');


        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['eleve_id']);
            $table->dropColumn('eleve_id');
        });

        Schema::table('retards', function (Blueprint $table) {
            $table->dropForeign(['eleve_id']);
            $table->dropColumn('eleve_id');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['eleve_id']);
            $table->dropColumn('eleve_id');
        });

        Schema::table('eleves', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropForeign(['user_id']);
        }); 

        Schema::dropIfExists('eleves');
    }
}
