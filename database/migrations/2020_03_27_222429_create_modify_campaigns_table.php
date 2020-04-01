<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modify_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('campaign_id')->unsigned()->index();
            $table->bigInteger('advertiser_id')->unsigned()->index();
            $table->bigInteger('channel_id')->unsigned()->index();
            $table->bigInteger('brand_id')->unsigned();
            $table->string('name');
            $table->enum('form',['h','v'])->index();
            $table->smallInteger('recruit_number')->unsigned();
            $table->integer('offer_point')->unsigned();
            $table->string('offer_goods')->nullable();
            $table->date('start_recruit');
            $table->date('end_recruit');
            $table->date('end_submit');
            $table->string('main_image')->nullable();
            $table->string('sub_image1')->nullable();
            $table->string('sub_image2')->nullable();
            $table->string('sub_image3')->nullable();
            $table->string('contact')->nullable();
            $table->text('mission')->nullable();
            $table->string('keyword')->nullable();
            $table->bigInteger('area_id')->unsigned()->index()->nullable();
            $table->string('visit_time')->nullable();
            $table->char('zipcode',5)->nullable();;
            $table->string('address',100)->nullable();;
            $table->string('detail_address',100)->nullable();;
            $table->timestamps();
            $table->text('etc')->nullable();
            
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('channel_id')->references('id')->on('channels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modify_campaigns');
    }
}
