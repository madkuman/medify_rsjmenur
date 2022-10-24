@if(session('my_role_'.$kasus->nomor_kasus))
<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skor Norton Baru</button>
@endif
<h4>Norton</h4>
<hr>
@php $count = 1 @endphp
@forelse($norton as $item)

@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
	<i class="fa fa-trash"></i>
</button>
@endif

<h5 class="mb-5 pl-5">#Norton {{$count++}}</h5>
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
					<td>Kondisi Fisik</td>
					<td class="text-center">{{$item->fisik_text}}</td>
					<td class="text-center">{{$item->fisik}}</td>
				</tr>
				<tr>
					<td>Kesadaran</td>
					<td class="text-center">{{$item->kesadaran_text}}</td>
					<td class="text-center">{{$item->kesadaran}}</td>
				</tr>
				<tr>
					<td>Aktifitas</td>
					<td class="text-center">{{$item->aktifitas_text}}</td>
					<td class="text-center">{{$item->aktifitas}}</td>
				</tr>
				<tr>
					<td>Mobilitas</td>
					<td class="text-center">{{$item->mobilitas_text}}</td>
					<td class="text-center">{{$item->mobilitas}}</td>
				</tr>
				<tr>
					<td>Inkontines</td>
					<td class="text-center">{{$item->inkontines_text}}</td>
					<td class="text-center">{{$item->inkontines}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-4 text-center pt-10">
		<h3> Skor </h3>
		<h1 class="display-1">{{$item->score}}</h1>
		<h5 class="display-5">{{$item->score_text}}</h5>
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
	<h4 class="font-w400 mb-5">Belum ada hasil Norton Dekubitus tersedia</h4>
	<p>Klik tombol <b>Skor norton Baru</b> untuk melakukan penilaian Norton Dekubitus</p>
</div>

@endforelse