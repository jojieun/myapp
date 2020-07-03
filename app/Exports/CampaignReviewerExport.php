<?php

namespace App\Exports;

use App\CampaignReviewer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaignReviewerExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    use Exportable;
    
    public function __construct(int $camId)
    {
      $this->camId = $camId;
        $campaign = \App\Campaign::whereId($camId)->with('channel')->first();
        //채널 아이디 구하기
        $this->channel = $campaign->channel_id;
        //채널명 구하기
        $this->channel_name = $campaign->channel->name;
        //캠페인형태 구하기
        $this->form = $campaign->form;
    }
    
    public function query()
    {
        return CampaignReviewer::query()->where('campaign_id',$this->camId)->where('selected',1)->with('reviewer')->with('channel_reviewer');
    }
    
    public function map($campaign_reviewer): array
    {
        $sns = $campaign_reviewer->channel_reviewer()->where('channel_id',$this->channel)->first();
        if($this->form=='v'){
            return [
            $campaign_reviewer->reviewer->name,
            $campaign_reviewer->reviewer->nickname,
            $sns->name,
            $campaign_reviewer->reviewer->mobile_num,
            ];
        } else {
            return [
            $campaign_reviewer->reviewer->name,
            $campaign_reviewer->reviewer->nickname,
            $sns->name,
            $campaign_reviewer->reviewer->mobile_num,
            $campaign_reviewer->reviewer->zipcode,
            $campaign_reviewer->reviewer->address,
            $campaign_reviewer->reviewer->detail_address, 
            ];
        }
    }
    
    public function headings(): array
    {
        if($this->form=='v'){
            $head = [
                '이름',
                '닉네임',
                $this->channel_name,
                '전화번호',
            ];
        } else{
            $head = [
                '이름',
                '닉네임',
                $this->channel_name,
                '전화번호',
                '우편번호',
                '주소',
                '상세주소',
            ];
        }
        return $head;
    }
}
