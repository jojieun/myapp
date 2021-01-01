<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertiser_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->boolean('from_ad');
            $table->boolean('new')->default(true);
            $table->string('text');
            $table->timestamps();

            $table->foreign('advertiser_id')->references('id')->on('advertisers');
            $table->foreign('reviewer_id')->references('id')->on('reviewers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
