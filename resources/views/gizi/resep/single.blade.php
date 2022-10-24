@extends('gizi.layouts.index')

@section('title')
Gizi Resep
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<a href="{{url('/gizi/resep/edit/')}}/{{$resep->id}}" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit</a>
				<button data-target="#deletemodal" class="btn btn-danger pull-right mr-5" id="button_del" 
				data-toggle="modal" data-id="{{$resep->id}}" data-nama="{{$resep->nama}}"><i class="fa fa-trash"></i> Delete</button>
				<div id="deletemodal" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Data</h4>
                            </div>
                            <div class="modal-body">
                                <p id="show-name"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <a id="del-btn">
                                    <button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				{{$resep->nama}}
			</h3>
		</div>
		<div class="block-content">
			<div class="row mt-20">
				<div class="col">
					<h5 class="font-w400">
						<small>JUMLAH PORSI</small>
						<br>{{$resep->porsi}}
					</h5>
					<h5 class="font-w400">
						<small>WAKTU MASAK</small>
						<br>{{$resep->waktu_masak}}
					</h5>
					<h5 class="font-w400">
						<small>UKURAN PORSI</small>
						<br>{{$resep->ukuran_tiap_porsi}}
					</h5>
				</div>
				<div class="col">
					<h5 class="font-w600">
						INFORMASI GIZI
					</h5>
					<div class="row">
						<div class="col">
							<h5 class="font-w400">
								<small>E</small><br>
								{{$resep->nilai_e}}
							</h5>
						</div>
						<div class="col">
							<h5 class="font-w400">
								<small>P</small><br>
								{{$resep->nilai_p}}
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h5 class="font-w400">
								<small>L</small><br>
								{{$resep->nilai_l}}
							</h5>
						</div>
						<div class="col">
							<h5 class="font-w400">
								<small>KH</small><br>
								{{$resep->nilai_k}}
							</h5>
						</div>
					</div>

				</div>
			</div>
			<hr>
			<div class="row mt-20">
				<div class="col-12">
					<h5 class="font-w400">
						<small>DAFTAR BAHAN DALAM 1 PORSI</small>
					</h5>
				</div>
				<div class="col-6">
					<table class="table table-borderless table-vcenter table-sm">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="">Nama Bahan</th>
								<th class="text-center">Jumlah BB</th>
								<th class="text-center">Jumlah BK</th>
							</tr>
						</thead>
						<tbody>
							@php $j = count($detail) @endphp
							@for($i=0;$i<$j;$i++)
							<tr>
								<td class="text-center" scope="row">{{$i+1}}</td>
								<td>{{$detail[$i]->bahan_makanan->nama}}</td>
								<td class="text-center">
									{{$detail[$i]->jumlah_bb}}
								</td>
								<td class="text-center">
									{{$detail[$i]->jumlah_bk}}
								</td>
							</tr>
							@endfor
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="row mt-20">
				<div class="col-12">
					<h5 class="font-w400">
						<small>PROSEDUR MASAK</small>
					</h5>
					<p>{{$resep->prosedur}}</p>
				</div>
			</div>
			<div class="row mt-20">
				<div class="col">
					<h6 class="p-10">
						<small class="text-muted">Diupdate Terakhir Oleh</small><br>
						{{$resep->user->name or '-'}}<br>
						<span class="font-w400">{{$resep->updated_at}}</span>
					</h6>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).on("click","#button_del", function () {
            var id = $(this).data('id')
            var nama = $(this).data('nama');
            $("#del-btn").attr('href','{{url('gizi/resep/delete')}}' + '/' + id)
            $("#show-name").html('Anda yakin ingin menghapus resep ' + nama + '?')

        })
</script>
@endsection