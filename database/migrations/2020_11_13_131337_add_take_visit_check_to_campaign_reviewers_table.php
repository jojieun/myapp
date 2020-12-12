<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTakeVisitCheckToCampaignReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_reviewers', function (Blueprint $table) {
            $table->tinyInteger('take_visit_check')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_reviewers', function (Blueprint $table) {
            $table->dropColumn('take_visit_check');
        });
    }
}
