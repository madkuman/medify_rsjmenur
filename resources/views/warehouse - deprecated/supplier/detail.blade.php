@extends('warehouse.layouts.main')

@section('title')
Gudang Detail Supplier
@endsection

@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>SUPPLIER</small> <br>
            	{{$supplier->nama}}
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('gudang/supplier/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="supp_id" value="{{$supplier->id}}">
                </form>
	            <button type="submit" class="confirm-del btn btn-alt-danger btn-square">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
	            </button>
	            <button type="button" class="btn btn-alt-primary btn-square" id="edit-supp">
	                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
	            </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                	<div class="col">
                		<label>ALAMAT PERUSAHAAN</label>
                		<h5>{{(!is_null($supplier->alamat)) ? $supplier->alamat : "-"}}</h5>
                		<label>NOMOR TELEPON PERUSAHAAN</label>
                		<h5>{{(!is_null($supplier->telepon)) ? $supplier->telepon : "-"}}</h5>
                		<label>NOMOR NPWP PERUSAHAAN</label>
                		<h5>{{(!is_null($supplier->npwp_agen)) ? $supplier->npwp_agen : "-"}}</h5>
                	</div>
                	<div class="col">
                		<label>PERWAKILAN</label>
                		<P>{{(!is_null($supplier->agen)) ? $supplier->agen : "-"}}</P>
                		<label>NOMOR TELEPON PERWAKILAN</label>
                		<p>{{(!is_null($supplier->telepon_agen)) ? $supplier->telepon_agen : "-"}}</p>
                		<label>KETERANGAN</label>
                		<p>{{(!is_null($supplier->deskripsi)) ? $supplier->deskripsi : "-"}}</p>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Histori Transaksi <small>({{$jumlah}} Transaksi)</small></h3>
        </div>
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Nilai Pengadaan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($pengadaan as $row)
                    <tr class="clickable-row" data-href="{{url('gudang/pengadaan/'.$row->slug)}}">
                        <td>{{$i++}}</td>
                        <td>Pengadaan</td>
                        <td>{{ date('d F Y', strtotime($row->tanggal)) }}</td>
                        <td>Rp. {{number_format($row->total_harga)}}</td>
                        <td>Telah Dikirim</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/supplier')}}/edit">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$supplier->id}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Ubah Supplier</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Perusahaan" value="{{$supplier->nama}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Perusahaan</label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat Perusahaan" value="{{$supplier->alamat}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" name="telepon" placeholder="Nomor Telepon" value="{{$supplier->telepon}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor NPWP</label>
                                        <input type="number" class="form-control" name="npwp" placeholder="Nomor NPWP" value="{{$supplier->npwp_agen}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Nama Perwakilan</label>
                                        <input type="text" class="form-control" name="nama_perwakilan" placeholder="Nama Perwakilan" value="{{$supplier->agen}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon Perwakilan</label>
                                        <input type="number" class="form-control" name="telepon_perwakilan" placeholder="Nomor Telepon Perwakilan" value="{{$supplier->telepon_agen}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$supplier->deskripsi}}" placeholder="Berikan Informasi Lebih">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square">
                             <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
        $('#edit-supp').on('click', function(){
            $('#modal-large').modal('show');
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
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });
    </script>
@endsection