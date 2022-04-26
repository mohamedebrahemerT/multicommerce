@extends('admin.frontend.app')
@section('append')
<form method="post" action="{{ route('admin.appearance.update',$type) }}" class="basicform" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="form-group">
		<label>{{ __('Top Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="top_image">
		<br>
		             <img src="{{url('/')}}/{{ $info->top_image }}" alt="" class="img-fluid" style="width:1200;height: 100px;" >
	</div>
	<div class="form-group">
		<label>{{ __('Center Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="center_image">
		<br>
		             <img src="{{url('/')}}/{{ $info->center_image }}" alt="" class="img-fluid" style="width:1200;height: 100px;">
	</div>
	<div class="form-group">
		<label>{{ __('Bottom Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="bottom_image">
		<br>
		             <img src="{{url('/')}}/{{ $info->bottom_image }}" alt="" class="img-fluid" style="width:1200;height: 100px;">
	</div>

	<div class="form-group">
		<label>{{ __('Area Title') }} ({{ __('Arabic') }})</label>
		<input type="text"  class="form-control" name="area_title_ar" value="{{ json_decode($info->area_title,true)["ar"] ?? '' }}">
	</div>
    <div class="form-group">
        <label>{{ __('Area Title') }} ({{ __('English') }})</label>
        <input type="text"  class="form-control" name="area_title_en" value="{{ json_decode($info->area_title,true)["en"] ?? '' }}">
    </div>

	<div class="form-group">
		<label>{{ __('Area Content') }} ({{ __('Arabic') }})</label>
		<textarea class="form-control" name="description_ar">{{ json_decode($info->description,true)["ar"] ?? '' }}</textarea>
	</div>
    <div class="form-group">
        <label>{{ __('Area Content') }} ({{ __('English') }})</label>
        <textarea class="form-control" name="description_en">{{ json_decode($info->description,true)["en"] ?? '' }}</textarea>
    </div>

	<div class="form-group">
		<label>{{ __('Button Link') }}</label>
		<input type="text"  class="form-control" name="btn_link" value="{{ $info->btn_link ?? '' }}">
	</div>

	<div class="form-group">
		<label>{{ __('Button Text') }} ({{ __('Arabic') }})</label>
		<input type="text"  class="form-control" name="btn_text_ar" value="{{ json_decode($info->btn_text,true)["ar"] ?? '' }}">
	</div>
    <div class="form-group">
        <label>{{ __('Button Text') }} ({{ __('English') }})</label>
        <input type="text"  class="form-control" name="btn_text_en" value="{{ json_decode($info->btn_text,true)["en"] ?? '' }}">
    </div>

	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
	@endsection
	@push('js')
</form>
<script src="{{ asset('assets/js/form.js') }}"></script>

@endpush
