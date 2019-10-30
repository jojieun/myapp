<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_reviewers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('campaign_id')->unsigned()->index();
            $table->bigInteger('reviewer_id')->unsigned()->index();
            $table->boolean('selected')->default(0);
            $table->timestamps();
            
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('reviewers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_reviewers');
    }
}
