<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSnsToReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviewers', function (Blueprint $table) {
            $table->dropColumn(['naver_blog', 'naver_post', 'instagram', 'youtube','facebook','kakao']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviewers', function (Blueprint $table) {
             $table->string('naver_blog',30)->nullable();
            $table->string('naver_post',30)->nullable();
            $table->string('instagram',30)->nullable();
            $table->string('youtube',30)->nullable();
            $table->string('facebook',30)->nullable();
            $table->string('kakao',30)->nullable();
        });
    }
}
