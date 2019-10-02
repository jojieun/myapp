<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campagins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('advertiser_id')->unsigned();
            $table->('title');
            $table->('form');
            $table->('recruitment_number');
            $table->('offer_point');
            $table->('offer_goods');
            $table->('channel_id');
            $table->('recruitment_start_at');
            $table->('recruitment_end_at');
            $table->('submission_end_at');
            $table->('main_image');
            $table->('sub_image1');
            $table->('');
            $table->('');
            $table->('');
            $table->('');
            $table->('');
            $table->('');
            $table->('');
            $table->('');
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
        Schema::dropIfExists('campagins');
    }
}
