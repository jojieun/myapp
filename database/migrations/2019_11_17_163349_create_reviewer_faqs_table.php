<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewerFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewer_faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->text('answer');
            $table->bigInteger('reviewer_faq_cate_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('reviewer_faq_cate_id')->references('id')->on('reviewer_faq_cates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewer_faqs');
    }
}
