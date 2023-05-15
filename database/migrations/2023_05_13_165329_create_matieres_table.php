<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatieresTable extends Migration
{
    public function up()
    {
      Schema::create('matieres', function (Blueprint $table) {
                $table->id();
                $table->string('titre');
                $table->integer('coefficient');
                $table->unsignedBigInteger('professeur_id');
                $table->timestamps();
    
                $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            });

            Schema::create('classe_matiere', function (Blueprint $table) {
                $table->unsignedBigInteger('classe_id');
                $table->unsignedBigInteger('matiere_id');
    
                $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
                $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
    
                $table->primary(['classe_id', 'matiere_id']);
            });

            Schema::create('emploi_matiere', function (Blueprint $table) {
                $table->unsignedBigInteger('emploi_temps_id');
                $table->unsignedBigInteger('matiere_id');
    
                $table->foreign('emploi_temps_id')->references('id')->on('emploi_temps')->onDelete('cascade');
                $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
    
                $table->primary(['emploi_temps_id', 'matiere_id']);
            });

         Schema::table('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
        });

        Schema::table('devoirs', function (Blueprint $table) {
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
        }); 
    } 

    public function down()
    {
        Schema::dropIfExists('classe_matiere');
        Schema::dropIfExists('emploi_matiere');
        Schema::dropIfExists('matieres');
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        }); 
        Schema::table('devoirs', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        }); 
      
        Schema::table('emplois_temps', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        }); 
    }
    }

