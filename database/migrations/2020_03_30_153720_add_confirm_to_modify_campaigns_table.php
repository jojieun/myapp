<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfirmToModifyCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modify_campaigns', function (Blueprint $table) {
            $table->enum('confirm',['w','a','r'])->default('w');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modify_campaigns', function (Blueprint $table) {
            $table->dropColumn('confirm');
        });
    }
}
