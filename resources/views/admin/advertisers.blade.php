@extends('admin.layout.main')
@section('content')
    <h1>광고주 회원 목록</h1>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>이메일</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>메일,sns수신동의</th>
                <th>가입일</th>
                <th>가입정보수정일</th>
            </tr>
        </thead>
        @forelse ($advertisers as $advertiser)
        <tbody>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $advertiser->email }}</td>
                <td>{{ $advertiser->name }}</td>
                <td>{{ $advertiser->mobile_num }}</td>
                <td>{{ $advertiser->receive_agreement }}</td>
                <td>{{ $advertiser->created_at }}</td>
                <td>{{ $advertiser->updated_at }}</td>
            </tr>
        </tbody>
        @empty
        <tr>
            <td colspan=100>광고주가 없습니다.</td>
        </tr>
        @endforelse
</table>
{{ $advertisers->links() }}

@endsection