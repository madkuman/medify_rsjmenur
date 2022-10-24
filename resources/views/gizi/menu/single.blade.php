@extends('gizi.layouts.index')

@section('title')
Gizi Menu
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<a href="{{url('/gizi/menu/edit/')}}/{{$menu->id}}" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit</a>
				<button data-target="#deletemodal" class="btn btn-danger pull-right mr-5" id="button_del" 
				data-toggle="modal" data-id="{{$menu->id}}" data-nama="{{$menu->nama}}"><i class="fa fa-trash"></i> Delete</button>
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
				{{$menu->nama}}
			</h3>
		</div>
		<div class="block-content">
			<div class="row mt-20">
				<div class="col-2">
					<h5 class="font-w400">
						<small>KELAS</small>
						<br>{{$menu->kelas_menu->nama or ''}}
					</h5>
				</div>
				<div class="col-2">
					<h5 class="font-w400">
						<small>PERIODE TANGGAL</small>
						<br>{{$menu->tanggal_periode}}
					</h5>
				</div>
				{{--<div class="col-2">
					<h5 class="font-w400">
						<small>DIET</small>
						<br>{{$menu->diet_menu->nama}}
					</h5>
				</div>--}}

			</div>
			<hr>
			<div class="row mt-20">
				<div class="col-12">
					<h5 class="font-w400">
						<small>DAFTAR MAKANAN</small>
					</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<h6 class="mb-5">MAKAN PAGI</h6>
					<ul>
						@foreach($mp as $mp)
						<li>{{$mp->detail_resep->nama}}</li>
						@endforeach
					</ul>
				</div>
				<div class="col-6">
					<h6 class="mb-5">SNACK PAGI</h6>
					<ul>
						@foreach($sp as $sp)
						<li>{{$sp->detail_resep->nama}}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="row mt-10">
				<div class="col-6">
					<h6 class="mb-5">MAKAN SIANG</h6>
					<ul>
						@foreach($ms as $ms)
						<li>{{$ms->detail_resep->nama}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="row mt-10">
				<div class="col-6">
					<h6 class="mb-5">MAKAN SORE</h6>
					<ul>
						@foreach($msr as $msr)
						<li>{{$msr->detail_resep->nama}}</li>
						@endforeach
					</ul>
				</div>
				<div class="col-6">
					<h6 class="mb-5">SNACK SORE</h6>
					<ul>
						@foreach($ss as $ss)
						<li>{{$ss->detail_resep->nama}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<hr>
			<div class="row mt-20">
				<div class="col">
					<h6 class="p-10">
						<small class="text-muted">Diupdate Terakhir Oleh</small><br>
						{{-- {{$menu->user->name}} --}}<br>
						<span class="font-w400">{{$menu->created_at}}</span>
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
            $("#del-btn").attr('href','{{url('gizi/menu/delete')}}' + '/' + id)
            $("#show-name").html('Anda yakin ingin menghapus menu ' + nama + '?')

        })
</script>
@endsection