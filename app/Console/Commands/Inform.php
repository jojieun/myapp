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
        $task_controller = new TaskController;
        //****리뷰마감 문자알림
        //------ 3일전
        $dMinus3s = \App\Campaign::where('confirm',1)
            ->whereDate('end_submit', Carbon::now()->addDays(3)->toDateString())
            ->with(['campaignReviewers'=>function($query){
                $query->where('selected',1)
                    ->doesntHave('review');
            }])->get();
        
        foreach($dMinus3s as $dMinus3){
            $campaignReviewers = $dMinus3->campaignReviewers;
            foreach($campaignReviewers as $campaignReviewer){
                $reviewer=$campaignReviewer->reviewer;
                $task_controller->SendLMS_review($reviewer->mobile_num, $reviewer->name, $dMinus3->name, '3일 남았습니다. 마감일 자정 전까지 리뷰의힘에 리뷰 등록이 완료되어야 패널티가 부과되지 않습니다.', 'select 에서 리뷰등록까지 완료되어야합니다.');
            }
        }
        //------ 1일전
        $dMinus1s = \App\Campaign::where('confirm',1)
            ->whereDate('end_submit', Carbon::now()->addDay()->toDateString())
            ->with(['campaignReviewers'=>function($query){
                $query->where('selected',1)
                    ->doesntHave('review');
            }])->get();
        foreach($dMinus1s as $dMinus1){
            $campaignReviewers = $dMinus1->campaignReviewers;
            foreach($campaignReviewers as $campaignReviewer){
                $reviewer=$campaignReviewer->reviewer;
                $task_controller->SendLMS_review($reviewer->mobile_num, $reviewer->name, $dMinus1->name, '1일 남았습니다. 마감일 자정 전까지 리뷰의힘에 리뷰 등록이 완료되어야 패널티가 부과되지 않습니다.', 'select 에서 리뷰등록까지 완료되어야합니다.');
            }
        }
        //------ 1일후
        $dPlus1s = \App\Campaign::where('confirm',1)
            ->whereDate('end_submit', Carbon::now()->subDay()->toDateString())
            ->with(['campaignReviewers'=>function($query){
                $query->where('selected',1)
                    ->doesntHave('review');
            }])->get();
        foreach($dPlus1s as $dPlus1){
            $campaignReviewers = $dPlus1->campaignReviewers;
            foreach($campaignReviewers as $campaignReviewer){
                $reviewer=$campaignReviewer->reviewer;
                $task_controller->SendLMS_review($reviewer->mobile_num, $reviewer->name, $dPlus1->name, '지났습니다. 오늘까지가 마지막 업로드 기한입니다.', 'end 에서 리뷰등록까지 완료되어야합니다. 리뷰 등록 기한에 확인 되지 않는 포스팅 건에 대해서는 체험 내용에 대해 환불 요청 등 제재가 있을 수 있으니 오늘까지 꼭 업로드 후 리뷰등록 바랍니다.');
            }
        }
        
        //*****선정 문자 보내기
        $cams=\App\Campaign::where('confirm',1)
            ->where('send_sms',0)
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
            foreach($select_reviewers as $re){
                $task_controller->SendLMS($re->reviewer->mobile_num, $re->reviewer->name, $cam_link, $cam->end_submit, $cam->name);
            }
            \App\Campaign::whereId($cam->id)->update(['send_sms' => 1]);
        }//endforeach
        
        //선정 메일 보내기
        $cams2=\App\Campaign::where('confirm',1)
            ->where('send_mail',0)
            ->whereDate('end_recruit', '<', Carbon::now()->subDay()->toDateString())
            ->with('campaignReviewers','brandCategory','area')
            ->get();
        foreach($cams2 as $cam){
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
            $subject = '캠페인 리뷰어 선정 알림 메일입니다.';
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
