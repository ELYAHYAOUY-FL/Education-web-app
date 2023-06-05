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
        Schema::create('matieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->integer('coefficient');
            $table->text('description')->nullable();
            $table->longBlob('pdf')->nullable();
            // $table->unsignedBigInteger('professeur_id')->nullable();
            // $table->foreign('professeur_id')->references('id')->on('professeurs');

            // $table->unsignedBigInteger('professeur_id')->index('matieres_professeur_id_foreign');
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
        Schema::dropIfExists('matieres');
    }
};
