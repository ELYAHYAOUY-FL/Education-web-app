<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carnetnotes', function (Blueprint $table) {
            
                $table->id();
                $table->unsignedBigInteger('professeur_id');
                $table->unsignedBigInteger('groupe_id');
                $table->text('contenu');
                $table->date('date');
                $table->timestamps();
    
                $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
                $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnetnotes');
    }
};
