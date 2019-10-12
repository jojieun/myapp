<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seoul = [
            '전체',
            '강남/논현',
            '강동/천호',
            '강서/목동',
            '건대/왕십리',
            '관악/신림',
            '교대/사당',
            '노원/강북',
            '명동/이태원',
            '삼성/선릉',
            '송파/잠실',
            '수유/동대문',
            '신촌/이대',
            '압구정/신사',
            '여의도/영등포',
            '종로/대학로',
            '홍대/마포'
               ];
        foreach($seoul as $se){
            DB::table('areas')->insert([
                'region_id' => 1,
                'name' => $se,
            ]);
        }
            $kks = [
                '전체',
                '일산/파주',
                '분당/수원',
                '남양주',
                '하남/구리',
                '안양/안산',
                '광명/부천'
               ];
        foreach($kks as $kk){
            DB::table('areas')->insert([
                'region_id' => 2,
                'name' => $kk,
            ]);
        }
        for($i=3; $i<14; $i++){
            DB::table('areas')->insert([
                'region_id' => $i,
                'name' => '전체',
            ]);
    }
}
}
