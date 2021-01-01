<div id="chat_header" data-adid="{{$advertiser->id}}" data-fromad="0">
    광고주 {{$advertiser->name}}님과 대화중
    <a href="#select">채팅창 닫기</a>
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
    <button id="send_message" onclick="save_message();">^</button>
</div>     