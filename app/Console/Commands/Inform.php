<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Mail;
use App\Http\Controllers\TaskController;

class Inform extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inform:selected';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inform to selected people';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //선정 문자 보내기
        $cams=\App\Campaign::where('confirm',1)
            ->where('send_sms',0)
            ->whereDate('end_recruit', '<', Carbon::now()->subDay()->toDateString())
            ->with('campaignReviewers','brandCategory','area')
            ->get();
        $task_controller = new TaskController;
        foreach($cams as $cam){
            $select_reviewers =  $cam->campaignReviewers->where('selected',1);
            foreach($select_reviewers as $re){
                $task_controller->SendSMS($re->reviewer->mobile_num, $re->reviewer->name);
            }
            \App\Campaign::whereId($cam->id)->update(['send_sms' => 1]);
        }//endforeach
        
        //선정 메일 보내기
        $cams=\App\Campaign::where('confirm',1)
            ->where('send_mail',0)
            ->whereDate('end_recruit', '<', Carbon::now()->subDay()->toDateString())
            ->with('campaignReviewers','brandCategory','area')
            ->get();
        foreach($cams as $cam){
            //캠페인 링크 주소를 위한 요소
            $locaOrCate = $cam->form == 'v'?$cam->area->region->name.' '.$cam->area->name:$cam->brandCategory->name;
            //캠페인 링크 주소 구하기
            $cam_link = route('campaigns.show', [$cam->id, 'd'=>'모집마감', 'applyCount'=>$cam->campaignReviewers->count(), 'locaOrCate'=>$locaOrCate]);
             //선정된 리뷰어 구하기
            $select_reviewers =  $cam->campaignReviewers->where('selected',1);
            //전송할 메일주소 구하기
            $to = array();
            foreach($select_reviewers as $re){
                $to[] = $re->reviewer->email;
            }
            $subject = '캠페인 리뷰어 선정 안내 메일입니다.';
            $data = [
                'cam_img' => route('main').'/files/'.$cam->main_image,
                'cam_link' => $cam_link,
                'cam_name' => $cam->name,
            ];
            Mail::send(
            'emails.campaigns.reviewer_selected',
            $data,
            function($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            });
            //메일 전송했음을 저장
            \App\Campaign::whereId($cam->id)->update(['send_mail' => 1]);
        }//endforeach

    }
}
