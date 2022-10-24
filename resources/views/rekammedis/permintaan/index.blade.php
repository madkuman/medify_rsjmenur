@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis - Medify
@endsection

@section('css')

@endsection

@section('subtitle')
Dashboard
@endsection

@section('content')
<main id="main-container">
    @include('rekammedis.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content block-content-full">
                {{--<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#kirimFileTags">Kirim File</button>--}}
                
                <div class="d-none d-xs-none d-md-none d-sm-none d-lg-block d-xl-block">
                    <a class="btn btn-primary pull-right" href="{{url('rekammedis/transaksi/permintaan/kirim')}}">Kirim File</a>
                    <a class="btn btn-success pull-right mr-10" href="{{url()->full()}}&print=1" data-toggle="tooltip" data-placement="top" title="Print Halaman Ini" target="_blank"><i class="fa fa-print"></i> Print Permintaan</a>

                    <div class="btn-group pull-right mr-10" role="group" aria-label="Third group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lainnya</button>
                        <div class="dropdown-menu" aria-labelledby="toolbarDrop">
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#konfirmasiTolak" ><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Tolak Semua Permintaan Pada Halaman Ini"></i> Tolak Permintaan</a>
                        </div>
                    </div>
                </div>

                <h4>Daftar Permintaan File</h4>

                <div class="d-lg-none d-xl-none d-xs-block d-md-block">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 mb-5">
                            <a class="btn btn-primary btn-block" href="{{url('rekammedis/transaksi/permintaan/kirim')}}">Kirim File</a>
                        </div>
                        <div class="col-sm-12 col-xs-12 mb-5">
                            <a class="btn btn-success btn-block mr-10" href="{{url()->full()}}&print=1" data-toggle="tooltip" data-placement="top" title="Print Halaman Ini" target="_blank"><i class="fa fa-print"></i> Print Permintaan</a>
                        </div>
                        <div class="col-sm-12 col-xs-12 mb-5">
                            <div class="btn-group btn-block mr-10" role="group" aria-label="Third group">
                                <button type="button" class="btn btn-secondary dropdown-toggle btn-block" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lainnya</button>
                                <div class="dropdown-menu" aria-labelledby="toolbarDrop">
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#konfirmasiTolak" ><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Tolak Semua Permintaan Pada Halaman Ini"></i> Tolak Permintaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h5><small>FILTER</small></h5>
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-lg-4 col-12 form-group">
                            <label>Tujuan Pengiriman File</label>
                            <select class="js-select2 form-control" multiple name="group_ids[]">
                                <option value="0" @if(in_array(0,$group_selected)) selected @endif>Semua</option>
                                @foreach($groups as $group)
                                <option value="{{$group->id}}" @if(in_array($group->id,$group_selected)) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-4 form-group">
                            <label>Range Tanggal</label>
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_start}}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_end}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                            <label>Status Pengiriman File</label>
                            <select class="form-control" name="status">
                                <option value="0" @if($status == 0) selected @endif>Belum Dikirim</option>
                                <option value="1" @if($status == 1) selected @endif>Terkirim</option>
                                <option value="1" @if($status == -1) selected @endif>Ditolak</option>
                                <option value="2" @if($status == 2) selected @endif>Semua</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                            <label>Status Print File</label>
                            <select class="form-control" name="status_print">
                                <option value="0" @if($status_print == 0) selected @endif>Belum Di Print</option>
                                <option value="1" @if($status_print == 1) selected @endif>Telah di Print</option>
                                <option value="2" @if($status_print == 2) selected @endif>Semua</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                            <label>Lokasi Rak</label>
                            <select class="form-control" name="lokasi_rak">
                                <option value="0" @if($lokasi_rak == 0) selected @endif>Semua</option>
                                <option value="1" @if($lokasi_rak == 1) selected @endif>Atas (56 - 99)</option>
                                <option value="2" @if($lokasi_rak == 2) selected @endif>Bawah (0 - 55)</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div style="overflow: auto;">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No RM</th>
                                <th class="">Nama Pasien</th>
                                <th class="">Status Pasien</th>
                                <th class="">Diminta Oleh</th>
                                <th class="">Waktu Permintaan</th>
                                <th class="">Status Pengiriman</th>
                                <th class="">Lokasi RM</th>
                                <th class="" style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permintaan as $item)
                            @if(substr($item->pasien->no_rm, -2) <= $rm_index_max && substr($item->pasien->no_rm, -2) >= $rm_index_min)
                            @if(!empty($item->pasien->name))
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="font-w600">#{{$item->pasien->no_rm}}</td>
                                <td class="">{{$item->pasien->name}}</td>
                                <td>
                                    @if($item->pasien->kasus->count() > 0)
                                        @if($item->pasien->kasus->count() ==  1)
                                            @if($item->pasien->kasus[0]->is_baru == 1)
                                                <span class="badge badge-primary">Pasien Baru</span>
                                            @else
                                                <span class="badge badge-secondary">Pasien Lama</span>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">Pasien Lama</span>
                                        @endif
                                    @else
                                    <span class="badge badge-primary">Pasien Baru</span>
                                    @endif
                                </td>
                                <td class="">{{$item->holder_user->name ?? ''}}  {{$item->holder_group->name ?? ''}}</td>
                                <td>{{$item->created_at->format('d F Y H:i')}}</td>
                                <td class="">
                                    @if($item->status == 0) <span class="badge badge-secondary">Menunggu</span>
                                    @elseif($item->status == 1) <span class="badge badge-primary">Proses Pengiriman</span>
                                    @elseif($item->status == 2) <span class="badge badge-success">Selesai</span>
                                    @elseif($item->status == -1) <span class="badge badge-danger">Pengiriman Ditolak</span>
                                    @elseif($item->status == -2) <span class="badge badge-warning">Konfirmasi Penerimaan Ditolak</span>
                                    @else Tanpa Status
                                    @endif
                                </td>
                                <td class="">

                                    @php $user = $item->pasien->rm_transaksi->holder_user->name ?? '' @endphp
                                    @php $grup = $item->pasien->rm_transaksi->holder_group->name ?? '' @endphp
                                    @php $sender = $item->pasien->rm_transaksi->sender->name ?? '' @endphp
                                    @if($user == '' && $grup == '' && $sender == '')
                                    Rekam Medis
                                    @else
                                    {{$user}} @if($user != '') atau @endif
                                    {{$grup}} @if($grup != '') atau @endif
                                    {{$sender}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{url('rekammedis/transaksi')}}/{{$item->id}}/setuju-pengiriman" method="POST">
                                        {{csrf_field()}}
                                        <a href="{{url('rekammedis/transaksi/'.$item->id)}}" class="btn btn-sm btn-secondary mb-5">
                                            <i class="fa fa-search"></i> Detail
                                        </a>
                                        <button class="btn btn-sm btn-primary mb-5">
                                            <i class="fa fa-paper-plane"></i> Kirim
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="kirimFileTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('rekammedis/transaksi/permintaan/kirim')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <p>Gunakan Barcode Scanner untuk mempercepat input</p>
                                <label class="col-12" for="example-tags1">Masukkan No RM</label>
                                <div class="col-12">
                                    {{csrf_field()}}
                                    <input type="text" class="js-tags-input form-control" id="example-tags2" name="no_rm" value="">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasiTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Akan Menolak Semua Transaksi Ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <p>Permintaan yang telah ditolak tidak dapat dikembalikan lagi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="{{url()->full()}}&tolak_batch=1" class="btn btn-primary">Ya</a>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')




<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection