@extends('igd.layouts.main')

@section('title')
Pengaturan - IGD - Medify
@endsection

@section('subtitle')
Buat Ruangan Baru - IGD
@endsection

@section('content')


<main id="main-container">
	@include('igd.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block text-center pb-100">
					<div class="row px-30">
						<div class="block-content block-content text-left">
							<h4>Buat Ruangan Baru IGD</h4>
							<hr>
							<button class="btn-outline-danger btn pull-right" id="hapus"> <i class="fa fa-trash-o"></i> Hapus Ruangan </button>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-6">
							<form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group text-left">
									<label for="nama-ruangan">Nama Ruangan</label>
									<input type="text" class="form-control" id="nama-ruangan" name="name" placeholder="Nama ruangan" value="{{$ruangan->name}}" required>
								</div>
								<div class="form-group text-left">
									<label for="level-ruangan">Level</label>
									<select class="form-control" style="width: 100%;" id="level-ruangan" name="level" required="required">
										@for ($i = 1; $i <= 5; $i++)
											@if($ruangan->level==$i)
									        <option value="{{ $i }}" selected="selected">{{ $i }}</option>
									        @else
									        <option value="{{ $i }}">{{ $i }}</option>
									        @endif
									    @endfor
		                            </select>
								</div>
								<div class="form-group text-left">
									<label for="cap-ruangan">Kapasitas</label>
									<input type="number" class="form-control" id="cap-ruangan" name="kapasitas" placeholder="Kapasitas ruangan dalam angka"  value="{{$ruangan->kapasitas}}" required>
								</div>
								<div class="form-group text-left">
									<label>SIRS COVID 19 - Tipe Ruangan <i class="fa fa-asterisk fa-spin text-info" id="loading_kelas_sirs_covid_19"></i></label>
									<select class="js-select2 form-control" id="sirs-covid-19-tipe-ruangan" name="sirs_covid_19_tt_id" style="width: 100%;" data-placeholder="Pilih Tipe Ruangan"  value="{{$ruangan->sirs_covid_19_tt_id}}">
										<option></option>
									</select>
									<p class="text-danger teksWarning" id="kelasWarn" style="display: none; margin-bottom: 8px;"></p>
								</div>
								<div class="row justify-content-center">
									<div class="col-md-12">
										<button class="btn btn-primary btn-hero pull-right">Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>

					
				</div>

			</div>
		</div>
	</div>
</main>


<form method="POST" action="{{url('igd/pengaturan/ruangan/delete')}}/{{$ruangan->id}}" id="formDelete">
	{{csrf_field()}}
</form>


@endsection

@section('js')
<script type="text/javascript">
	$('document').ready(function() {
		$('#hapus').on('click', function() {
			swal({
				title: "Apa anda yakin ?",
				text: "Data mengenai ruangan ini akan menghilang",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-default',
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					$('#formDelete').submit();
				}
			})
		})

		getSIRSCovid19TipeRuangan();
	});

	function getSIRSCovid19TipeRuangan(){
        $('#loading_kelas_sirs_covid_19').show();
        $.ajax({
            type: "GET",
            url: API_URL + "/third-party/sirs-covid-19/rawatinap/get",
            cache: false,
            contentType: false,
            processData: false,
            tryCount : 0,
            retryLimit : 3,
            success: function(response) {
                var res = JSON.parse(response);
                $('#sirs-covid-19-tipe-ruangan').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                if(res == undefined)
                    return;
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].id_tt,
                        text: res[i].tt
                    });
                }
                $('#sirs-covid-19-tipe-ruangan').select2({
                    data : option
                });
                @if(isset($ruangan->sirs_covid_19_tt_id))
                $('#sirs-covid-19-tipe-ruangan').val("{{$ruangan->sirs_covid_19_tt_id}}").trigger('change');
                @endif
                $('#loading_kelas_sirs_covid_19').hide();
            },
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }            
                    return;
                }
                if (xhr.status == 500) {
                    $('#loading_kelas_sirs_covid_19').hide();
                } else {
                    $('#loading_kelas_sirs_covid_19').hide();
                }
            }
        });
    }
</script>
@endsection