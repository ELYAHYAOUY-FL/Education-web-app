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
        Schema::create('eleve_note', function (Blueprint $table) {
            $table->unsignedBigInteger('note_id')->unique('note_id');
            $table->unsignedBigInteger('eleve_id')->index('eleve_note_eleve_id_foreign');
            $table->integer('id');

            $table->primary(['note_id', 'eleve_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleve_note');
    }
};
