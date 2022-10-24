<div class="block-content">
	<a type="btn" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/ringkasan-pasien-masuk-dan-keluar/print" class="btn btn-secondary min-width-125 float-right mr-5" target="_blank">
		<i class="fa fa-print"></i> Print
	</a>
	<h4>Ringkasan Pasien Masuk dan Keluar</h4>
	<hr>
	
	<table width="100%">
		<tr>
			<td width="25%"></td>
			<td width="2%"></td>
			<td width="73%"></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Dirawat yang ke</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{array_search($kasus->id ,$dirawat_ke)+1}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Ruang</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{$kasus->lokasi->lokasi->nama}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kelas</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{$kasus->kelas->nama}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pengirim Rujukan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom"></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Nama Pengirim Rujukan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom"></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kasus Visum</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{$visum == '1' ? '✔️' : '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">DPJP</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{$kasus->dpjp->user->name}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Case Manager</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom"></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lama Dirawat</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{{$kasus->ranap_los ?? '1'}} hari</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Masuk</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">({{$kasus->diagnosisUtama->icd10->code_icd}}) - {{$kasus->diagnosisUtama->icd10->long_desc}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Masuk Tambahan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{!! nl2br($diagnosaAll) !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Keluar</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">({{$kasus->diagnosisUtama->icd10->code_icd}}) - {{$kasus->diagnosisUtama->icd10->long_desc}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Keluar Tambahan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{!! nl2br($diagnosaAll) !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tindakan yang dilakukan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">{!! nl2br($tindakanAll) !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Keadaan Keluar</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">
				@if(!empty($kasus->krs_at))
				{{$kasus->status_krs->nama}}
				@if($kasus->status_krs->nama =='Meninggal')
				- Waktu Meninggal {{date('d F Y, H:i', strtotime($kasus->pasien->death_at))}}
				@endif
				@else
				Pasien Belum KRS
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Rujuk ke</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">
				@if(!empty($kasus->krs_at))
				-
				@else
				Pasien Belum KRS
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Cara keluar</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">
				@if(!empty($kasus->krs_at))
				{{$kasus->krs_alasan}} 
				@if(!empty($kasus->krs_keterangan)) 
				- {{$kasus->krs_keterangan}} 
				@endif
				@else
				Pasien Belum KRS
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Alergi</h6></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Obat obatan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">
				@forelse($identitas->alergi_obat_array as $item)
				- {{$item}}<br>
				@empty
				Tidak memiliki alergi
				@endforelse
			</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Makanan</td>
			<td class="align-top border-bottom">:</td>
			<td class="align-top border-bottom">
				@forelse($identitas->alergi_makanan_array as $item2)
				- {{$item2}}<br>
				@empty
				Tidak memiliki alergi
				@endforelse
			</td>
		</tr>
	</table>
</div>