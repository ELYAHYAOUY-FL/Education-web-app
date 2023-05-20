
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploiTempsTable extends Migration
{
    public function up()
    {
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->id();
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('jour');
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('classe_id');
            
            $table->unsignedBigInteger('salle_id');
            $table->timestamps();

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');

        });
       
}


    public function down()
    {
        Schema::dropIfExists('emploi_temps');
        Schema::dropIfExists('emploi_matiere');
        Schema::table('professeurs', function (Blueprint $table) {
            $table->dropForeign(['emploi_temps_id ']);
            $table->dropColumn('emploi_temps_id');
        });
        Schema::table('matieres', function (Blueprint $table) {
            $table->dropForeign(['emploi_temps_id ']);
            $table->dropColumn('emploi_temps_id');
        });
        Schema::table('salles', function (Blueprint $table) {
            $table->dropForeign(['emploi_temps_id ']);
            $table->dropColumn('emploi_temps_id');
        });
        
    }
}
