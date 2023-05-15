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
        Schema::create('salle_emploi', function (Blueprint $table) {
            $table->unsignedBigInteger('emploi_id')->nullable()->index('FK_salle_emploi_emploi_id');
            $table->unsignedBigInteger('salle_id')->nullable()->index('FK_salle_emploi_emploi_salle_emploi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salle_emploi');
    }
};
