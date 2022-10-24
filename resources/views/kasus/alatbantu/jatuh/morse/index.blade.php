@php $count = 1 @endphp
@forelse($morse as $item)

@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteMorseBtn" data-id="{{$item->id}}">
	<i class="fa fa-trash"></i>
</button>
@endif
<button type="button" class="btn btn-sm btn-rounded btn-alt-success min-width-125 mr-10 float-right tatalaksana-morse-btn" data-id="{{$item->id}}" data-tatalaksana="{{$item->tatalaksana}}" data-score="{{$item->score}}" id="tatalaksana-btn-morse-{{$item->id}}">
	@if(empty($item->tatalaksana))<i class="fa fa-plus"></i> Isi Tatalaksana
	@else <i class="fa fa-search-plus"></i> Lihat Tatalaksana
	@endif
</button>

<h5 class="mb-5 pl-5">#Morse Fall {{$count++}}</h5>
<div class="row">
	<div class="col-md-8">
		<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:40%">Parameter</th>
					<th class="text-center" style="width: 35%;">Penilaian</th>
					<th class="text-center" style="width: 25%;">Skor</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>History of falling ( &lt;3 months)</td>
					<td class="text-center">{{$item->jatuh_text}}</td>
					<td class="text-center">{{$item->jatuh}}</td>
				</tr>
				<tr>
					<td>Secondary diagnosis</td>
					<td class="text-center">{{$item->diagnosis_text}}</td>
					<td class="text-center">{{$item->diagnosis}}</td>
				</tr>
				<tr>
					<td>Ambulatory aid</td>
					<td class="text-center">{{$item->ambulatory_text}}</td>
					<td class="text-center">{{$item->ambulatory}}</td>
				</tr>
				<tr>
					<td>IV/Heparin lock</td>
					<td class="text-center">{{$item->iv_text}}</td>
					<td class="text-center">{{$item->iv}}</td>
				</tr>
				<tr>
					<td>Gait/Transfering</td>
					<td class="text-center">{{$item->gait_text}}</td>
					<td class="text-center">{{$item->gait}}</td>
				</tr>
				<tr>
					<td>Mental status</td>
					<td class="text-center">{{$item->mental_text}}</td>
					<td class="text-center">{{$item->mental}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-4 text-center pt-20">
		<h3> Skor </h3>
		<h1 class="display-1">{{$item->score}}</h1>

		<h3 class="text-center font-w400">
			@if($item->score < 24)
			<small>Risiko Jatuh Rendah</small>
			@elseif($item->score < 50)
			<small>Risiko Jatuh Sedang</small>
			@else
			<small>Risiko Jatuh Tinggi</small>
			@endif
		</h3>
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
	<h4 class="font-w400 mb-5">Belum ada hasil Morse Fall tersedia</h4>
	<p>Klik tombol <b>Skor morse Baru</b> untuk melakukan penilaian Morse Fall</p>
</div>

@endforelse

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/morse/delete" id="formDeleteMorse">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputIdMorse">
	
</form>