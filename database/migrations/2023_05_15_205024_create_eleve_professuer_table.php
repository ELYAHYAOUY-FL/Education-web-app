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
        Schema::create('eleve_professuer', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('professeur_id')->index('eleve_professuer_professeur_id_foreign');

            $table->primary(['eleve_id', 'professeur_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleve_professuer');
    }
};
