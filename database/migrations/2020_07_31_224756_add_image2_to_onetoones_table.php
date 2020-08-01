<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImage2ToOnetoonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onetoones', function (Blueprint $table) {
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onetoones', function (Blueprint $table) {
            $table->dropColumn(['image2','image3']);
        });
    }
}
