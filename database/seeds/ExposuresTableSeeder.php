<?php

use Illuminate\Database\Seeder;

class ExposuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('exposures')->insert([
            'name' => '플래티넘',
            'price' => 100000,
            'limit' => 4,
            'instruction' => '체험단 캠페인이 <strong>최상단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',
        ]);
        DB::table('exposures')->insert([
            'name' => '프라임',
            'price' => 70000,
            'limit' => 5,
            'instruction' => '체험단 캠페인이 <strong>상단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',
        ]);
        DB::table('exposures')->insert([
            'name' => '그랜드',
            'price' => 30000,
            'limit' => 12,
            'instruction' => '체험단 캠페인이 <strong>중단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',
        ]);
    }
}
