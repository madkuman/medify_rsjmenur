@extends('layouts.main2')

@section('title')
Bergabung ke Grup
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content" id="group-list">
				<form method="POST" class="col-md-12">
					{{ csrf_field() }}
					<div id="inputplaceholder" class="d-none">
		            </div>
					<div class="col-md-12">
						@if(in_array(Auth::user()->profesi, [1, 2, 3])) 
						@if(Auth::user()->profesi == 1)
						<h6 class="font-w400 text-right">Langkah 2 dari 7</h6>
						@else
						<h6 class="font-w400 text-right">Langkah 2 dari 6</h6>
						@endif
						@else
						<h6 class="font-w400 text-right">Langkah 2 dari 5</h6>
						@endif
						<div class="row">
							<div class="col-md-8">
								<h4 class="font-w400 mb-5"> Selamat Datang di {{config('app.name','Medify')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
								<h5 class="font-w400">Pilih Grup, Grup akan memengaruhi fitur yang dapat anda akses</h5>		
							</div>
							<div class="col-md-4">
								<button type="submit" id="submitgroup" class="btn btn-xs btn-default font-w300 float-right">
			                    	LANJUTKAN <i class="fa fa-chevron-right"></i>
			                	</button>
							</div>
						</div>					
					</div>
                    <div class="col-12">
                        <input type="text" class="form-control fuzzy-search" placeholder="Cari Grup">
                    </div>
					<div class="col-md-12 mt-20">
						<div class="row list">
							@foreach($rec_grup as $item)
							<div class="col-3">
								<a id="id-{{ $item->id }}" class="block block-content block-link-shadow text-center pt-0 pb-10 px-0">
									<div>
										<p id="star-{{ $item->id }}" class="my-0 text-left font-w300" style="font-size: 12px; visibility: hidden;">
											<i class="fa fa-star fa-2x ml-2 mt-2" style="color: #7eb73d"></i>
										</p>					
									</div>
									<div>
										<p class="font-w600 group-name">{{ $item->name }}</p>
									</div>
									<div>
										<p>
											<img src="{{url($item->photo_thumb)}}" style="height: 32px">
										</p>
									</div>
									<div>
										<button type="button" id="button-{{ $item->id }}" class="btn btn-xs btn-noborder btn-primary font-w600" value="{{ $item->id }}">
			                            	Bergabung
			                        	</button>
									</div>
								</a>
							</div>
							@endforeach
							@foreach($grup as $item)
							<div class="col-3">
								<a id="id-{{ $item->id }}" class="block block-content block-link-shadow text-center pt-0 pb-10 px-0">
									<div>
										<p id="star-{{ $item->id }}" class="my-0 text-left font-w300" style="font-size: 12px; visibility: hidden;">
											<i class="fa fa-star fa-2x ml-2 mt-2" style="color: #7eb73d"></i>
										</p>					
									</div>
									<div>
										<p class="font-w600 group-name">{{ $item->name }}</p>
									</div>
									<div>
										<p>
											<img src="{{url($item->photo_thumb)}}" style="height: 32px">
										</p>
									</div>
									<div>
										<button type="button" id="button-{{ $item->id }}" class="btn btn-xs btn-noborder btn-primary font-w600" value="{{ $item->id }}">
			                            	Bergabung
			                        	</button>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					</div>
					
				</form>
		
			</div>
		</div>
			
	</div>
</main>

<form method="POST" url="{{url()->current()}}" id="formRole">
    {{csrf_field()}}
	<input type="hidden" name="role" id="roleInput">
</form>


@endsection

@section('js')
<script>
	$(document).ready(function(){
		$('#submitgroup').attr('disabled', 'disabled');
		$.ajax({
			url: '{{url("getting-started")}}/grup/reclist/get',
			type: "GET",
			dataType: "json",
			success: function(data){
				console.log(data);
				$.each(data, function(key, value){
					var rec_id = 'id-'+value;
					var rec = "#"+rec_id;
					var star_id = 'star-'+value;
					var star = "#"+star_id;
					var btn_id = 'button-'+value;
					var btn = "#"+btn_id;
					$(btn).toggleClass('btn-success');
					$(rec).toggleClass('recommended');
					$(star).css("visibility","visible");
				});
			}
		});
	});
</script>
<script>
	var selected = 0;
	$('.btn-noborder').click(function(){
		$(this).toggleClass('disabled');
		var val = $(this).val();
		var inp_id = 'inp-'+val;
		var placeholder = "#inputplaceholder";
		var ip = $('<input>').attr({
		    type: 'hidden',
		    id: inp_id,
		    name: 'group[]',
		    value: val 
		});
		if($(this).hasClass('disabled')){
			selected++;
			$(this).html('<i class="fa fa-check"></i> Joined');
			$(this).css('cursor', 'pointer');
			$(ip).appendTo(placeholder);
		}
		else{
			selected--;
			$(this).html('Bergabung');
			var inp = "#"+inp_id;
			$(inp).remove();
		}
		if (selected) {
			$('#submitgroup').removeAttr('disabled');
		}
		else{
			$('#submitgroup').attr('disabled', 'disabled');
		}
	});
</script>
<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'group-name' ]
    };

    var groupList = new List('group-list', options);
</script>
@endsection