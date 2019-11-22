<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->text('answer');
            $table->bigInteger('advertiser_faq_cate_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('advertiser_faq_cate_id')->references('id')->on('advertiser_faq_cates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_faqs');
    }
}
