        @forelse ($exposure_purchases as $exposure_purchase)
        <tr>
            <form method="post" action="{{route('admin.exposure_purchase_update',$exposure_purchase->id)}}">
                {!! csrf_field() !!}
            <td>{{ $loop->iteration }}</td>
            <td>
                <select name="exposure_id">
                    @foreach($exposures as $exposure)
                    <option value="{{$exposure->id}}" @if($exposure->id==$exposure_purchase->exposure_id) selected @endif >{{$exposure->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>{{ $exposure_purchase->campaign->name }}</td>
<!--
<td>{{ $exposure_purchase->start }}</td>
            <td>{{ $exposure_purchase->end }}</td>
-->
            <td>{{ $exposure_purchase->created_at }}</td>
            <td><button type="submit">수정</button></td>
                </form>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션 구매내역이 없습니다.</td>
        </tr>
        @endforelse
