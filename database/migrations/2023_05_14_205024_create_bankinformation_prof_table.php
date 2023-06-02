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
        Schema::create('bankinformation_profs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professeur_id')->index('bankinformation_prof_professeur_id_foreign');

            $table->string('rib');
            $table->string('numero_compte');
            $table->string('type_bank');
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
        Schema::dropIfExists('bankinformation_profs');
    }
};
