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
        Schema::table('emploi_temps', function (Blueprint $table) {
            $table->foreign(['classe_id'])->references(['id'])->on('classes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emploi_temps', function (Blueprint $table) {
            $table->dropForeign('emploi_temps_classe_id_foreign');
        });
    }
};
