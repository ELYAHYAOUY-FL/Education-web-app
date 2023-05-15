<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('valeur');
            $table->date('date');
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('exam_id');
            $table->timestamps();

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });

        Schema::create('eleve_note', function (Blueprint $table) {
            $table->unsignedBigInteger('note_id');
            $table->unsignedBigInteger('eleve_id');

            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');

            $table->primary(['note_id', 'eleve_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleve_note');
        Schema::dropIfExists('notes');
    }
}
