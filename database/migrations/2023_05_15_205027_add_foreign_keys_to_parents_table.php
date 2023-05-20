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
        Schema::table('parents', function (Blueprint $table) {
            $table->foreign(['user_id'], 'parent_user_id_id_foreign')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['payement_id'], 'parent_payement_id_id_foreign')->references(['id'])->on('payementsdemois')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->dropForeign('parent_user_id_id_foreign');
            $table->dropForeign('parent_payement_id_id_foreign');
        });
    }
};
