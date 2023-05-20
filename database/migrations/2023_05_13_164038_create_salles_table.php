<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSallesTable extends Migration
{
    public function up()
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->integer('capacity');
            $table->unsignedBigInteger('emploi_temps_id')->nullable();
            $table->timestamps();

             $table->foreign('emploi_temps_id')->references('id')->on('emploi_temps')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emploi_temps');
        Schema::table('emploi_temps', function (Blueprint $table) {
            $table->dropForeign(['salles_id ']);
            $table->dropColumn('salles_id');
        });
    }
}
