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
            $table->string('photo')->nullable();
            $table->string('CNE')->unique();
            $table->unsignedBigInteger('groupe_id')->index('eleves_groupe_id_foreign');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
        });
        Schema::table('eleves', function (Blueprint $table) {
            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('cascade');
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
