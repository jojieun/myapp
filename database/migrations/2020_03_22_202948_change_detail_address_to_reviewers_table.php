<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDetailAddressToReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE reviewers ALTER gender DROP DEFAULT;');
        DB::statement('ALTER TABLE reviewers CHANGE COLUMN gender gender VARCHAR(255) NOT NULL;');
        Schema::table('reviewers', function (Blueprint $table) {
            $table->string('detail_address')->nullable()->change();
        });
        DB::statement('ALTER TABLE reviewers ALTER gender DROP DEFAULT;');
        DB::statement('ALTER TABLE reviewers CHANGE COLUMN gender gender ENUM("m","f") NOT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE reviewers ALTER gender DROP DEFAULT;');
        DB::statement('ALTER TABLE reviewers CHANGE COLUMN gender gender VARCHAR(255) NOT NULL;');
        Schema::table('reviewers', function (Blueprint $table) {
            $table->string('detail_address')->nullable(false)->change();
        });
        DB::statement('ALTER TABLE reviewers ALTER gender DROP DEFAULT;');
        DB::statement('ALTER TABLE reviewers CHANGE COLUMN gender gender ENUM("m","f") NOT NULL;');
    }
}
