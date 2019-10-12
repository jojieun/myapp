<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chs = [
            '네이버블로그'=>'https://blog.naver.com/',
            '인스타그램'=>'https://www.instagram.com/',
            '페이스북'=>'https://www.facebook.com/',
            '유튜브'=>'https://www.youtube.com/',
            '네이버포스트'=>'https://post.naver.com/',
            '카카오스토리'=>'https://story.kakao.com/'
               ];
        foreach($chs as $ch=>$url){
            DB::table('channels')->insert([
                'name' => $ch,
                'url' => $url,
            ]);
        }
    }
}
