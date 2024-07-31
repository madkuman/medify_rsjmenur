@extends('farmasi.layouts.main')

@section('title')
Jenis Interaksi {{$master_jenis_interaksi->nama}}
@endsection

@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>Jenis Interaksi</small> <br>
            	{{$master_jenis_interaksi->nama}}
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/master-jenis-interaksi/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$master_jenis_interaksi->id}}">
                </form>
	            <button type="submit" class="confirm-del btn btn-secondary btn-square">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
	            </button>
	            <button type="button" class="btn btn-secondary btn-square" id="edit-master-jenis-interaksi">
	                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
	            </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                	<div class="col">
                		<label>DIBUAT OLEH</label>
                		<h5>{{$master_jenis_interaksi->creator->name}}</h5>
                	</div>
                	<div class="col">
                        <label>TANGGAL DIBUAT</label>
                        <h5>{{ date('d F Y', strtotime($master_jenis_interaksi->created_at)) }}</h5>
                	</div>
                </div>
            </div>
        </div>
    </div>
    
    @include('farmasi.master-jenis-interaksi.modals.modal-edit')
@endsection

@section('css')
	<style type="text/css">
		.bordered {
			border-bottom: 1px solid #eaecee;
		}
	</style>
@endsection

@section('js')
    <script type="text/javascript">
        $('#edit-master-jenis-interaksi').on('click', function(){
            $('#modal-normal').modal('show');
        })

        $('.confirm-del').on('click', function(){
            var deleteSupp = $(this).parent().find('form');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    deleteSupp.submit();
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });
    </script>
@endsection