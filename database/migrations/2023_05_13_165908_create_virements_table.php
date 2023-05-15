<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirementsTable extends Migration
{
    public function up()
    {
        Schema::create('virements', function (Blueprint $table) {
            $table->id();
            $table->decimal('salaire', 8, 2);
            $table->boolean('est_paye');
            $table->string('rib');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('professeur_virement', function (Blueprint $table) {
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('virement_id');
            $table->timestamps();

            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('virement_id')->references('id')->on('virements')->onDelete('cascade');

            $table->primary(['professeur_id', 'virement_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('professeur_virement');
        Schema::dropIfExists('virements');
    }
}
