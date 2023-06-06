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
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('heure_debut');
            $table->time('heure_fin'); 
            $table->text('description')->nullable();
            $table->string('jour');
            $table->string('annee');
            $table->unsignedBigInteger('matiere_id')->nullable()->index('emploi_temps_matiere_id_foreign');
            $table->unsignedBigInteger('groupe_id')->index('emploi_temps_groupe_id_foreign');
          
            // $table->unsignedBigInteger('groupe_id')->index('emploi_temps_groupe_id_foreign');
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
        Schema::dropIfExists('emploi_temps');
    }
};
