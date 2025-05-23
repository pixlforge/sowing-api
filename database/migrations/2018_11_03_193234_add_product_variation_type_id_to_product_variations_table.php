<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductVariationTypeIdToProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_variation_type_id')->after('product_id')->nullable()->index();

            $table->foreign('product_variation_type_id')->references('id')->on('product_variation_types')->onDelete('cascade');
        });

        Schema::table('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_variation_type_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropColumn('product_variation_type_id');
        });
    }
}
