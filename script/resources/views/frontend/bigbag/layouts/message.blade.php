 @if(session()->has('success') )
<div class="alert alert-success" style="text-align: center;font-size:20px;">
	{{session('success')}}
</div>
@endif


@if(session()->has('danger') )
<div class="alert alert-danger" style="text-align: center;font-size:20px;">
	{{session('danger')}}
</div>
@endif

@if ($errors->any())
	<div class="alert alert-danger" style="text-align: center;">
	    @foreach ($errors->all() as  $value)
	    	<p>{{ $value }}</p>
	    @endforeach
	</div>
@endif



























