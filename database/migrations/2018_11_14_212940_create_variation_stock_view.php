<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateVariationStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE VIEW variation_stock_view AS
                SELECT
                    variations.product_id AS product_id,
                    variations.id AS variation_id,
                    COALESCE(SUM(stocks.quantity) - COALESCE(SUM(order_variation.quantity), 0), 0) AS stock,
                    CASE WHEN COALESCE(SUM(stocks.quantity) - COALESCE(SUM(order_variation.quantity), 0), 0)
                        THEN true
                        ELSE false
                    END in_stock
                FROM variations
                LEFT JOIN (
                    SELECT
                        stocks.variation_id AS id,
                        SUM(stocks.quantity) AS quantity
                    FROM stocks
                    GROUP BY stocks.variation_id
                ) AS stocks USING (id)
                LEFT JOIN(
                    SELECT
                        order_variation.variation_id AS id,
                        SUM(order_variation.quantity) AS quantity
                    FROM order_variation
                    GROUP BY order_variation.variation_id
                ) AS order_variation USING (id)
                GROUP BY variations.id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS variation_stock_view');
    }
}
