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
        Schema::create('eleve_devoire', function (Blueprint $table) {
            $table->unsignedBigInteger('devoir_id')->index('devoir_id');
            $table->unsignedBigInteger('eleve_id')->index('eleve_id');
            $table->foreign('devoir_id')->references('id')->on('devoirs')->onDelete('cascade');
            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
                $table->boolean('validation')->default(false);
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
        Schema::dropIfExists('eleve_devoire');
    }
};
