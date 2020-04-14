@extends('admin.layout.main')
@section('content')
    <h1>하단 배너 관리</h1>
<table>
    <tr>
        <th>no</th>
        <th>이미지</th>
        <th>링크경로</th>
        <th>처리</th>
    </tr>
    @forelse ($banners as $banner)
        <tr>
            <form method="post" action="{{route('admin.bottom_banner_modi',$banner->id)}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
            <td>{{ $loop->iteration }}</td>
            <td><img src="/files/banner/{{$banner->name}}" width="300">
                    <br><input type="file" name="name"></td>
            <td><input type="text" value="{{$banner->url}}" name="url"></td>
            <td>
                <button type="submit" class="modi" value="{{ $banner->id }}">수정</button>
                <button class="del" value="{{ $banner->id }}">삭제</button>
            </td>
            </form>
        </tr>
        @empty
        <tr>
                <td colspan="5">배너가 없습니다</td>
            </tr>
        @endforelse
<tr>
    <form method="post" action="{{route('admin.bottom_banner_add')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
                <td>+</td>
    <td><input type="file" name="name"></td>
            <td><input type="text" name="url" value="#"></td>
            <td>
                <button type="submit" class="add">추가</button>
            </td>
    </form>
            </tr>
</table>
(*** 배너 이미지 크기 : 1238 * 225 px)
<script>
    //삭제 클릭시
    $('.del').on('click', function(e){
       e.preventDefault();
        location.href = "bottom_banner_del/"+$(this).val();
    });
    //    이미지업로드바로보기
    $('input[name=name]').change(function(e){
       e.preventDefault();
        $(this).prev().prev().attr({
                   src:URL.createObjectURL(event.target.files[0])
               });
         });
    
        //-----이미지업로드바로보기
    </script>

@endsection