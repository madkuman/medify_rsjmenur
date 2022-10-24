@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Keterangan Kelahiran - Kasus
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Buat Keterangan Kelahiran</button>
						@endif
						@php $count = 1 @endphp
						@forelse($ket as $item)
						
						<button class="btn btn-circle btn-outline-primary mr-5 mb-5 pull-right printBtn" data-id="{{$item->id}}">
							<i class="fa fa-print"></i>
						</button>
						
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button class="btn btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif

						<h5 class="mb-5 pl-5">#Keterangan Kelahiran {{$count++}}</h5>
	                    <div class="row">
	                        <div class="col-md-8">
	                            <table class="table table-sm table-borderless table-vcenter" style="width: 100%">
	                                <thead>
	                                    <tr>
	                                        <th style="width:25%">Keterangan</th>
	                                        <th class="text-center" style="width: 50%;">Isi</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    <tr>
	                                        <td>Nama Ibu</td>
	                                        <td class="text-center">{{$item->nama_ibu or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Nama Ayah</td>
	                                        <td class="text-center">{{$item->nama_ayah or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Pangkat</td>
	                                        <td class="text-center">{{$item->pangkat or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Kesatuan</td>
	                                        <td class="text-center">{{$item->kesatuan or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Jenis Kelamin</td>
	                                        <td class="text-center">{{$item->kelamin_text or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>No Partus</td>
	                                        <td class="text-center">{{$item->no_pastur or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Tanggal Partus</td>
	                                        <td class="text-center">{{$item->tanggal_pastur or '-'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Dokter</td>
	                                        <td class="text-center">{{$item->dokter->name ?? 'Tidak ada'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Penolong</td>
	                                        <td class="text-center">{{$item->perawat->name ?? 'Tidak ada'}}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Tanggal & Jam</td>
	                                        <td class="text-center">{{$item->tanggal_text}} {{$item->jam}}</td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
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
	                        <h4 class="font-w400 mb-5">Belum ada Keterangan Kelahiran</h4><br>
	                        <p>Klik tombol <b>Keterangan Kelahiran Baru</b> untuk menambahkan keterangan kelahiran</p>
	                    </div>

	                    @endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/ket-kelahiran/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.ket-kelahiran.add')
<!-- END Main Container -->    
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});
	});
	$('.printBtn').on('click', function(){
		var id = $(this).data('id');
		printKelahiran(id);
	});
	function printKelahiran(id)
	{   
		window.open(
			"{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/ket-kelahiran/print/"+id,"popUpWindow",
			"height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
	}
</script>
@endsection