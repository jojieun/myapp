<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnetoonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onetoones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->bigInteger('qcategory_id')->unsigned()->index();
            $table->bigInteger('reviewer_id')->unsigned()->nullable();
            $table->bigInteger('advertiser_id')->unsigned()->nullable();
            $table->string('answer_title')->nullable();
            $table->text('answer')->nullable();
            $table->timestamps();
            
            
            $table->foreign('qcategory_id')->references('id')->on('qcategories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('reviewers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onetoones');
    }
}
