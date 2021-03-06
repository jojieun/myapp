<?php
return [

    // 파트너 신청시 발급받은 링크아이디
    'LinkID' => 'STRONGAD',

    // 파트너 신청시 발급받은 비밀키
    'SecretKey' => env('POPBILL_KEY'),

    // 통신방식 기본은 CURL , PHP curl 모듈 사용에 문제가 있을 경우 STREAM 기재가능.
    // STREAM 사용시에는 php.ini의 allow_url_fopen = on 으로 설정해야함.
    'LINKHUB_COMM_MODE' => 'CURL',

    // 연동환경 설정값, 개발용(true), 상업용(false)
    'IsTest' => false,
];
