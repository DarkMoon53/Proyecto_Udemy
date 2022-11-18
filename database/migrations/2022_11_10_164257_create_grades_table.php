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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre",50)->nullable(false);
            $table->string("Descripcion",200)->nullable(false);
            $table->float("Precio")->nullable(false);
            $table->string("Idioma",20)->nullable(false);
            $table->string("Requisitos",200)->nullable(false);
            $table->string("Objetivos",500)->nullable(false);
            $table->boolean("Estado")->default(1);  
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
        Schema::dropIfExists('grades');
    }
};
