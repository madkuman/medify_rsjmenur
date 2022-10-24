@extends('kepegawaian.layouts.main')

@section('title')
Kepegawaian | User Control
@endsection

@section('subtitle')
User Control
@endsection

@section('css')

@endsection

@section('content')
<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Edit User
			</h3>
		</div>
		<div class="block-content">
			<form method="POST" action="{{url('admin')}}/user-control/{{$user->id}}/edit">
				{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nomor Id Pegawai</label>
							<select class="js-select2 form-control" id="kepegawaian" name="employee">
	                            @if(!empty($synced_acc))
	                            <option value="{{$synced_acc->id}}" selected>{{$synced_acc->name}} ({{$synced_acc->nrp}})</option>
	                            @else
	                            <option value="">Pilih Nama...</option>
	                            @endif
	                            @foreach($pegawai as $item)
	                            <option value="{{$item->id}}">{{$item->name}} ({{$item->nrp}})</option>
	                            @endforeach
	                        </select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control form-control-lg" value="{{$user->email}}" readonly="">
							@if ($errors->has('email'))
	                        <span class="badge badge-danger">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                        @endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Profesi</label>
							<select class="js-select2 form-control" id="profesi" name="profession">
								@foreach($profesi as $id => $title)
								<option value="{{ $id }}" @if($user->profesi == $id) selected @endif>{{ $title }}</option>
								@endforeach
		                    </select>
						</div>
					</div>
				</div>
				<div id="div-spesialis" class="row" style="display: none;">
					<div class="col-6">
						<div class="form-group">
							<label>Speciality</label>
							<select class="js-select2 form-control" id="spesialis" name="specialty" style="width: 100%;" disabled>
		                        @foreach($specialty as $id => $title)
		                        <option value="{{ $id }}" @if($user->specialty == $id) selected @endif>{{ $title }}</option>
		                        @endforeach
		                    </select>
						</div>
					</div>
				</div>
                <div id="div-subspesialis" class="row" style="display: none;">
					<div class="col-6">
						<div class="form-group">
							<label>Sub Speciality</label>
							<select class="js-select2 form-control" id="subspesialis" name="subspecialty" style="width: 100%;" disabled>
		                        <option value="">Tanpa Subspesialis</option>
		                        @if(!empty($subspecialty))
		                        @foreach($subspecialty as $item)
		                        <option value="{{ $item->id }}"  @if($user->subspecialty == $item->id) selected @endif >{{ $item->name }}</option>
		                        @endforeach
		                        @endif
		                    </select>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-6">
						<hr>
						<div class="form-group text-right">
							@if(isset($origin))
							<input type="hidden" name="origin" value="{{$origin}}">
							@endif
							<button class="btn btn-alt btn-primary btn-hero m-0" type="submit" id="button_submit">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')



<script type="text/javascript">
	$(document).ready(function() {
		@if(!empty($specialty))
		$('#spesialis').attr("disabled",false);
		$('#div-spesialis').show();
		@endif

		@if(!empty($user->profesi_detail))
		@if($user->profesi_detail->title == 'Dokter')
		$('#subspesialis').attr("disabled",false);
		$('#div-subspesialis').show();
		@endif
		@endif
	});

	$('#profesi').on('change', function(e) {
		var id = $(this).val();
		if (id) {
			$.ajax({
				url: '{{url("getting-started")}}/profesi/spesialisasi/get/'+id,
				type: "GET",
				dataType: "json",
				success: function(data){
					if (data.length != 0)
					{
						$('#spesialis').empty();
						$.each(data, function(key, value){
							$('#spesialis').append('<option value="'+key+'">'+value+'</option>');
						});
						$('#spesialis').attr("disabled",false);
						$('#div-spesialis').show(500);
						if (id == 1) {
							$('#subspesialis').attr("disabled",false);
							$('#div-subspesialis').show(500);
						} else {
							$('#subspesialis').attr("disabled",true);
							$('#div-subspesialis').hide(500);
						}
					}
					else
					{
						$('#spesialis').attr("disabled",true);
						$('#subspesialis').attr("disabled",true);
						$('#div-spesialis').hide(500);
						$('#div-subspesialis').hide(500);
					}
				},
				error: function () {
					callSwal('error','Gagal','Silahkan Coba Lagi',0);
				}
			});
		}
	});
</script>

@endsection