<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellVoipRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_voip_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('sell_rate_plan_id');
            $table->string('country')->nullable();
            $table->string('code')->nullable();
            $table->string('rate')->nullable();
            $table->string('minute')->nullable();
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
        Schema::dropIfExists('sell_voip_rates');
    }
}
