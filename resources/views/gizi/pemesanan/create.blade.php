@extends('gizi.layouts.form')

@section('title')
Medify - Gizi Pemesanan Baru
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Buat Pesanan Baru
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-md-6">
					<form action="{{url('gizi/pemesanan/simpan')}}" method="POST" id="form-buat">
						{{csrf_field()}}
						<div class="row">
							<div class="header col-12">
								<div class="col-lg-12 col-12">
								<h6 class="text-uppercase">Buat pesanan baru</h6>
								</div>
							</div>
							<div class="body col-12">
							<div class="col-lg-12 col-12">
								<div class="form-group">
									<label>Pasien</label>
									<select name="pasien" id="select-pasien" class="form-control js-select2" style="width: 100%;"
											data-size="5"  required>
										@if(!empty($data['kasus']))
											<option value="{{$data['kasus']->pasien->id}}" selected>{{$data['kasus']->pasien->name}}</option>
										@else
											<option value="" selected disabled>Pilih Pasien</option>
										@endif
									</select>
								</div>
								<div class="form-group">
									<label>Kasus Pasien</label>
									<select name="kasus_id" id="select-kasus" class="form-control js-select2"
											style="width: 100%;" data-size="5"  required>
										@if(!empty($data['kasus']))
											<option value="{{$data['kasus']->id}}" selected>
												{{$data['kasus']->lokasi->lokasi->nama}} - (Kelas {{$data['kasus']->kelas->nama}}) - {{$data['kasus']->judul_kasus}}
											</option>
										@else
											<option value="" selected disabled>Pilih Kasus</option>
											<option value=""></option>
										@endif
									</select>
								</div>
								<div class="form-group">
									<label>Jenis Makanan</label>
									<select name="jenis_makanan_id" class="form-control js-select2" style="width: 100%;">
										@foreach($data['jenis_makanan_utama'] as $jenis_makanan)
											<option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Diet</label>
									<select name="diet" id="select-diet" class="form-control js-select2" style="width: 100%;" required>
										<option value="" selected disabled>Pilih Diet</option>
										@foreach($data['diet'] as $diet)
										<option value="{{$diet->id}}">{{$diet->nama}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Makanan Tambahan</label>
									<select name="makanan_tambahan_ids[]" class="form-control js-select2" style="width: 100%;" data-placeholder="Pilih Makanan Tambahan" multiple>
										@foreach($data['jenis_makanan_tambahan'] as $jenis_makanan)
											<option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Jadwal Pengantaran</label>
									<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1"
										 data-autoclose="true" data-today-highlight="true">
										<input autocomplete="off" type="text" class="form-control"
											   id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1"
											   data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}" required>
										<div class="input-group-prepend input-group-append" id="config-jadwal-1" style="display: inline">
											<span class="input-group-text font-w600">to</span>
										</div>
										<input autocomplete="off" type="text" class="form-control"
											   name="daterange2" placeholder="To" data-week-start="1"
											   data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}" id="config-jadwal-2" style="display: inline" required>
									</div>
								</div>
								<hr>
								<div>
									<label>WAKTU MAKAN</label>
									<div class="row col-12">
										<div class="col-4">
											<div class="form-group">
											<div class="custom-control custom-checkbox mt-5">
												<input class="custom-control-input" type="checkbox" name="waktu_pagi"
													   id="waktu_pagi" value="1">
												<label class="custom-control-label" for="waktu_pagi">Makan Pagi</label>
											</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
											<div class="custom-control custom-checkbox mt-5">
												<input class="custom-control-input" type="checkbox" name="waktu_siang"
													   id="waktu_siang" value="1">
												<label class="custom-control-label" for="waktu_siang">Makan Siang</label>
											</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
											<div class="custom-control custom-checkbox mt-5">
												<input class="custom-control-input" type="checkbox" name="waktu_sore"
													   id="waktu_sore" value="1">
												<label class="custom-control-label" for="waktu_sore">Makan Sore</label>
											</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label>Catatan</label>
									<textarea class="form-control" placeholder="Catatan" name="catatan" id="catatan"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-hero btn-success btn-lg pull-left">Simpan</button>
								</div>
							</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">

$('#select-pasien').select2({
   ajax: {
       url: API_URL+"/pasien/get",
       dataType: 'json',
       delay: 250,
       data: function (params)
       {
           return {
               keyword: params.term,
               page: params.page
           };
       },
       processResults: function (data, params) {
           params.page = params.page || 1;
           return {
               results: data.data,
           };
       },
       cache: true
   },
   escapeMarkup: function (markup) { return markup; },
   minimumInputLength: 3,
   placeholder: "Cari Pasien",
   templateResult: formatPasien,
   templateSelection: formatPasienSelection
});

function formatPasien (item) {
   if (item.loading) {
       return item.text;
   }

   var markup = item.name;

   return markup;
}

function formatPasienSelection (item) {
   if(item.name) return item.name;
   else return item.text;
}


$('#select-pasien').on('select2:select', function (e) {
	var data = e.params.data;
	$.ajax({
		type: "POST",
		url: API_URL + "/gizi/pemesanan/getPembayaranPasien",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : data.id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].perusahaan.nama,
				});
			}
			$('#pasien-pembayaran').select2({
				data: option
			})
		}
	});
	$.ajax({
		url: API_URL + '/pasien/'+data.id+'/kasus',
		dataType: 'json',
		success: function(data){
			var option = [];
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].lokasi +' - (Kelas '+data[i].kelas+') - '+data[i].judul_kasus,
				});
			}
			$('#select-kasus').html('').select2({            data: option
			})
		}
	});
})

$(document).ready(function(){
    $("#select-pasien").change(function(){
      var pasien_id = $(this).val();
      $.ajax({
        url: API_URL + '/pasien/'+pasien_id+'/kasus',
        dataType: 'json',
        success: function(data){
          console.log(data)
          var kasus_current = $('#select-kasus').val();
          var option = [];

          for (i in data) {
            if(kasus_current != data[i].id)
            {
              option.push({
                id: data[i].id,
                text: data[i].lokasi +' - (Kelas '+data[i].kelas+') - '+data[i].judul_kasus,
              });
            }
          }
          $('#select-kasus').html('').select2({            data: option
          })
        }
      });
   	});
});

$('#pasien-pembayaran').select2();

$('#pasien-pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
	document.getElementById("perusahaan").value = data.perusahaan_keuangan_id;
})
</script>
@endsection