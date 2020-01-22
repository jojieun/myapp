@forelse($brands as $brand)
<option value="{{ $brand->id }}" @if( $brand->id == old('brand_id') || $brand->id == $opbrand_id ) selected @endif>[{{ $brand->category->name }}] {{ $brand->name }}</option>
@empty
<option value="">브랜드가 없습니다</option>
@endforelse