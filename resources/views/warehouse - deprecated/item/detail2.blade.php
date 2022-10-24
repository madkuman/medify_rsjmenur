@extends('warehouse.layouts.main')

@section('title')
Gudang Detail Barang
@endsection

@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>NAMA BARANG</small> <br>
            	{{$item->nama}} <br>
                @forelse($item->items_category as $gori)
                    <span class="badge badge-primary">{{$gori->detail_kategori->nama}}</span>
                @empty -
                @endforelse
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('gudang/item/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                </form>
	            <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
	            </button>
	            <button type="submit" class="btn btn-alt-primary btn-square" id="edit-item">
	                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
	            </button>
                <button type="button" class="btn btn-alt-warning btn-square" id="kartu-stok">
                    <i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp;Stok
                </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                	<div class="col">
                		<label>HARGA SAAT INI</label>
                		<h5>Rp. {{number_format($item->harga)}}</h5>
                		<label>STOK</label>
                		<h5>{{$item->stok}}</h5>
                		<label>SATUAN</label>
                		<h5>{{$item->satuan}}</h5>
                	</div>
                	<div class="col">
                		<label>BATASAN STOK</label>
                		<P>{{$item->min_stok}}</P>
                		<label>BATASAN EXPIRED SOON</label>
                        @if($item->min_kadaluarsa%30 == 0) <p>{{$item->min_kadaluarsa/30}} Bulan</p> @php $waktu = 30 @endphp
                        @elseif($item->min_kadaluarsa%365 == 0) <p>{{$item->min_kadaluarsa/365}} Tahun</p> @php $waktu = 365 @endphp
                        @else <p>{{$item->min_kadaluarsa}} Hari</p> @php $waktu = 1 @endphp
                        @endif
                		<label>KETERANGAN</label>
                		<p>{{$item->deskripsi}}</p>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Daftar Stok Barang <small>({{$total_active}} Stok)</small></h3>
        </div>
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Jumlah Stok</th>
                        <!-- <th>Ref. Transaksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($active as $act)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ date('d F Y', strtotime($act->kadaluarsa)) }}</td>
                        <td>{{$act->jumlah}}</td>
                        <!-- <td class="text-info">
                            @if(!is_null($act->detail_pengadaan))
                            <a href="{{url('gudang/pengadaan/'.$act->detail_pengadaan->slug)}}">#{{$act->detail_pengadaan->slug}}</a>
                            @elseif(!is_null($act->log)) 
                                @foreach($act->log as $log)
                                    @if($log->status_distribusi)
                                        <a href="{{url('gudang/distribusi/'.$log->detail_distribusi->slug)}}">#{{$log->detail_distribusi->slug}}</a> 
                                    @endif
                                @endforeach
                            @endif
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Mutasi Barang <small>({{$total_items}} Catatan)</small></h3>
        </div>
        <div class="block-content">
            <table class="table table-hover table-vcenter" id="mutasi-barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Transaksi</th>
                        <th>Pihak Kedua</th>
                        <th>Stok</th>
                        <th>Tanggal Transaksi</th>
                        <th>Ref. Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; $page=1 @endphp
                    @foreach($items as $row)
                    <tr>
                        @if($row->pengadaan_id)
                            <td>{{$i++}}</td>
                            <td>Penerimaan</td>
                            <td>
                                @if(!is_null($row->detail_pengadaan))
                                    {{$row->detail_pengadaan->supplier_detail->nama ?? '-'}}
                                @else -
                                @endif
                            </td>
                            <td>+{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->tanggal)) }}</td>
                            <td class="text-info">
                                @if(!is_null($row->detail_pengadaan))
                                <a href="{{url('gudang/pengadaan/'.$row->detail_pengadaan->slug)}}">#{{$row->detail_pengadaan->slug}}</a>
                                @else - 
                                @endif
                            </td>
                        @elseif($row->distribusi_id)
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_distribusi->kategori}}</td>
                            <td>
                                @if(!is_null($row->detail_distribusi))
                                    {{$row->detail_distribusi->farmasi_id ? $row->detail_distribusi->farmasi_detail->nama : 'Gudang'}}
                                @else -
                                @endif
                            </td>
                            <td>@if($row->detail_distribusi->tipe == 1) +@endif{{$row->jumlah * $row->detail_distribusi->tipe}}</td>
                            <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                            <td class="text-info">
                                @if($row->detail_distribusi)
                                <a href="{{url('gudang/distribusi/'.$row->detail_distribusi->slug)}}">#{{$row->detail_distribusi->slug}}</a>
                                @else - 
                                @endif
                            </td>
                        @else
                            <td>{{$i++}}</td>
                            <td>Penghapusan</td>
                            <td> - </td>
                            <td>-{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                            <td class="text-info">
                                @if(!is_null($row->detail_penghapusan))
                                <a href="{{url('gudang/penghapusan/'.$row->detail_penghapusan->slug)}}">#{{$row->detail_penghapusan->slug}}</a>
                                @else - 
                                @endif
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($total_items > 10)
                <div class="p-10 text-center">
                    <i class="fa fa-4x fa-asterisk fa-spin text-info d-none" id="loader"></i>
                    <button type="button" id="load-more" class="btn btn-secondary">Load More</button>
                </div>
            @endif
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/item')}}/edit">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$item->id}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Ubah Barang</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="{{$item->nama}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Harga Pasar Barang</label>
                                        <input type="text" class="form-control" name="harga" placeholder="Harga Pasar Barang" value="{{$item->harga}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Satuan</label>
                                        <select class="js-select2 form-control" id="satuan-select2" name="satuan" placeholder="Pilih Satuan" style="width: 100%;">
                                            @foreach($satuan as $tuan)
                                                <option value="{{$tuan->nama}}" @if($item->satuan == $tuan->nama) selected @endif>{{$tuan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Kategori Barang</label>
                                        <select class="js-example-basic-multiple form-control" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                            @foreach($gorilla as $gori)
                                                <option value="{{$gori->id}}" @if($gori->selected)selected @endif>{{$gori->nama}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <input type="text" class="form-control js-tags-input" name="kategori" placeholder="Kategori Barang" value="@foreach($item->items_category as $gori) {{$gori->nama}}, @endforeach"> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Jenis Barang</label>
                                        <select class="form-control" id="jenis-select2" name="jenis">
                                            <option value="Obat" @if($item->jenis == 'Obat') selected @endif>Obat</option>
                                            <option value="Matkes" @if($item->jenis == 'Matkes') selected @endif>Matkes</option>
                                            <option value="Implan" @if($item->jenis == 'Implan') selected @endif>Implan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Batasan Low Stock <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="batasan_stok" placeholder="Isi Batasan Low Stock" value="{{$item->min_stok}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Batasan Expired <small>(Opsional)</small></label>
                                        <div class="form-inline">
                                            <input type="text" class="form-control mr-sm-2" name="batasan_kadaluarsa" placeholder="Isikan Angka" value="{{$item->min_kadaluarsa/$waktu}}">
                                            <select class="form-control mr-sm-2" id="expired-select2" name="satuan_waktu" data-placeholder="Bulan">
                                                <option value="1" @if($waktu == 1) selected @endif)>Hari</option>
                                                <option value="30" @if($waktu == 30) selected @endif>Bulan</option>
                                                <option value="365" @if($waktu == 365) selected @endif>Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Lebih Lanjut" value="{{$item->deskripsi}}">
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

    <div class="modal" id="modal-kartu-stok" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/item/'.$item->slug.'/kartu-stok') }}" target="_blank">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                            <i class="fa fa-check"></i> Lanjut
                        </button>
                    </div>
                </form>
            </div>
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
        var page = 1;
        var ctr = 11;
        var total = "{{$total_items}}";
        $('#edit-item').on('click', function(){
            $('#modal-large').modal('show');
        })

        $('#kartu-stok').on('click', function(){
            $('#modal-kartu-stok').modal('show');
        })

        $('#satuan-select2').select2({
            tags: true
        });

        $('.js-example-basic-multiple').select2({
            tags: true
        });

        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                // startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }

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

        $('#load-more').on('click', function(){            
            var url = "{{ url('/api/gudang/item/'.$item->slug.'/mutasi') }}/"+page;
            page++;
            if(page > total/10) $('#load-more').hide();
            $('#loader').removeClass('d-none');

            var str = "";
            $.get( url , function( data ) {
                for(var key in data)
                {
                    row = data[key];
                    str += `<tr>`;
                    if(row.pengadaan_id != null)
                    {
                        str += `<td>`+ctr+`</td>
                        <td>Penerimaan</td>
                        <td>`;
                            if(row.detail_pengadaan == null || row.detail_pengadaan.supplier_detail == null) str += `-`;
                            else str += row.detail_pengadaan.supplier_detail.nama;
                        str += `</td>
                        <td>+`+row.jumlah+`</td>
                        <td>`+formatDate(row.tanggal)+`</td>
                        <td class="text-info">`;
                            if(row.detail_pengadaan == null) str += `-`;
                            else str += `<a href="{{url('gudang/pengadaan')}}/`+row.detail_pengadaan.slug+`">#`+row.detail_pengadaan.slug+`</a>
                        </td>`;
                    }
                    else if(row.distribusi_id != null)
                    {
                        str += `<td>`+ctr+`</td>
                        <td>`;
                            if(row.detail_distribusi == null) str += `-`;
                            else str += row.detail_distribusi.kategori;
                        str += `</td><td>`;
                            if(row.detail_distribusi == null || row.detail_distribusi.farmasi_detail == null) str += `-`;
                            else str += row.detail_distribusi.farmasi_detail.nama;
                        str += `</td>
                        <td>-`+row.jumlah+`</td>
                        <td>`+formatDate(row.created_at)+`</td>
                        <td class="text-info">`;
                            if(row.detail_distribusi == null) str += `-`;
                            else str += `<a href="{{url('gudang/distribusi')}}/`+row.detail_distribusi.slug+`">#`+row.detail_distribusi.slug+`</a>
                        </td>`;
                    }
                    else
                    {
                        str += `<td>`+ctr+`</td>
                        <td> Penghapusan </td><td> - </td>
                        <td>-`+row.jumlah+`</td>
                        <td>`+formatDate(row.created_at)+`</td>
                        <td class="text-info">`;
                            if(row.detail_penghapusan == null) str += `-`;
                            else str += `<a href="{{url('gudang/penghapusan')}}/`+row.detail_penghapusan.slug+`">#`+row.detail_penghapusan.slug+`</a>
                        </td>`;   
                    }
                    str += `</tr>`
                    ctr++;
                }
                $('#mutasi-barang').append(str);
                $('#loader').addClass('d-none');
            });    
        });
    </script>
@endsection