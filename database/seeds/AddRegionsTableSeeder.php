<?php

use Illuminate\Database\Seeder;

class AddRegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chs = [
            '충북','전북','울산','세종'
               ];
        foreach($chs as $ch){
            DB::table('regions')->insert([
                'name' => $ch,
            ]);
        }
        DB::table('regions')->where('name','충청')->update(['name' => '충남']);
        DB::table('regions')->where('name','전라')->update(['name' => '전남']);
        
        DB::table('regions')->where('name','서울')->update(['arraynum' => 200]);
        DB::table('regions')->where('name','경기')->update(['arraynum' => 190]);
        DB::table('regions')->where('name','인천')->update(['arraynum' => 180]);
        DB::table('regions')->where('name','부산')->update(['arraynum' => 170]);
        DB::table('regions')->where('name','대전')->update(['arraynum' => 160]);
        DB::table('regions')->where('name','세종')->update(['arraynum' => 150]);
        DB::table('regions')->where('name','대구')->update(['arraynum' => 140]);
        DB::table('regions')->where('name','광주')->update(['arraynum' => 130]);
        DB::table('regions')->where('name','울산')->update(['arraynum' => 120]);
        DB::table('regions')->where('name','제주')->update(['arraynum' => 110]);
        DB::table('regions')->where('name','충남')->update(['arraynum' => 100]);
        DB::table('regions')->where('name','충북')->update(['arraynum' => 90]);
        DB::table('regions')->where('name','전남')->update(['arraynum' => 80]);
        DB::table('regions')->where('name','전북')->update(['arraynum' => 70]);
        
    }
}
