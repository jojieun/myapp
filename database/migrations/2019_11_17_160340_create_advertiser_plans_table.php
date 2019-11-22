<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('advertiser_id')->unsigned()->index();
            $table->bigInteger('plan_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_plans');
    }
}
