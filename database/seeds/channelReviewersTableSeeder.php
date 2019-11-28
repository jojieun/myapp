<?php

use Illuminate\Database\Seeder;

class channelReviewersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $naverbs = [
 11=>'bloxion',      
 16=>'Ajak',         
 23=>'rkdwjd1007',   
 24=>'zanne1218',    
 37=>'ps717942',     
 39=>'bbabba77',     
 40=>'wanna_be7777', 
 42=>'cpahaja',      
 43=>'dannymam',     
 44=>'joan2201',     
 45=>'princenoa',    
 46=>'dbsa8439',     
 47=>'goodnabi0',    
 50=>'truelove7712', 
 51=>'choi__bb',     
 54=>'coco5154',     
 57=>'nrg_zzwl6434', 
 60=>'soop_e',       
 61=>'mrp',          
 66=>'kissmint333',  
 67=>'rin_hun315',   
 69=>'genie_y_',     
 70=>'gkqls879',     
 71=>'yahmi07',      
 72=>'zxcv0922',     
 73=>'leehoney_g',   
 74=>'edwin9407',    
 75=>'jjwlgus78',    
 76=>'baejji4612',   
 77=>'sb0606',
 78=>'sb0606',
 79=>'wlswn502',
 80=>'dbsel88',
 81=>'oioio11',
 83=>'lsszz210',
 84=>'gytmd3412',
 85=>'lovablj',
 87=>'theboss005',
 91=>'ssouil',
 92=>'ctrlz88',      
 93=>'mimoa88',      
 94=>'taehomon',     
 96=>'nazi_day',     
 97=>'nazi_day',     
100=>'sexy_bom',     
101=>'dlahrwl',      
102=>'ahnjiae2',     
104=>'zzksylove',    
106=>'fungji',       
107=>'nuri527',      
108=>'ㅣ',            
109=>'choinuri01',   
110=>'rjhzzz',       
114=>'mous03',       
115=>'remiyo79',     
116=>'tpgml1004_',   
117=>'cutesiwoo',    
118=>'emflal02',     
120=>'juupapa',      
121=>'ce001121',     
125=>'yoonhee_93',   
127=>'namgyu08'
    ];
        foreach($naverbs as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 1,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //----네이버블로그입력
        
        //네이버포스트입력
        $naverps =[
42=>'cpahaja',
107=>'nuri527',
117=>'cutesiwoo',
118=>'emflal02'
        ];
        foreach($naverps as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 5,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //-----네이버포스트입력
        
        //인스타그램입력
        $instas=[
17=>'pungyo_mam',
            18=>'sohee._.s2',
            19=>'jjun2_mam',
20=>'hyejin3685',
21=>'haruh4',
23=>'min__dyong',
24=>'pr252nt',
25=>'geni_0316',
27=>'muk._.sarah',
28=>'poun_ding_0430',
29=>'new_seul',
30=>'_bongyeosa',
31=>'1.fine',
34=>'z.y.e.o.n',
36=>'sung_narae',
37=>'ps717942',
38=>'hiit1004',
39=>'honeydoong',
42=>'ssingatv',
43=>'dahyun.song',
45=>'joohyunha_noa',
46=>'reum_eat.again',
47=>'aurora_kim00',
50=>'mylove7712',
51=>'choi__bb',
52=>'BC ICBS',
55=>'kong.sta',
56=>'gauni____4',
60=>'Nohsoup_',
61=>'saie.log',
63=>'0g.__.h0',
64=>'pinkfox_5',
65=>'jomozzi',
66=>'gorgeous_om',
67=>'rin_hun315',
69=>'genie.yoon',
70=>'bean_tory',
72=>'kkongbabypapa',
73=>'leehoney_g',
77=>'soobok.kim',
78=>'soobok.kim',
79=>'songpearl0506',
81=>'rangyu.me',
82=>'mjpro0715',
84=>'kims.love',
85=>'luv_ruka',
88=>'KYUNG EUN',
89=>'KYUNG EUN',
91=>'borigoing',
92=>'yesdoitcat',
93=>'morrie_ksj',
95=>'leealim90',
96=>'nazi_day',
97=>'nazi_day',
99=>'98_taeng_128',
100=>'ab_s_90',
103=>'birichinata_sy',
104=>'soon_d_',
105=>'ssunysta',
106=>'lune.sj',
107=>'onnuri0527',
109=>'cloud_0704',
110=>'byuzoo',
112=>'ub_lash',
115=>'chinsj',
116=>'heeinsta',
117=>'cutesiwoo',
118=>'mirine_02',
121=>'lovely_eun__c',
127=>'gyuseon87'
        ];
        foreach($instas as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 2,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //-----인스타그램입력
        
        //유튜브입력
        $youtubes=[
42=>'UCGU6Ij7IvD7Dr5CfGkXOSsg',
45=>'UCW8rtF6agolWJWt6tSxj_sQ',
107=>'onnuri0527'
        ];
        foreach($youtubes as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 4,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //-----유튜브입력
        
        //페이스북입력
        $faces =[
42=>'ssingatv',
50=>'truelove7712',
79=>'songpearl0506',
95=>'01079333866',
107=>'nuri527',
121=>'찬은'
        ];
        foreach($faces as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 3,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //-----페이스북입력
        
        //카카오입력
        $kakaos =[
17=>'34sea31',
21=>'34sea31',
42=>'_IMiWm',
50=>'truelove7712',
79=>'wlswn502',
85=>'luv_ruka'
        ];
        foreach($kakaos as $key=>$value){
            DB::table('channel_reviewers')->insert([
            'channel_id' => 6,
            'reviewer_id' => $key,
            'name' => $value,
            ]);
        }
        //-----카카오입력
    }
}
