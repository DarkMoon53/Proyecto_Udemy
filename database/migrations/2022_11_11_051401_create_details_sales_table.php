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
        Schema::create('details_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_curso");
            $table->foreign("id_curso")->references("id")->on("grades");
            $table->unsignedBigInteger("id_venta");
            $table->foreign("id_venta")->references("id")->on("sales");
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
        Schema::dropIfExists('details_sales');
    }
};
