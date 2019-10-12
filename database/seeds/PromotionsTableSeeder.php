<?php

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            'name' => '홍보배너게재',
            'price' => 200000,
            'limit' => 4,
            'instruction' => '사이트 최상단에 홍보 배너를 게재합니다.<br>(블록션 디자이너가 배너 제작에 대한 내용을 연락드립니다.)',
        ]);
        DB::table('promotions')->insert([
            'name' => '푸시 알림',
            'price' => 200000,
            'instruction' => '추천되는 인플루언서 회원 100명에게 푸시 알림을 보내드립니다.',
        ]);
    }
}
