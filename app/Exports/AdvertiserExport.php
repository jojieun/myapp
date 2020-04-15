<?php

namespace App\Exports;

use App\Advertiser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdvertiserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Advertiser::all();
    }
    public function headings(): array
    {
        $head = [
            'id',
            'email',
            '이름',
            '전화번호',
            '수신동의',
            '',
            '가입일',
            '수정일',
            '포인트' 
        ];
        return $head;
    }
}
