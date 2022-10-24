@foreach($kelahiran as $k)
	<table>
		<tr>
			<td width="50%" class="centered"></td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td class="centered border-bot">{{config('app.name')}}</td>
			<td class="righted">DRM : 27</td>
		</tr>
		<tr>
			<td></td>
			<td class="righted">Nomor : {{$k['ket']->no_pastur}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title">SURAT KETERANGAN KELAHIRAN</td>
		</tr>
	</table>
	<br>
	<table class="gap-col">
		<tr>
			<td width="25%">Nama</td>
			<td width="45%">: {{$k['nama']}}</td>
			<td width="10%">Usia Ibu</td>
			<td width="20%">: {{$k['usia_ibu']}} tahun</td>
		</tr>
		<tr>
			<td>Istri Dari</td>
			<td>: {{$k['suami']}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Pangkat/NRP/NIP</td>
			<td>: {{$k['ket']->pangkat}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>: {{$k['ket']->kesatuan}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Telah melahirkan anak</td>
			<td>: {{$k['kelamin']}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{indonesian_date($k['ket']->tanggal)}}</td>
			<td>Jam</td>
			<td>: {{$k['ket']->jam}}</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp; {{config('app.name')}}</td>
			<td></td><td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%"></td>
			<td width="20%"></td>
			<td width="40%">Surabaya,{{indonesian_date(time('d m Y'))}}</td>
		</tr>
		<tr>
			<td class="centered">Mengetahui :</td>
			<td></td>
			<td class="centered">Yang Menolong</td>
		</tr>
		<tr>
			<td class="centered">Dokter</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">&nbsp;</td>
		</tr>
		<tr>
			<td class="centered">{{!empty($k['ket']->dokter->name) ? $k['ket']->dokter->name : ''}}</td>
			<td></td>
			<td class="centered">{{!empty($k['ket']->perawat->name) ? $k['ket']->perawat->name : ''}}</td>
		</tr>
	</table>
	<div class="centered my-50">
		- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	</div>


	<table>
		<tr>
			<td width="50%" class="centered"></td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td class="centered border-bot">{{config('app.name')}}</td>
			<td class="righted">DRM : 27</td>
		</tr>
		<tr>
			<td></td>
			<td class="righted">Nomor : {{$k['ket']->no_pastur}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title">SURAT KETERANGAN KELAHIRAN</td>
		</tr>
	</table>
	<br>
	<table class="gap-col">
		<tr>
			<td width="25%">Nama</td>
			<td width="45%">: {{$k['nama']}}</td>
			<td width="10%">Usia Ibu</td>
			<td width="20%">: {{$k['usia_ibu']}} tahun</td>
		</tr>
		<tr>
			<td>Istri Dari</td>
			<td>: {{$k['suami']}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Pangkat/NRP/NIP</td>
			<td>: {{$k['ket']->pangkat}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>: {{$k['ket']->kesatuan}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Telah melahirkan anak</td>
			<td>: {{$k['kelamin']}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{indonesian_date($k['ket']->tanggal)}}</td>
			<td>Jam</td>
			<td>: {{$k['ket']->jam}}</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp; {{config('app.name')}}</td>
			<td></td><td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%"></td>
			<td width="20%"></td>
			<td width="40%">Surabaya,{{indonesian_date(time('d m Y'))}}</td>
		</tr>
		<tr>
			<td class="centered">Mengetahui :</td>
			<td></td>
			<td class="centered">Yang Menolong</td>
		</tr>
		<tr>
			<td class="centered">Dokter</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">&nbsp;</td>
		</tr>
		<tr>
			<td class="centered">{{!empty($k['ket']->dokter->name) ? $k['ket']->dokter->name : ''}}</td>
			<td></td>
			<td class="centered">{{!empty($k['ket']->perawat->name) ? $k['ket']->perawat->name : ''}}</td>
		</tr>
	</table>
    @if(!$loop->last)
    <div style="page-break-after: always;"></div>
    @endif
@endforeach