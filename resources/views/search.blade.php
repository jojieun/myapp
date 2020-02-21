@extends('layouts.main')
@section('content')
<span class="m-bar2"></span>
<div class="sub-container bt-ddd">
	<section class="content-in-sub">
        <h2>캠페인 검색결과</h2>
		<div class="campaign-list sub6">
			<ul>
                @include('campaigns.part_campaign')
			</ul>
		</div>
	</section>
    <section class="content-in-sub">
        <h2>인플루언서 검색결과</h2>
		<div class="campaign-list sub6">
			<div class="table_default pd28">
                @include('influencers.part_list')
            </div>
		</div>
	</section>
</div>
@endsection