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
        Schema::create('groupe_matiere', function (Blueprint $table) {
            $table->unsignedBigInteger('groupe_id')->unique('groupe_id');
            $table->unsignedBigInteger('matiere_id')->index('matiere_id');

            $table->primary(['groupe_id', 'matiere_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classe_matiere');
    }
};
