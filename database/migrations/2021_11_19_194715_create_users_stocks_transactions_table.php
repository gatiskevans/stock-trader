<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersStocksTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('users_stocks_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('stock_name');
            $table->string('quantity')->default(0);
            $table->string('total_amount');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_stocks_transactions');
    }
}
