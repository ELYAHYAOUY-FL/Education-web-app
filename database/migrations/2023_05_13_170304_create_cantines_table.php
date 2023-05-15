<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantinesTable extends Migration
{
    public function up()
    {
        Schema::create('cantines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('jour');
    
            $table->text('menu');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cantines');
    }
};
