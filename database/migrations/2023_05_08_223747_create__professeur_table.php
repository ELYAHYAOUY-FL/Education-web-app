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
        Schema::create('professeurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('username');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('age');
            $table->string('phone_number');
            $table->string('address');
            $table->string('photo');
            $table->decimal('salaire', 8, 2);
            $table->string('diplome');
            $table->unsignedBigInteger('niveau_scolaire_id');
            // $table->unsignedBigInteger('note_id');
            // Add other columns here
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('niveau_scolaire_id')->references('id')->on('niveau_scolaires')->onDelete('cascade');
            // $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_professeur');
    }
};
