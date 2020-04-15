<?php

namespace App\Exports;

use App\Reviewer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReviewerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reviewer::all();
    }
    
    public function headings(): array
    {
        $head = [
            'id',
            'email',
            '이름',
            '닉네임',
            '전화번호',
            '생일',
            '우편번호',
            '주소',
            '상세주소',
            '성별',
            '수신동의',
            '',
            '가입일',
            '수정일',
            '포인트' 
        ];
        return $head;
    }
}
