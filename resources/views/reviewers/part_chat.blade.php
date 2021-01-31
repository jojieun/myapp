<div id="chat_header">
    광고주 {{$advertiser->name}}님과 대화중
    <a href="#select" class="close_button">채팅창 닫기</a>
</div>
<div id="chat_area_wrap">
<div id="chat_area">
    @foreach ($messages as $day => $message_list)
    <div class="day">- {{ $day }} -</div>
        <? $isFirst = 1; //광고주 네임 출력관련?>
        @foreach ($message_list as $message)
            @if($message->from_ad)
            <div class="yours chat">
                @if($isFirst)
                <? $isFirst = 0; ?>
                <div class="name">
                    <img src="/img/main/my.jpg"><br>
                    <span>{{$advertiser->name}}</span>
                </div>
                @endif
            @else
            <? $isFirst = 1; ?>
            <div class="my chat">
            @endif
                <div class="message">
                    <span class="text">{{$message->text}}</span>
                    <span class="time">{{Carbon\Carbon::parse($message->created_at)->format('H:i')}}</span>
                </div>
            </div>
        @endforeach
    @if($loop->last and $now_date)
    <div class="day">- {{ $now_date }} -</div>    
    @endif
    @endforeach
</div>
</div>
<div id="input_chat">
    <input id="input_message">
    <button id="send_message" onclick="save_message();">^</button>
</div>
    <script>
    $('.close_button').attr('href', before);
    </script>