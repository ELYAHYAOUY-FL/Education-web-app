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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_francais');
            $table->string('nom_arabe');
            $table->string('prenom_francais');
            $table->string('prenom_arabe');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sex');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username');
            $table->string('usertype');
            $table->string('adresse');
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
        Schema::dropIfExists('users');
    }
};
