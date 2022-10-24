@php $count = 1 @endphp
@forelse($humpty_dumpty as $item)

@if(session('my_role_'.$kasus->nomor_kasus))
@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
<button class="btn btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteHumptyBtn" data-id="{{$item->id}}">
	<i class="fa fa-trash"></i>
</button>
<button type="button" class="btn btn-sm btn-rounded btn-alt-success min-width-125 float-right mr-10 modalTataLaksana" data-id="{{$item->id}}" data-score="{{$item->score}}" data-tatalaksana="{{$item->tatalaksana}}" id="tatalaksana-btn-humpty-{{$item->id}}">
	@if(empty($item->tatalaksana))<i class="fa fa-plus"></i> Isi Tatalaksana
	@else <i class="fa fa-search-plus"></i> Lihat Tatalaksana
	@endif
</button>
@endif
@endif

<h5 class="mb-5 pl-5">#Humpty Dumpty {{$count++}}</h5>
<div class="row">
	<div class="col-md-8">
		<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:25%">Parameter</th>
					<th class="text-center" style="width: 50%;">Penilaian</th>
					<th class="text-center" style="width: 25%;">Skor</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Usia</td>
					<td class="text-center">{{$item->usia_text}}</td>
					<td class="text-center">{{$item->usia}}</td>
				</tr>
				<tr>
					<td>Jenis kelamin</td>
					<td class="text-center">{{$item->jenis_kelamin_text}}</td>
					<td class="text-center">{{$item->jenis_kelamin}}</td>
				</tr>
				<tr>
					<td>Diagnosis</td>
					<td class="text-center">{{$item->diagnosis_text}}</td>
					<td class="text-center">{{$item->diagnosis}}</td>
				</tr>
				<tr>
					<td>Gangguan kognitif</td>
					<td class="text-center">{{$item->gangguan_kognitif_text}}</td>
					<td class="text-center">{{$item->gangguan_kognitif}}</td>
				</tr>
				<tr>
					<td>Faktor lingkungan</td>
					<td class="text-center">{{$item->faktor_lingkungan_text}}</td>
					<td class="text-center">{{$item->faktor_lingkungan}}</td>
				</tr>
				<tr>
					<td>Respons terhadap pembedahan/sedasi/anastesi</td>
					<td class="text-center">{{$item->respons_text}}</td>
					<td class="text-center">{{$item->respons}}</td>
				</tr>
				<tr>
					<td>Penggunaan medikamentosa</td>
					<td class="text-center">{{$item->penggunaan_medik_text}}</td>
					<td class="text-center">{{$item->penggunaan_medik}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-4 text-center pt-50">
		<h3> Skor </h3>
		<h1 class="display-1">{{$item->score}}</h1>
		<h4>
			@if($item->score < 12) <strong>Risiko Rendah</strong>
			@else <strong>Risiko Tinggi</strong>
			@endif
		</h4>
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
	<h4 class="font-w400 mb-5">Belum ada Humpty Dumpty</h4><br>
	<p>Klik tombol <b>Skor Humpty Dumpty Baru</b> untuk melakukan penilaian humpty dumpty</p>
</div>

@endforelse

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/humpty-dumpty/delete" id="formDeleteHumpty">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputIdHumpty">
</form>