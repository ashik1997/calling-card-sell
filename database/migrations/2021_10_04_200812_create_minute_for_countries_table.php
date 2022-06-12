<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinuteForCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minute_for_countries', function (Blueprint $table) {
            $table->id();
            $table->integer('rate_plan_id');
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->float('minute')->default(0);
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
        Schema::dropIfExists('minute_for_countries');
    }
}
