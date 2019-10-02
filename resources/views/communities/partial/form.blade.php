<div class="table_default write">
				<div class="table_td">
					<div class="table_td_line {{ $errors->has('title') ? 'has-error' : '' }}">
						<input name="title" type="text" id="title" value="{{ old('title', $community->title) }}" placeholder="제목을 입력해주세요." class="full_width" />
                        {!! $errors->first('title','<span>:message</span>')!!}
					</div>
					<div class="table_td_line {{ $errors->has('content') ? 'has-error' : '' }}">						
						<textarea name="content" rows="7" id="content" placeholder="내용을 입력해주세요." class="full_width" >{{ old('content', $community->content) }}</textarea>
					</div>
				</div>
			</div>

			
						