
@foreach($transaksies as $index => $transaksi)
@if(is_null($transaksi))
@continue
@endif
<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>No. RM : {{$kasus[$index]->pasien->no_rm ?? '-'}}</td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<td class="text-bold text-center" colspan="6" style="text-decoration: underline;">PERMINTAAN UNTUK OPNAME</td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
		<td width="20%">Nama</td>
		<td width="1%">:</td>
		<td width="">{{$kasus[$index]->pasien->name}}</td>
		<td width="17%">Tgl. Lahir/Umur</td>
		<td width="1%">:</td>
		<td width="26%">{{date('d-m-Y', strtotime($kasus[$index]->pasien->date_of_birth)) }}  / {{$kasus[$index]->pasien->detailed_age}}</td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td>{{$kasus[$index]->pasien->jenis_kelamin}}</td>
		<td>Agama</td>
		<td>:</td>
		<td>{{$kasus[$index]->pasien->agama->nama ?? '-'}}</td>
	</tr>
	<tr>
		<td>Kepala Keluarga</td>
		<td>:</td>
		<td colspan="3">{{$kk[$index]}}</td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>:</td>
		<td colspan="3">{{$kasus[$index]->pasien->job}}</td>
	</tr>
	<tr>
		<td>Pangkat</td>
		<td>:</td>
		<td>{{$kasus[$index]->pasien->tni_pangkat->nama ?? '-'}}</td>
		<td>NRP/NIP</td>
		<td>:</td>
		<td>{{$kasus[$index]->pasien->tni_nrp ?? '-'}}</td>
	</tr>
	<tr>
		<td>Kesatuan</td>
		<td>:</td>
		<td colspan="3">{{$kasus[$index]->pasien->tni_satker->nama ?? '-'}}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td colspan="3">{{$kasus[$index]->pasien->address ?? '-'}}</td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td>{{$transaksi->created_at->format('d - m - Y')}}</td>
		<td>Jam</td>
		<td>:</td>
		<td>{{$transaksi->created_at->format('H:i')}}</td>
	</tr>
	<tr>
		<td>Ruangan</td>
		<td>:</td>
		<td colspan="3"></td>
	</tr>
	<tr>
		<td>Diagnosa</td>
		<td>:</td>
		<td colspan="3">
			{{$diagnosis[$index]}}
		</td>
	</tr>
	<tr>
		<td>DPJP (Dokter Penanggung jawab pelayanan)</td>
		<td>:</td>
		<td colspan="3">{{$dpjp->name ?? ''}}</td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<td width="5%">&nbsp;</td>
		<td width="50.4%">Catatan :</td>
		<td width="9.6%"></td>
		<td width="30%" class="text-center">Dokter yang memeriksa</td>
		<td width="5%">&nbsp;</td>
	</tr>
	<tr>
		<td width="5%">&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td width="5%">&nbsp;</td>
		<td>Dengan surat ini menuju ke registrasi rawat inap</td>
		<td></td>
		@if(!empty($creator->ttd))
		<td class="text-center"><img src="{{url('')}}/{{$creator->ttd}}" height="100px"></td>
		@else
		<td></td>
		@endif
		<td></td>
	</tr>
	<tr>
		<td width="5%">&nbsp;</td>
		<td></td>
		<td></td>
		<td class="text-center">{{$creator->name ?? ''}}</td>
		<td></td>
	</tr>
</table>

@if(!$loop->last)
<div style="page-break-after: always;"></div>
@endif
@endforeach