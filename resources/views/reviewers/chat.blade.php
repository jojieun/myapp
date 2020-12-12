<!DOCTYPE html>
<html lang="ko">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163840965-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-163840965-1');
</script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="INDEX, FOLLOW"/>
	<meta name="Description" content="리뷰의힘입니다.">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0, user-scalable=yes,target-densitydpi=device-dpi">	
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<meta property="og:type" content="website">
	<meta property="og:url"	content="">
	<!--파비콘-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{route('main')}}/favi/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{route('main')}}/favi/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{route('main')}}/favi/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{route('main')}}/favi/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{route('main')}}/favi/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{route('main')}}/favi/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="{{route('main')}}/favi/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{route('main')}}/favi/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{route('main')}}/favi/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="{{route('main')}}/favi/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{route('main')}}/favi/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="{{route('main')}}/favi/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{route('main')}}/favi/favicon-16x16.png">
<link rel="manifest" href="{{route('main')}}/favi/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{route('main')}}/favi/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700&amp;subset=korean" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet">
	<!-- css -->
    <link href="{{ asset('css/style.css?ver=2.0') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    
    <link href="{{ asset('plugin/slick-1.8.1/slick.css?ver=0.2') }}" rel="stylesheet">
    <link href="{{ asset('plugin/slick-1.8.1/slick-theme.css?ver=0.2') }}" rel="stylesheet">
	<!-- script -->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('plugin/slick-1.8.1/slick.js') }}"></script>
<!--    <script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/main.js') }}" defer></script>
    <title>{{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:image" content="https://review-power.com/img/common/og_image.png"> 
    <meta property="og:description" content="리뷰의힘입니다.">
</head>
<body>
    <div id="chat_header">
        광고주 ooo와 대화중
        <button onclick="window.close();">채팅창 닫기</button>
    </div>
    <div id="chat_area">
        <div class="day">- 2020.12.12 -</div>
        <div class="yours chat">
            <div class="name">
                <img src="/img/main/my.jpg"><br>
                <span>OOO</span>
            </div>
            <div class="message">
                <span class="text">내용내용</span>
                <span class="time">14:30</span>
            </div>
        </div>
        <div class="my chat">
            <div class="message">
                <span class="text">내용내용</span>
                <span class="time">14:30</span>
            </div>
        </div>
    </div>
    <div id="input_chat">
        <input id="input_message">
        <button id="send_message">^</button>
    </div>     
</body>
</html>