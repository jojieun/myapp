    <table>
        <tr>
            <th>의뢰제목</th>
        <td>{{$agency->title}}</td>
        </tr> 
        <tr>
            <th>의뢰자</th>
        <td>{{$agency->advertiser->name}}
            | 연락처: {{$agency->advertiser->mobile_num}}</td>
        </tr> 
        <tr>
            <th>의뢰날짜</th>
        <td>{{$agency->created_at}}</td>
        </tr>
        <tr>
            <th>문의내용</th>
        <td>{!! nl2br($agency->content) !!}</td>
        </tr>
    </table>
    <form id="answer" type="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
    `   <tr>
            <th>처리내용</th>
        <td>
            <input name="process"  value="{{ old('process', $agency->process) }}">
            </td>
        </tr>
    </table>
        <button data-id="{{$agency->id}}" id="modal_submit">답변입력</button>
    </form>
<a href="#close" class="close"></a>
