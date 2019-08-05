<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressAndShippingToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->after('user_id')->nullable()->index();
            $table->unsignedBigInteger('shipping_method_id')->after('address_id')->nullable()->index();

            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_address_id_foreign');
            $table->dropColumn('address_id');

            $table->dropForeign('orders_shipping_method_id_foreign');
            $table->dropColumn('shipping_method_id');
        });
    }
}
