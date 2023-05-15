
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNiveauScolairesTable extends Migration
{
    public function up()
    {
        Schema::create('niveau_scolaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('classes', function (Blueprint $table) {
           
            $table->foreign('niveau_scolaire_id')->references('id')->on('niveau_scolaires')->onDelete('cascade');
        });
    }

    public function down()

    {
        Schema::dropIfExists('niveau_scolaires');
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });

    }
}
