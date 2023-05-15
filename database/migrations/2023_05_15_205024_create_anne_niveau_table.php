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
        Schema::create('anne_niveau', function (Blueprint $table) {
            $table->unsignedBigInteger('anneScolaire_id')->nullable()->index('FK_anne_niveau_id');
            $table->unsignedBigInteger('niveauScolaire_id')->nullable()->index('FK_anne_niveau_anne_niveau_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anne_niveau');
    }
};
