<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('product_id')->nullable()->index();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });

        Schema::table('variations', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->dropColumn('type_id');
        });
    }
}
