<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNominateds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominateds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('reference');

            //0 = aguardar avaliação, 1 = valido, 2 = invalidado via painel
            $table->tinyInteger('valid')->default(0);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('nominateds');
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
