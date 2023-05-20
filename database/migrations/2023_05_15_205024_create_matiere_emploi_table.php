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
        Schema::create('matiere_emploi', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('emploi_id')->nullable()->index('FK_matiere_emploi_emploi_id');
            $table->unsignedBigInteger('matiere_id')->nullable()->index('FK_matiere_emploi_matiere_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matiere_emploi');
    }
};
