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
        Schema::create('payementsdemois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('nom_compte');
            $table->decimal('frais');
            $table->boolean('est_paye');
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
        Schema::dropIfExists('payementsdemois');
    }
};
