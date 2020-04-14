<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<2;$i++){
            DB::table('main_banners')->insert([
                'name' => 'main_slide0'.$i.'.jpg',
            ]);
            DB::table('middle_banners')->insert([
                'name' => 'm_banner0'.$i.'.jpg',
            ]);
            DB::table('bottom_banners')->insert([
                'name' => 'b_banner0'.$i.'.jpg',
            ]);
        }
    }
}
