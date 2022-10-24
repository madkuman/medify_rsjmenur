
@if(session('my_role_'.$kasus->nomor_kasus))
<div class="btn-group pull-right" role="group">
	<button type="button" class="btn btn-secondary dropdown-toggle " id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fa fa-ellipsis-v"></i> Menu
	</button>
	<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
		<a  href="javascript:void(0)" class="dropdown-item btn-add-bayi" data-parentid="{{$bayi->parent_id}}" data-id="{{$bayi->id}}" data-val="{{$bayi->val}}">
			<i class="fa fa-pencil"></i> Edit
		</a>
		<a href="javascript:void(0)" class="dropdown-item deleteBtn" data-id="{{$bayi->id}}">
			<i class="fa fa-trash"></i> Hapus
		</a>
	</div>
</div>
@endif

<h5>Anak {{$loop->iteration}}</h5>
<div class="row">
	<div class="col-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table-warning">
					<th colspan="2">Data Bayi</th>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td class="text-center">{{$bayi_data->jenis_kelamin or '-'}}</td>
				</tr>
				<tr>
					<td>Lahir Hidup/Mati</td>
					<td class="text-center">{{$bayi_data->lahir_hidup_mati or '-'}}</td>
				</tr>
				<tr>
					<td>Anak ke</td>
					<td class="text-center">{{$bayi_data->anak_ke or '-'}}</td>
				</tr>
				<tr>
					<td>Berat Badan</td>
					<td class="text-center">{{$bayi_data->berat_badan or '-'}}</td>
				</tr>
				<tr>
					<td>Panjang Badan</td>
					<td class="text-center">{{$bayi_data->panjang_badan or '-'}}</td>
				</tr>
				<tr>
					<td>Lingkar Dada</td>
					<td class="text-center">{{$bayi_data->lingkar_dada or '-'}}</td>
				</tr>
				<tr>
					<td>Lingkar Kepala</td>
					<td class="text-center">{{$bayi_data->lingkar_kepala or '-'}}</td>
				</tr>
				<tr>
					<td>Lingkar Lengan Atas</td>
					<td class="text-center">{{$bayi_data->lingkar_lengan_atas or '-'}}</td>
				</tr>
				<tr>
					<td>Kelainan Kongeninal</td>
					<td class="text-center">{{$bayi_data->kelainan_kongeninal or '-'}}</td>
				</tr>
				<tr class="table-warning">
					<th colspan="2">Keadaan Jelek &amp; Meninggal</th>
				</tr>
				<tr>
					<td>Waktu Kematian Setelah Lahir (menit)</td>
					<td class="text-center">{{$bayi_data->kemudian_meninggal or '-'}}</td>
				</tr>
				<tr>
					<td>Post Partum (Sebab Meninggal)</td>
					<td class="text-center">{{$bayi_data->partumBayi or '-'}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table-warning">
					<th colspan="2">Resusitasi</th>
				</tr>
				<tr>
					<td>0 2 Muka Mulut</td>
					<td class="text-center">{{$bayi_data->muka_mulut_awal or '-'}} s/d {{$bayi_data->muka_mulut_akhir or '-'}}</td>
				</tr>
				<tr>
					<td>0 2 Muka Mulut: Sesudah Lahir</td>
					<td class="text-center">{{$bayi_data->muka_mulut_sesudah or '-'}}</td>
				</tr>
				<tr>
					<td>Pompa Udara Berulang</td>
					<td class="text-center">{{$bayi_data->pompa_udara_awal or '-'}} s/d {{$bayi_data->pompa_udara_akhir or '-'}}</td>
				</tr>
				<tr>
					<td>Pompa Udara Berulang: Sesudah Lahir</td>
					<td class="text-center">{{$bayi_data->pompa_udara_sesudah or '-'}}</td>
				</tr>
				<tr>
					<td>Intubatik Intracel</td>
					<td class="text-center">{{$bayi_data->intubatik_awal or '-'}} s/d {{$bayi_data->intubatik_akhir or '-'}}</td>
				</tr>
				<tr>
					<td>Intubatik: Sesudah Lahir</td>
					<td class="text-center">{{$bayi_data->intubatik_sesudah or '-'}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr class="table-warning">
					<th >Parameter</th>
					<th >Menit 1</th>
					<th >Menit 5</th>
					<th >Menit 10</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Denyut Jantung</th>

					@php $skor = $bayi_data->score_denyut_1 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = '< 100 BPM'; 
					elseif($skor == 2) $text = '> 100 BPM';
					@endphp
					<td>{{$skor}} - {{$text}}</td>

					@php $skor = $bayi_data->score_denyut_5 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = '< 100 BPM'; 
					elseif($skor == 2) $text = '> 100 BPM';
					@endphp
					<td>{{$skor}} - {{$text}}</td>

					@php $skor = $bayi_data->score_denyut_10 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = '< 100 BPM'; 
					elseif($skor == 2) $text = '> 100 BPM';
					@endphp

					<td>{{$skor}} - {{$text}}</td>

				</tr>
				<tr>
					<th>Pernafasan</th>

					@php $skor = $bayi_data->score_pernafasan_1 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = 'Tidak Normal / Pelan'; 
					elseif($skor == 2) $text = 'Baik / Menangis';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_pernafasan_5 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = 'Tidak Normal / Pelan'; 
					elseif($skor == 2) $text = 'Baik / Menangis';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_pernafasan_10 ?? '0';
					if($skor == 0) $text = 'Absen' ;
					elseif($skor == 1) $text = 'Tidak Normal / Pelan'; 
					elseif($skor == 2) $text = 'Baik / Menangis';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
				</tr>
				<tr>
					<th>Tonus Otot</th>
					@php $skor = $bayi_data->score_pernafasan_1 ?? '0';
					if($skor == 0) $text = 'Lemas' ;
					elseif($skor == 1) $text = 'Beberapa Fleksibilitas'; 
					elseif($skor == 2) $text = 'Gerakan Aktif';
					@endphp
					<td>{{$skor}} - {{$text}}</td>

					@php $skor = $bayi_data->score_pernafasan_5 ?? '0';
					if($skor == 0) $text = 'Lemas' ;
					elseif($skor == 1) $text = 'Beberapa Fleksibilitas'; 
					elseif($skor == 2) $text = 'Gerakan Aktif';
					@endphp
					<td>{{$skor}} - {{$text}}</td>

					@php $skor = $bayi_data->score_pernafasan_10 ?? '0';
					if($skor == 0) $text = 'Lemas' ;
					elseif($skor == 1) $text = 'Beberapa Fleksibilitas'; 
					elseif($skor == 2) $text = 'Gerakan Aktif';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
				</tr>
				<tr>
					<th>Peka Rangsan</th>

					@php $skor = $bayi_data->score_pernafasan_1 ?? '0';
					if($skor == 0) $text = 'Tidak Ada' ;
					elseif($skor == 1) $text = 'Meringis'; 
					elseif($skor == 2) $text = 'Bersin / Batuk';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_pernafasan_5 ?? '0';
					if($skor == 0) $text = 'Tidak Ada' ;
					elseif($skor == 1) $text = 'Meringis'; 
					elseif($skor == 2) $text = 'Bersin / Batuk';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_pernafasan_10 ?? '0';
					if($skor == 0) $text = 'Tidak Ada' ;
					elseif($skor == 1) $text = 'Meringis'; 
					elseif($skor == 2) $text = 'Bersin / Batuk';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
				</tr>
				<tr>
					<th>Warna</th>

					@php $skor = $bayi_data->score_warna_1 ?? '0';
					if($skor == 0) $text = 'Biru / Pucat' ;
					elseif($skor == 1) $text = 'Ekstremitas Biru, Tubuh Kemerah Merahan'; 
					elseif($skor == 2) $text = 'Semua Kemerah Merahan';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_warna_5 ?? '0';
					if($skor == 0) $text = 'Biru / Pucat' ;
					elseif($skor == 1) $text = 'Ekstremitas Biru, Tubuh Kemerah Merahan'; 
					elseif($skor == 2) $text = 'Semua Kemerah Merahan';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
					
					@php $skor = $bayi_data->score_warna_10 ?? '0';
					if($skor == 0) $text = 'Biru / Pucat' ;
					elseif($skor == 1) $text = 'Ekstremitas Biru, Tubuh Kemerah Merahan'; 
					elseif($skor == 2) $text = 'Semua Kemerah Merahan';
					@endphp
					<td>{{$skor}} - {{$text}}</td>
				</tr>
				<tr>
					<th>Score</th>

					@php $skor = $bayi_data->score_total_1 ?? '0';
					if($skor >= 0 && $skor <= 3) {$text = 'Asfiksia Berat'; $class='danger';}
					elseif($skor >= 4 && $skor <= 6) {$text = 'Asfiksia Sedang';  $class='warning';}
					elseif($skor >= 7) {$text = 'Sehat'; $class='primary';}
					@endphp

					<td><span class="badge badge-{{$class}}">{{$skor}} - {{$text}}</span></td>


					@php $skor = $bayi_data->score_total_5 ?? '0';
					if($skor >= 0 && $skor <= 3) {$text = 'Asfiksia Berat'; $class='danger';}
					elseif($skor >= 4 && $skor <= 6) {$text = 'Asfiksia Sedang';  $class='warning';}
					elseif($skor >= 7) {$text = 'Sehat'; $class='primary';}
					@endphp

					<td><span class="badge badge-{{$class}}">{{$skor}} - {{$text}}</span></td>


					@php $skor = $bayi_data->score_total_10 ?? '0';
					if($skor >= 0 && $skor <= 3) {$text = 'Asfiksia Berat'; $class='danger';}
					elseif($skor >= 4 && $skor <= 6) {$text = 'Asfiksia Sedang';  $class='warning';}
					elseif($skor >= 7) {$text = 'Sehat'; $class='primary';}
					@endphp

					<td><span class="badge badge-{{$class}}">{{$skor}} - {{$text}}</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>