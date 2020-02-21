    <table>
        <tr>
            <th>문의카테고리</th>
        <td>{{$onetoone->qcategory->name}}</td>
        </tr>
        <tr>
            <th>문의제목</th>
        <td>{{$onetoone->title}}</td>
        </tr> 
        <tr>
            <th>문의자</th>
        <td>@if($onetoone->reviewer)
                                {{$onetoone->reviewer->nickname}}(리뷰어)
                                @else
                                {{$onetoone->advertiser->name}}(광고주)
                                @endif</td>
        </tr> 
        <tr>
            <th>문의날짜</th>
        <td>{{$onetoone->created_at}}</td>
        </tr>
        <tr>
            <th>문의내용</th>
        <td>{!! nl2br($onetoone->content) !!}</td>
        </tr>
    </table>
    <form id="answer" type="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
            <tr>
            <th>답변제목</th>
        <td>
            <input name="answer_title"  value="{{ old('answer_title', $onetoone->answer_title) }}">
            </td>
        </tr>
        <tr>
            <th>답변</th>
        <td><textarea name="answer" rows="5">{{ old('answer', $onetoone->answer) }}</textarea></td>
        </tr> 
    </table>
        <button data-id="{{$onetoone->id}}" id="modal_submit">답변입력</button>
    </form>
<a href="#close" class="close"></a>
