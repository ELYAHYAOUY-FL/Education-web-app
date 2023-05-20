
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('capacity');
             $table->unsignedBigInteger('niveau_scolaire_id'); 

             $table->foreign('niveau_scolaire_id')->references('id')->on('niveau_scolaires')->onDelete('cascade'); 
            $table->timestamps();
        });

        
       

         Schema::table('eleves', function (Blueprint $table) {
            $table->unsignedBigInteger('classe_id');

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        }); 

         Schema::table('devoirs', function (Blueprint $table) {
            $table->unsignedBigInteger('classe_id');

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        });

        Schema::table('emploi_temps', function (Blueprint $table) {
            $table->unsignedBigInteger('classe_id');

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
        }); 
    }

    public function down()
    {
         Schema::dropIfExists('classe_matiere');
        Schema::table('eleves', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn('classe_id');
        });
        Schema::table('devoirs', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn('classe_id');
        });
        Schema::table('emploi_temps', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn('classe_id');
        });
        Schema::dropIfExists('classes');
    }
}
