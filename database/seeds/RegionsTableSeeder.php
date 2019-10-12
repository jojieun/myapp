<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chs = [
            '서울','경기','인천','대전','충청','대구','경북','부산','경남','광주','전라','강원','제주'
               ];
        foreach($chs as $ch){
            DB::table('regions')->insert([
                'name' => $ch,
            ]);
        }
    }
}
