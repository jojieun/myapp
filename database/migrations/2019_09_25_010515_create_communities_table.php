<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reviewer_id')->unsigned()->nullable();
            $table->bigInteger('advertiser_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->boolean('notification')->default(1);
            $table->tinyInteger('view_count')->default(0);
            $table->softDeletes();
            
            $table->foreign('reviewer_id')->references('id')->on('reviewers')
                ->onUpdate('cascade');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communities');
    }
}
