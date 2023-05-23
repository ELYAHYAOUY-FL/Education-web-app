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
        Schema::create('eleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_francais');
            $table->string('nom_arabe');
            $table->string('prenom_francais');
            $table->string('prenom_arabe');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sex');
            $table->string('photo')->nullable();
            $table->string('CNE')->unique();
            $table->unsignedBigInteger('classe_id')->index('eleves_classe_id_foreign');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
        });
        Schema::table('eleves', function (Blueprint $table) {
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        });
        Schema::table('eleves', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleves');
    }
};
