@extends('admin.layout.main')
@section('content')
    <h1>관리자 목록</h1>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>이메일</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>가입일</th>
                <th>권한부여</th>
                <th>처리</th>
            </tr>
        </thead>
        <tbody id="list">
        @forelse ($admins as $admin)
        
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->mobile_num }}</td>
                <td>{{ $admin->created_at }}</td>
                <td>
                    <form method="post" action="{{route('admins.update_authority',$admin->id)}}">
                {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
                <select name="authority">
                    @for($i = 0; $i < 11; $i++)
                    <option value="{{$i}}" @if($i==$admin->authority) selected @endif >{{$i}}</option>
                    @endfor
                </select>
                <button type="submit">수정</button>
                </form>
        </td>
        <td>
            <form action="{{ route('admins.destroy' , $admin->id)}}" method="POST">
            {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
        <button type="submit" class="del">삭제(탈퇴)</button>
                
</form>
                </td>
            </tr>
        @empty
        <tr>
            <td colspan=100>관리자가 없습니다.</td>
        </tr>
        @endforelse
</tbody>
</table>
<script>
    //삭제(탈퇴)
    $('#list').on('click', '.del', function(e){
      if (!confirm('해당 관리자를 삭제합니다. 삭제 후 복구할 수 없습니다.')) {
          e.preventDefault();
      }
    });
</script>
@endsection