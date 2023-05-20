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
        Schema::create('eleve_parent', function (Blueprint $table) {
            $table->unsignedBigInteger('eleve_id')->unique('eleve_id');
            $table->unsignedBigInteger('parent_id')->index('eleve_parent_parent_id_foreign');
            $table->integer('id')->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleve_parent');
    }
};
