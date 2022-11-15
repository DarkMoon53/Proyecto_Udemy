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
        Schema::table('users', function (Blueprint $table) {
            // creando el "role_id"
            $table->unsignedBigInteger('role_id');
            // referenciando
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             // quitando la referencia a role_id
             $table->dropForeign('users_role_id_foreign');
             // eliminando role_id luego de eliminar la referencia
             $table->dropColumn('role_id');
        });
    }
};
