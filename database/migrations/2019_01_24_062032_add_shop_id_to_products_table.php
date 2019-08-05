<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->after('id')->nullable()->index();

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_shop_id_foreign');
            $table->dropColumn('shop_id');
        });
    }
}
