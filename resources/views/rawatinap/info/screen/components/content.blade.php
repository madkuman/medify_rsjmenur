<div class="bg-black-op-75" style="height: 150vh;width: 100vw">
	<div id="video-container" style="">
		<div class="row" style="height: 100%">
			<div class="col-12">
				<div class="block block-transparent">
					<div class="pb-20 pt-0 text-center" style="height: 100%">
						<h1 class="text-white">KETERSEDIAAN TEMPAT TIDUR</h1>
						<div class="row p-10 mt-20">
							<table class="table table-bordered text-white">
								<tr>
									<td rowspan="2" id="ZAAL">Ruang/Kelas</td>
									@foreach($bangsals[array_key_first($bangsals)] as $nama_kelas => $items)
										<td colspan="3">{{$nama_kelas}}</td>
									@endforeach
								</tr>
								<tr>
									@foreach($bangsals[array_key_first($bangsals)] as $nama_kelas => $items)
										<td style="width: 60px">JML</td>
										<td style="width: 60px">ISI</td>
										<td style="width: 60px">KOSONG</td>
									@endforeach
								</tr>
								@foreach($bangsals as $nama_bangsal => $item)
									<tr>
										<td>{{$nama_bangsal ?? '-'}}</td>
										@foreach($item as $nama_kelas => $items)
											<td id="total_{{$items['bangsal_id']}}_{{$items['kelas_id']}}">{{$items['total'] ?? '-'}}</td>
											<td id="isi_{{$items['bangsal_id']}}_{{$items['kelas_id']}}">{{$items['isi'] ?? '-'}}</td>
											<td id="kosong_{{$items['bangsal_id']}}_{{$items['kelas_id']}}">{{$items['kosong'] ?? '-'}}</td>
										@endforeach
									</tr>
								@endforeach
							</table>
							<div class="text-white h4 mt-20" style="margin: 0 auto;">
								Last Update :
								<span id="rawat-inap-last-update"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<audio id="player"></audio>
