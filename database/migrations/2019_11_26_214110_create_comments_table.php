<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reviewer_id')->unsigned()->nullable();
            $table->bigInteger('advertiser_id')->unsigned()->nullable();
            $table->bigInteger('community_id')->unsigned()->index();
            $table->text('content');
            $table->timestamps();
            
            $table->foreign('reviewer_id')->references('id')->on('reviewers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('community_id')->references('id')->on('communities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
