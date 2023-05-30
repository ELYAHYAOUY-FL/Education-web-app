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
        Schema::create('eleve_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('exame_id')->index('exame_id');
            $table->unsignedBigInteger('eleve_id')->index('eleve_exams_eleve_id_foreign');
            $table->integer('id');
            $table->primary(['exame_id', 'eleve_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleve_exams');
    }
};
