@extends('farmasi.layouts.main')

@section('title')
Medify - Farmasi Detail Distribusi
@endsection

@section('css')
<style type="text/css">
select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;
    background: #eee;

    .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    .select2-selection__arrow, .select2-selection__clear {
        display: none;
    }
}
</style>
@endsection

@section('content')
        <div class="block">
            <div class="block-header bordered">
                <h3 class="block-title">Distribusi #{{$distribusi->slug}} 
                    @if($distribusi->status == 0)
                    @if($distribusi->tipe==1)
                    <span class="p-2 badge badge-primary">Menunggu</span>
                    @else
                    <span class="p-2 badge badge-info">Konfirmasi</span>
                    @endif
                    @elseif($distribusi->status == 1)
                    @if($distribusi->tipe==1)
                    <span class="p-2 badge badge-info">Konfirmasi</span>
                    @else
                    <span class="p-2 badge badge-primary">Terkirim</span>
                    @endif
                    @elseif($distribusi->status == 2)
                    <span class="p-2 badge badge-success">Selesai</span>
                    @elseif($distribusi->status == -1)
                    <span class="p-2 badge badge-danger">Ditolak</span>
                    @elseif($distribusi->status == -2)
                    <span class="p-2 badge badge-danger">Dibatalkan</span>
                    @endif
                </h3>
                <div class="block-options">
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/delete')}}" id="form-hapus">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$distribusi->id}}">
                        <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
                    </form>
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/verify')}}" id="form-konfirmasi">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$distribusi->id}}">
                        <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
                    </form>
                    @if($distribusi->status == 1)
                    @if($distribusi->tipe == -1 && session('farmasi')->group->my_role->admin ?? 0 == 1)
                    <button type="button" class="btn btn-alt-primary btn-square" id="btnEditTerkirim">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                    @else
                    <button type="button" class="btn btn-alt-primary btn-square" id="confirm-accept" data-toggle="modal" data-target="#modal-large-terima">
                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Terima
                    </button>
                    <button type="button" class="btn btn-alt-warning btn-square" id="confirm-reject">
                        <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Tolak
                    </button>
                    @endif
                    @elseif($distribusi->status == 0)
                    @if($distribusi->tipe == 1 && (session('farmasi')->group->my_role->admin ?? 0) == 1)
                    <button type="button" class="btn btntn-alt-primary btn-square" id="btnEdit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                    @else
                    <button type="button" class="btn btn-alt-success btn-square" id="btnKonfirm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Kirim
                    </button>
                    <button type="button" class="btn btn-alt-warning btn-square" id="confirm-reject">
                        <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Tolak
                    </button>
                    @endif
                    @if(session('farmasi')->group->my_role->admin ?? 0 == 1)
                    <button type="button" class="btn btn-alt-danger btn-square confirm-del">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                    @endif
                    @endif
                    <a href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/print/'.$distribusi->slug)}}" class="btn btn-alt-secondary btn-square" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</a>
                </div>
            </div>
            <div class="block-content">
                <div class="block block-transparent">
                    <div class="row">
                     <div class="col">
                      <label>UNIT TUJUAN</label>
                      <h5>@if($distribusi->unit_tujuan) {{$distribusi->detail_tujuan->nama}} @else Gudang @endif</h5>
                      <label>TANGGAL TRANSAKSI</label>
                      <h5>{{ date('d F Y', strtotime($distribusi->created_at)) }}</h5>
                  </div>
                  <div class="col">
                    <label>KATEGORI</label>
                    <h5>{{$distribusi->kategori}}</h5>
                    <label>KETERANGAN</label>
                    <p>{{$distribusi->deskripsi ? $distribusi->deskripsi : "-"}}</p>
                </div>
            </div>
        </div>
        
        @if($distribusi->tipe == 1)
            @if($distribusi->status==1)
                @if($distribusi->kategori == 'Retur')
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikembalikan</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($distribusi->distribusi_detail))
                        @foreach($distribusi->distribusi_detail->log as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <td colspan="4">Data Kosong</td>
                        @endif
                    </tbody>
                </table>
                @else
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikirim</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                        </tr>
                    </thead>
                    @if($distribusi->unit_tujuan)
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($distribusi->distribusi_detail))
                        @foreach($distribusi->distribusi_detail->log as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <td colspan="4">Data Kosong</td>
                        @endif
                    </tbody>
                    @else
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($distribusi->transaksi_detail->log as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                @endif
            @elseif($distribusi->status==2)
                @if($distribusi->kategori == 'Retur')
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikembalikan</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                            <!-- <th>Subtotal</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($distribusi->log as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                            <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                        </tr>
                        @endforeach
                        <!-- <tr>
                            <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                            <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                        </tr> -->
                    </tbody>
                </table>
                @else
                @if(count($distribusi->log_diterima)>0)
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Diterima</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                            <!-- <th>Subtotal</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($distribusi->log_diterima as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                            <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                        </tr>
                        @endforeach
                        <!-- <tr>
                            <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                            <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                        </tr> -->
                    </tbody>
                </table>
                @endif
                @if(count($distribusi->log_ditolak)>0)
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Ditolak</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                            <!-- <th>Subtotal</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($distribusi->distribusi_detail))
                        @foreach($distribusi->distribusi_detail->draft as $row)
                        @if($row->alasan_ditolak != null)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                            <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                        </tr>
                        @endif
                        @endforeach
                        @else
                        <td colspan="4">Data Kosong</td>
                        @endif
{{--                        handel data lama--}}
                        @if($i == 1)
                            @foreach($distribusi->log_ditolak as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                                        <td>{{$row->jumlah}}</td>
                                        <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                                    <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                                    </tr>
                            @endforeach
                        @endif
                        <!-- <tr>
                            <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                            <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                        </tr> -->
                    </tbody>
                </table>
                @endif
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikirim</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                        </tr>
                    </thead>
                    @if($distribusi->unit_tujuan)
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($distribusi->distribusi_detail))
                        @foreach($distribusi->distribusi_detail->draft as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <td colspan="4">Data Kosong</td>
                        @endif
                    </tbody>
                    @else
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($distribusi->transaksi_detail->draft as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                            <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                @endif
            @endif
        
            @if($distribusi->kategori == 'Permintaan')
            <h4 class="p-10 bg-primary-lighter text-primary-dark">Permintaan Awal</h4>
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($distribusi->draft as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->item_farmasi->item_detail->nama}}</td>
                        <td>{{$row->jumlah}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        @else
            @if($distribusi->status)
            <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikirim</h4>
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Kadaluarsa</th>
                        <!-- <th>Subtotal</th> -->
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach(count($distribusi->draft) == 0 ? $distribusi->log : $distribusi->draft as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                        <td>{{$row->jumlah}}</td>
                        <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                        <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                        <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                    </tr> -->
                </tbody>
            </table>
            @endif
        
            @if($distribusi->kategori == 'Permintaan')
            <h4 class="p-10 bg-primary-lighter text-primary-dark">Permintaan Awal</h4>
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @if(isset($distribusi->distribusi_detail))
                    @foreach($distribusi->distribusi_detail->draft as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            @if($row->item_farmasi)
                            @if($row->item_farmasi->farmasi_id == session('farmasi')->id)
                            {{$row->item_farmasi->item_detail->nama}}
                            @else
                            {{$row->detail_draft->nama}} <br> (Barang tidak terdaftar di farmasi ini)
                            @endif
                            @else
                            {{$row->detail_draft->item_detail->nama}} (Barang tidak terdaftar di farmasi ini)
                            @endif
                        </td>
                        <td>{{$row->jumlah}}</td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="4">Data Kosong</td>
                    @endif
                </tbody>
            </table>
            @endif
        @endif
        
        <div class="mt-50">
            <div class="row">
                <div class="col-md-6">
                    <label>DI BUAT OLEH</label>
                    <h5 class="text-primary">{{$distribusi->created_by_detail->name ?? '-'}} - {{ date('d F Y, H:i', strtotime($distribusi->created_at)) }}</h5>
                </div>
                <?php if($distribusi->status == 2) { ?>
                <div class="col-md-6 pull-right">
                    <label>DI VERIFIKASI OLEH</label>
                    <h5 class="text-primary">{{$distribusi->verified_by_detail->name ?? '-'}} - {{ date('d F Y, H:i', strtotime($distribusi->updated_at)) }}</h5> 
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
        
        @php $j=0 @endphp
        @if($distribusi->status==0)
            @if($distribusi->tipe==1)
                @include('farmasi.distribusi.components.modals.modal-detail-distribusi-edit')
            @elseif($distribusi->tipe == -1)
                @include('farmasi.distribusi.components.modals.modal-detail-distribusi-konfirmasi-permintaan')
            @endif
        @elseif($distribusi->status==1)
            @if($distribusi->tipe==1)
                @include('farmasi.distribusi.components.modals.modal-detail-distribusi-konfirmasi-terima')
            @elseif($distribusi->tipe == -1)
                @include('farmasi.distribusi.components.modals.modal-detail-distribusi-edit-terkirim')
            @endif
        @endif
@endsection

@section('css')
<style type="text/css">
.badge {
   width: 120px;
}
.p-10 {
  padding: 5px!important;
}
.bordered {
    border-bottom: 1px solid #eaecee;
}
</style>
@endsection

@section('js')
    @include('farmasi.distribusi.components.js.js-detail')
@endsection