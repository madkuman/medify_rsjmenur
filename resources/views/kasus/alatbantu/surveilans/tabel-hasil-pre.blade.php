@php $count = 1; $item_size = count($pre); @endphp
@forelse($pre as $key => $item)
@if(session('my_role_'.$kasus->nomor_kasus))
<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
	<i class="fa fa-trash"></i>
</button>
<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right editPreBtn" data-id="{{$item->id}}">
	<i class="fa fa-pencil"></i>
</button>
@endif
@php $res = json_decode($item->val) @endphp
<div class="row">
	<div class="col-md-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th class="text-center">Pre - Ops</th>
				</tr>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="text-center" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Suhu Pasien</td>
					<td class="text-center">{{$res->suhu}}</td>
				</tr>
				<tr>
					<td>Merokok</td>
					<td class="text-center">{{$res->merokok}}</td>
				</tr>
				<tr>
					<td>Screening MRSA</td>
					<td class="text-center">{{$res->mrsa}}</td>
				</tr>
				<tr>
					<td>Albumin</td>
					<td class="text-center">{{$res->albumin ?? '-'}}</td>
				</tr>
				<tr>
					<td>Gula darah</td>
					<td class="text-center">{{$res->gula_darah}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : DM</td>
					<td class="text-center">{{!empty($res->dm) ? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : GGK</td>
					<td class="text-center">{{!empty($res->ggk)? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : Sepsis</td>
					<td class="text-center">{{!empty($res->sepsis) ? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : Hipertensi</td>
					<td class="text-center">{{!empty($res->hipertensi) ? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : NA</td>
					<td class="text-center">{{!empty($res->na) ? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Saat ini : Penyakit lain-lain</td>
					<td class="text-center">{{$res->penyakit_lain2 ?? '-'}}</td>
				</tr>
				<tr>
					<td>Pencukuran</td>
					<td class="text-center">{{$res->pencukuran}}</td>
				</tr>
				<tr>
					<td>Waktu Pencukuran</td>
					<td class="text-center">{{$res->waktu_cukur ?? '-'}}</td>
				</tr>
				<tr>
					<td>Mechanical Bowel</td>
					<td class="text-center">{{$res->bowel}}</td>
				</tr>
				<tr>
					<td>Steroid Jangka Panjang</td>
					<td class="text-center">{{$res->steroid}}</td>
				</tr>
				<tr>
					<td>Radioterapi Sebelumnya</td>
					<td class="text-center">{{$res->radioterapi}}</td>
				</tr>
				<tr>
					<td>Mandi Sebelum Operasi</td>
					<td class="text-center">{{$res->mandi}}</td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi Kulit</td>
					<td class="text-center">{{!empty($res->kulit) ? 'Ya' : 'Tidak'}}</td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi Mulut / Gigi</td>
					<td class="text-center">{{!empty($res->mulut)? 'Ya' : 'Tidak'}} </td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi Mata</td>
					<td class="text-center">{{!empty($res->mata) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi THT</td>
					<td class="text-center">{{!empty($res->tht) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi Paru</td>
					<td class="text-center">{{!empty($res->paru) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Infeksi GI tract</td>
					<td class="text-center">{{!empty($res->gi_tract)? 'Ya' : 'Tidak' }} </td>
				</tr>
				<tr>
					<td>Penyakit Infeksi : Lain-lain</td>
					<td class="text-center">{{$res->infeksi_lain2 ?? '-'}}</td>
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
	<h4 class="font-w400 mb-5">Belum ada asesmen Surveilans Infeksi Luka Operasi tersedia</h4>
	<p>Klik tombol <b>Surveilans Infeksi Luka Operasi Baru</b> untuk melakukan asesmen Surveilans Infeksi Luka Operasi</p>
</div>

@endforelse