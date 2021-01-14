<div id="chat_header" data-reid="{{$reviewer->id}}" data-fromad="1">
    리뷰어 {{$reviewer->name}}님과 대화중
    <a href="#select">채팅창 닫기</a>
</div>
<div id="chat_area_wrap">
<div id="chat_area">
    @foreach ($messages as $day => $message_list)
    <div class="day">- {{ $day }} -</div>
        <? $isFirst = 1; //리뷰어 네임 출력관련?>
        @foreach ($message_list as $message)
            @if($message->from_ad)
            <? $isFirst = 1; ?>
            <div class="my chat">
            @else
            <div class="yours chat">
                @if($isFirst)
                <? $isFirst = 0; ?>
                <div class="name">
                    <img src="/img/main/my.jpg"><br>
                    <span>{{$reviewer->name}}</span>
                </div>
                @endif
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