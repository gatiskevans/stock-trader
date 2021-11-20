<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStocksTable extends Migration
{
    public function up()
    {
        Schema::create('user_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->string('company');
            $table->string('stock');
            $table->bigInteger('quantity')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_stocks');
    }
}
