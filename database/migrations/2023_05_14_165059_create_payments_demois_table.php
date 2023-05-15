<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class CreatePaymentsDemoisTable extends Migration
{
    public function up()
    {
        Schema::create('payementsdemois', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('nom_compte');
            $table->decimal('frais', 8, 2);
            $table->boolean('est_paye');
            $table->timestamps();
        });

        Schema::create('paiement_parent', function (Blueprint $table) {
            $table->unsignedBigInteger('payementsdemoi_id');
            $table->unsignedBigInteger('parent_id');

            $table->foreign('payementsdemoi_id')->references('id')->on('payementsdemois')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');

            $table->primary(['payementsdemoi_id', 'parent_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiement_parent');
        Schema::dropIfExists('payementsdemois');
    }    

   
};
