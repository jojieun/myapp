<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email',255)->unique();
            $table->string('name',30);
            $table->string('password',60);
            $table->string('nickname',30);
            $table->char('mobile_num',11);
            $table->date('birth');
            $table->char('zipcode',5);
            $table->string('address',80);
            $table->string('detail_address',80);
            $table->enum('gender',['m','f']);
            $table->string('naver_blog',30)->nullable();
            $table->string('naver_post',30)->nullable();
            $table->string('instagram',30)->nullable();
            $table->string('youtube',30)->nullable();
            $table->string('facebook',30)->nullable();
            $table->string('kakao',30)->nullable();
            $table->boolean('receive_agreement');
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewers');
    }
}
