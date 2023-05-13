<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("photo")->nullable();
            $table->char("sexe");
            $table->integer("age");
            $table->date("date_naissance");
            $table->foreignId("niveau_scolaire_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table){
           
         $table->dropConstrainedForeignId('niveau_scolaire_id');
        });
        Schema::dropIfExists('etudiants');
    }
};