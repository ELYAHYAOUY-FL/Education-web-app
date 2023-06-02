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
        Schema::create('salaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bankinformation_prof_id')->index('salaires_bankinformation_prof_id_foreign');
            $table->date('date');
            $table->string('mois');
            $table->string('année');
            $table->decimal('montant');
            $table->boolean('est_paye');
            $table->timestamps();
        });
        // Schema::table('salaires', function (Blueprint $table) {
        //     $table->foreign('bankinformation_prof_id')->references('id')->on('bankinformation_profs')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(' salaires');
    }
};
