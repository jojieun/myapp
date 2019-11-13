<?php

use Illuminate\Database\Seeder;

class AddAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=14; $i<18; $i++){
        DB::table('areas')->insert([
                'region_id' => $i,
                'name' => '전체',
            ]);
            }
    }
}
