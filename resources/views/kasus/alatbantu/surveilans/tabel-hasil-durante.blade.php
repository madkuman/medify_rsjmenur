
@forelse($durante as $key => $item)

@if(session('my_role_'.$kasus->nomor_kasus))
<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
	<i class="fa fa-trash"></i>
</button>
<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right editDuranteBtn" data-id="{{$item->id}}">
	<i class="fa fa-pencil"></i>
</button>
@endif
@php $res = json_decode($item->val) @endphp
<div class="row">
	<div class="col-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="text-center" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Tanggal MRS</td>
					<td class="text-center">{{$res->tgl_mrs ?? '-'}}</td>
				</tr>
				<tr>
					<td>Tanggal Operasi</td>
					<td class="text-center">{{$res->tgl_operasi ?? '-'}}</td>
				</tr>
				<tr>
					<td>Lama Operasi</td>
					<td class="text-center">{{$res->lama_operasi ?? '-'}}</td>
				</tr>
				<tr>
					<td>Jenis Operasi</td>
					<td class="text-center">{{$res->jenis_operasi}}</td>
				</tr>
				<tr>
					<td>Operasi Karena Trauma</td>
					<td class="text-center">{{$res->operasi_trauma}}</td>
				</tr>
				<tr>
					<td>Ruang Operasi</td>
					<td class="text-center">{{$res->ruang}}</td>
				</tr>
				<tr>
					<td>Berat Badan</td>
					<td class="text-center">{{$res->bb ?? '-'}} kg</td>
				</tr>
				<tr>
					<td>Kualifikasi Dokter Bedah</td>
					<td class="text-center">{{$res->kualifikasi}} @if($res->kualifikasi == 'Lain-lain')({{$res->kualifikasi_lain2}})@endif</td>
				</tr>
				<tr>
					<td>Prosedur Operasi</td>
					<td class="text-center">{{$res->prosedur}} @if($res->prosedur == 'Lain-lain')({{$res->prosedur_lain2}})@endif</td>
				</tr>
				<tr>
					<td>Diagnosa</td>
					<td class="text-center">{{$res->diagnosa ?? '-'}}</td>
				</tr>
				<tr>
					<td>Multiprosedur dengan insisi yang sama</td>
					<td class="text-center">{{$res->multiprosedur}}</td>
				</tr>
				<tr>
					<td>Klasifikasi Luka</td>
					<td class="text-center">{{$res->klasifikasi}}</td>
				</tr>
				<tr>
					<td>ASA Scoring</td>
					<td class="text-center">{{$res->asa_scoring}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-6">

		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="text-center" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Sirkulasi Udara</td>
					<td class="text-center">{{$res->sirkulasi ?? '-'}}</td>
				</tr>
				<tr>
					<td>Air Count OT</td>
					<td class="text-center">{{$res->air_count ?? '-'}}</td>
				</tr>
				<tr>
					<td>Kelembaban Ruang OT</td>
					<td class="text-center">{{$res->kelembaban ?? '-'}}</td>
				</tr>
				<tr>
					<td>Tekanan Udara</td>
					<td class="text-center">{{$res->tekanan}}</td>
				</tr>
				<tr>
					<td>Jamur AC</td>
					<td class="text-center">{{$res->jamur}}</td>
				</tr>
				<tr>
					<td>Drain</td>
					<td class="text-center">{{$res->drain}}</td>
				</tr>
				<tr>
					<td>Jenis Drain (apabila menggunakan)</td>
					<td class="text-center">{{$res->jenis_drain ?? '-'}}</td>
				</tr>
				<tr>
					<td>Suhu Ruang</td>
					<td class="text-center">{{$res->suhu_ruang ?? '-'}} &#176;C</td>
				</tr>
				<tr>
					<td>Implant</td>
					<td class="text-center">{{$res->implant}}</td>
				</tr>
				<tr>
					<td>Jenis Implant (apabila menggunakan)</td>
					<td class="text-center">{{$res->jenis_implant ?? '-'}}</td>
				</tr>
				<tr>
					<td>Sterilisasi CSSD</td>
					<td class="text-center">{{$res->cssd}}</td>
				</tr>
				<tr>
					<td>Antibiotik Tambahan</td>
					<td class="text-center">{{$res->antibiotik}}</td>
				</tr>
				<tr>
					<td>Antibiotik Tambahan Saat Op (apabila diberikan)</td>
					<td class="text-center">{{$res->obat_antibiotik ?? '-'}}</td>
				</tr>
				<tr>
					<td>Dosis</td>
					<td class="text-center">{{$res->dosis_antibiotik ?? '-'}}</td>
				</tr>
				<tr>
					<td>Diberikan jam</td>
					<td class="text-center">{{$res->jam_antibiotik ?? '-'}}</td>
				</tr>
				<tr>
					<td>Disinfeksi Kulit : Chlorhexidine</td>
					<td class="text-center">{{!empty($res->chlorhexidine) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Disinfeksi Kulit : Povidone Iodine</td>
					<td class="text-center">{{!empty($res->povidone_iodine) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Disinfeksi Kulit : Alkohol 70%</td>
					<td class="text-center">{{!empty($res->alkohol_70) ? 'Ya' : 'Tidak' }}</td>
				</tr>
				<tr>
					<td>Disinfeksi Kulit : Lain-lain</td>
					<td class="text-center">{{$res->disinfeksi_lain ?? '-'}}</td>
				</tr>
				<tr>
					<td>Jumlah Staff</td>
					<td class="text-center">{{$res->staff ?? '-'}}</td>
				</tr>
				<tr>
					<td>Indikator Instrumen / Alat Steril</td>
					<td class="text-center">{{$res->instrumen ?? '-'}}</td>
				</tr>
				<tr>
					<td>Profilaksis</td>
					<td class="text-center">{{$res->profilaksis ?? '-'}}</td>
				</tr>
				<tr>
					<td>Obat Profilaksis (apabila diberikan)</td>
					<td class="text-center">{{$res->obat_profilaksis ?? '-'}}</td>
				</tr>
				<tr>
					<td>Dosis</td>
					<td class="text-center">{{$res->dosis_profilaksis ?? '-'}}</td>
				</tr>
				<tr>
					<td>Diberikan jam</td>
					<td class="text-center">{{$res->jam_profilaksis ?? '-'}}</td>
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
@endforelse