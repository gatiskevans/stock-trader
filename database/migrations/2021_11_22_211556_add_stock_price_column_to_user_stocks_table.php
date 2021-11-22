<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockPriceColumnToUserStocksTable extends Migration
{
    public function up()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->integer('stock_price')->after('stock')->default(0);
        });
    }

    public function down()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->dropColumn('stock_price');
        });
    }
}
