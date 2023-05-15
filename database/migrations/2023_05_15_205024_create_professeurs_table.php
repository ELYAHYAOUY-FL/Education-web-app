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
        Schema::create('professeurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('virement_id')->index('professeurs_virement_id_foreign');
            $table->string('photo')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sex');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('tel');
            $table->string('address');
            $table->string('diplom');
            $table->unsignedBigInteger('matier_id')->nullable()->index('matier_prof_id_foreign');
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
        Schema::dropIfExists('professeurs');
    }
};
