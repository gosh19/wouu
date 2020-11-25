<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnApprovedToTecnoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tecno_data', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->boolean('approved')->default(false)->after('user_id');
            $table->unsignedBigInteger('categoria_id')->after('user_id');

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tecno_data', function (Blueprint $table) {
            $table->string('type', 100)->nullable();
            $table->dropColumn('approved');
        });
    }
}
