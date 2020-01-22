<div class="campaign-list w5">
				<ul>
                    <? $campaigns = $recruitCampaigns ?>
                    @include('campaigns.part_campaign', ['empty_msg' => '캠페인이 없습니다.'])
				</ul>
			</div>
<a class="close" href="#close"></a>