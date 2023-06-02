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
        Schema::create('groupe_professeur', function (Blueprint $table) {
            $table->unsignedBigInteger('groupe_id')->index('groupe_id');
            $table->unsignedBigInteger('professeur_id')->index('professeur_id');

            $table->primary(['groupe_id', 'professeur_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupe_professeur');
    }
};

