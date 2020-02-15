        @forelse ($apply_deposits as $apply_deposit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $apply_deposit->reviewer->name }}</td>
            <td>{{ $apply_deposit->reviewer->mobile_num }}</td>
            <td>{{ $apply_deposit->bank->name }}</td>
            <td>{{ $apply_deposit->account_number }}</td>
            <td>{{ $apply_deposit->account_holder }}</td>
            <td>{{ $apply_deposit->amount }}</td>
            <td>{{ $apply_deposit->amount * 0.967 - 500 }}</td>
            <td>{{ $apply_deposit->created_at }}</td>
            <td><button class="process" data-d="{{ $apply_deposit->id }}" data-r="{{ $apply_deposit->reviewer->id }}" data-a="{{ $apply_deposit->amount }}">입금완료처리</button></td>
        </tr>
        <tr>
            <td colspan="10"><img src="/files/id_card/{{ $apply_deposit->id_card_image }}"></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>출금신청 내역이 없습니다</td>
        </tr>
        @endforelse