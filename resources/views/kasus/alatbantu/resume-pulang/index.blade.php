@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Resume Pasien Pulang Ranap - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Resume Pasien Pulang Ranap Baru</button>
						@endif
						<h4>Resume Pasien Pulang Ranap</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($resume_pulang as $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-val="{{$item->val}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<button class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right print-btn" data-toggle="modal" data-target="#modal-ttd" data-resume-id="{{$item->id}}">
							<i class="fa fa-print"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Resume Pasien Pulang Ranap {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="patograf-{{$item->id}}">
							@include('kasus.alatbantu.resume-pulang.tabel-hasil')
						</div>
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date('d F y, H:i', strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Resume Pasien Pulang Ranap tersedia</h4>
							<p>Klik tombol <b>Resume Pasien Pulang Ranap Baru</b> untuk melakukan asesmen Resume Pasien Pulang Ranap</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>

	<div class="modal fade" id="modal-ttd" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md" role="document">
			<div class="modal-content">
				<div class="block block-transparent mb-0">
					<div class="block-content row py-20">
						<h4 class="col-md-12 mb-0">
							Pilih TTD
						</h4>
							<form method="GET"  class="col-md-12" action="{{url()->current()}}/print" target="_blank">
							<input type="hidden" id="print-id" name="id" value="">
							<h6 class="font-size-s font-w400 mt-5">Pilih TTD untuk Print Resume Pasien Pulang</h6>
							<hr style="border-top: 2px solid #0b72c6">
							<div class="my-15">
								<div class="form-group row">
									<label class="col-12" for="example-datepicker1">TTD Dokter/Perawat</label>
									<select class="js-select2 form-control col-6" id="ttd2" name="ttd2" style="width: 100%;" data-placeholder="Pilih TTD Dokter/Perawat" required>
										<option></option>
                                         @foreach($dokter as $key => $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
									</select>
								</div>

								<div class="form-group row">
									<label class="col-12" for="example-datepicker1">TTD Penerima Resume</label>
									<input type="text" name="keluarga" class="form-control">
								</div>
							</div>
							<button type="submit" id="submitprint" class="btn btn-xs btn-primary float-right">
								<i class="fa fa-print"></i> Print
							</button>
							<button type="button" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
								Batal
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/resume-pulang/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.resume-pulang.add')
@endsection

@section('js')
@include('kasus.alatbantu.resume-pulang.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});
	$(".editBtn").click(function(e){
		id = $(this).data('id');
		var data = $(this).data('val');
		if(data != ""){
			$("#id").val(id);
			$("#suhu").val(data.suhu);
			$("#nadi").val(data.nadi);
			$("#rr").val(data.rr);
			$("#td").val(data.td);
			if (data.oral) $("#oral").prop('checked', true);
			if (data.ngt) $("#ngt").prop('checked', true);
			$("#diet_khusus").val(data.diet_khusus);
			$("#batasan_cairan").val(data.batasan_cairan);
			$("#bab").val(data.bab).change();
			$("#bak").val(data.bak).change();
			$("#kateter").val(data.kateter);
			if (data.luka) {
				var luka = data.luka.split(",");
				luka.forEach(function(value) {
					$(".luka[value=" + value + "]").prop('checked', true);
				});
			}
			$("#cairan_luka").val(data.cairan_luka);
			$("#transfer").val(data.transfer).change();
			$("#alat_bantu").val(data.alat_bantu).change();
			$("#uterus").val(data.uterus).change();
			$("#fundus_uteri").val(data.fundus_uteri);
			$("#vulva").val(data.vulva).change();
			$("#lochea").val(data.lochea).change();
			$("#warna").val(data.warna);
			$("#bau").val(data.bau);
			if (data.penyakit) $("#penyakit").prop('checked', true);
			if (data.mengatasi_nyeri) $("#mengatasi_nyeri").prop('checked', true);
			if (data.persiapan_lingkungan) $("#persiapan_lingkungan").prop('checked', true);
			if (data.perawatan_rumah) $("#perawatan_rumah").prop('checked', true);
			if (data.perawatan_luka) $("#perawatan_luka").prop('checked', true);
			if (data.perawatan_ibu) $("#perawatan_ibu").prop('checked', true);
			if (data.nasehat) $("#nasehat").prop('checked', true);
			$("#diagnosa_keperawatan").val(data.diagnosa_keperawatan);
			$("#anjuran_keperawatan").val(data.anjuran_keperawatan);
			$("#obat_diminum").val(data.obat_diminum);
			$("#efek_samping").val(data.efek_samping);
			$("#nyeri_bertambah").val(data.nyeri_bertambah);
			$("#hasil_laborat").val(data.hasil_laborat);
			$("#rontgen").val(data.rontgen);
			$("#ct_scan").val(data.ct_scan);
			$("#mri").val(data.mri);
			$("#usg").val(data.usg);
			$("#sk_sakit").val(data.sk_sakit);
			if (data.asuransi) $("#asuransi").prop('checked', true);
			if (data.resume) $("#resume").prop('checked', true);
			if (data.buku_bayi) $("#buku_bayi").prop('checked', true);
			if (data.kartu_goldar) $("#kartu_goldar").prop('checked', true);
			if (data.sk_lahir) $("#sk_lahir").prop('checked', true);
			$("#barang_lain2").val(data.barang_lain2);
			$("#obat_dibawa").val(data.obat_dibawa);
			$("#bayi_diserahkan").val(data.bayi_diserahkan);
			$("#tgl_kontrol").val(data.tgl_kontrol);
			$("#jam_kontrol").val(data.jam_kontrol);
			$("#klinik").val(data.klinik);
			$("#bagian").val(data.bagian);
		}
		$('#addModal').modal('toggle');
	});

	$('.print-btn').click(function(e){
		var id = $(this).data('resume-id');
		$('#print-id').val(id);
	})
	$('#submitprint').on('click', function(e){
		if($('#ttd2').val() != ""  && $('#ttd2').val() != null){
	        var form = $(this).parents('form');
			form.unbind('submit').submit();
		}else{
			e.preventDefault();
		}
	});
</script>
@endsection