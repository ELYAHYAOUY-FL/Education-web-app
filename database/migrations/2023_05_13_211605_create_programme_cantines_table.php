<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammeCantinesTable extends Migration
{
    public function up()
    {
        Schema::create('programme_cantines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('menu')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programme_cantines');
    }
}
