<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropReviewerIdCampaignIdAddCampaignReviewerToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_campaign_id_foreign');
            $table->dropColumn('campaign_id');
            $table->dropForeign('reviews_reviewer_id_foreign');
            $table->dropColumn('reviewer_id');
            $table->unsignedBigInteger('campaign_reviewer_id');
            
            $table->foreign('campaign_reviewer_id')->references('id')->on('campaign_reviewers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->dropForeign('reviews_campaign_reviewer_id_foreign');
            $table->dropColumn('campaign_reviewer_id');
            
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('reviewer_id')->references('id')->on('reviewers');
        });
    }
}
