@php $count = count($post) @endphp
@if($count > 0)

<div class="row">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="min-width:200px">Parameter</th>
					@foreach($post as $key => $item)
					<td></td>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Post Ops hari ke -</td>	
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{$res->hari_ke}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Rawat Luka</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->rawat_luka) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Dressing Transparan</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->dressing_transparan) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Dressing Hypavix</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->dressing_hypavix) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Buang Cairan</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->buang_cairan) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Aff Drain</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{$res->aff_drain}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Angkat Jahitan</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->angkat_jahitan) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Antibiotik</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->antibiotik_post) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>KRS</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->krs) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Kontrol Poli</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->kontrol_poli) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr class="table-warning">
					<th class="text-center">Infeksi</th>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center"></td>
					@endforeach
				</tr>
				<tr>
					<td>Infeksi</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($res->infeksi))
						@if($res->infeksi == 1) Ya @endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Jenis Lokasi Infeksi</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{$res->jenis_lokasi_infeksi}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Lokasi spesifik untuk infeksi organ / rongga</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{$res->lokasi_spesifik_infeksi}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Lokasi spesifik untuk infeksi organ / rongga Lain-lain</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{$res->lokasi_spesifik_infeksi_lain2 ?? '-'}}</td>
					@endforeach
				</tr>
				
				<tr class="table-warning">
					<th class="text-center">Identifikasi IDO</th>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td></td>
					@endforeach
				</tr>
				<tr>
					<td>Ada nanah purulen dari tempat insisi</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->nanah) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Bengkak Terlokalisir</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->bengkak) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Merah</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->merah) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Nyeri lokal dan sakits</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->nyeri) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Demam >= 38C</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->demam) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Drainase Purulen</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->drainase_purulen) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Kuman pada kultur purulen</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->kuman) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Pemeriksaan Penunjang (Radiologi / Histologi)</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->pemeriksaan_penunjang) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Kuman pada kultur purulen</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->abses) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Diagnosa Dokter</td>
					@foreach($post as $key => $item)
					@php $res = json_decode($item->val) @endphp
					<td class="text-center">{{!empty($res->dx_dokter) ? 'Ya' : ''}}</td>
					@endforeach
				</tr>
				<tr>
					<td>Info</td>
					@foreach($post as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">

						<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.bsi.tooltip')" data-placement="left">
							<i class="fa fa-info"></i>
						</button>

					</td>
					@endforeach
				</tr>
				<tr>
					<td>Edit</td>
					@foreach($post as $item)
					<td class="text-center">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button class="btn btn-circle btn-outline-primary mr-5 mb-5 editPostBtn" data-id="{{$item->id}}">
							<i class="fa fa-edit"></i>
						</button>
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Hapus</td>
					@foreach($post as $item)
					<td class="text-center">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button class="btn btn-circle btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
					</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
@else

<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada asesmen Surveilans Infeksi Luka Operasi tersedia</h4>
	<p>Klik tombol <b>Surveilans Infeksi Luka Operasi Baru</b> untuk melakukan asesmen Surveilans Infeksi Luka Operasi</p>
</div>

@endif