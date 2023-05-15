<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetardsTable extends Migration
{
    public function up()
    {
        Schema::create('retards', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('motif');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('eleve_id');
            $table->timestamps();

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retards');
    }
}

