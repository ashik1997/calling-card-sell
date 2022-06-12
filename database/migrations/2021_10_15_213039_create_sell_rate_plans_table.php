<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellRatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_rate_plans', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->float('amount')->default(0);
            $table->float('discount')->default(0);
            $table->float('currency_rate')->default(0);
            $table->float('how_many_minutes_of_seconds')->default(0);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_rate_plans');
    }
}
