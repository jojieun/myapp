    <table>
        @forelse($snss as $sns)
            <tr>
            <th>{{$sns->channel->name}}</th>
        <td>{{ $sns->name }}</td>
        </tr>
        @empty
            <tr>
            <td>sns가 없습니다.</td>
        </tr>
        @endforelse
    </table>
<a href="#close" class="close"></a>
