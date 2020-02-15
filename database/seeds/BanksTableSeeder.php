<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'KDB산업은행'=>'002',
            'IBK기업은행'=>'003',
            'KB국민은행'=>'004',
            'Sh수협은행'=>'007',
            '한국수출입은행'=>'008',
            'NH농협은행'=>'011',
            '우리은행'=>'020',
            'SC제일은행'=>'023',
            '한국씨티은행'=>'027',
            '대구은행'=>'031',
            '부산은행'=>'032',
            '광주은행'=>'034',
            '제주은행'=>'035',
            '전북은행'=>'037',
            '경남은행'=>'039',
            'HSBC 서울지점'=>'054',
            '하나은행'=>'081',
            '신한은행'=>'088',
            '케이뱅크'=>'089',
            '카카오뱅크'=>'090',
        ];
        foreach($banks as $name=>$code){
            DB::table('banks')->insert([
                'name' => $name,
                'code' => $code,
            ]);
        }
    }
}
