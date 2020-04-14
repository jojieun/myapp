<?php

namespace App\Exports;

use App\CampaignReviewer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class CampaignReviewerExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    use Exportable;
    
    public function __construct(int $camId)
    {
      $this->camId = $camId;
    }
    
    public function query()
    {
        return CampaignReviewer::query()->where('campaign_id',$this->camId)->where('selected',1)->with('reviewer');
    }
}
