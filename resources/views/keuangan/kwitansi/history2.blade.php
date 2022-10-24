@extends('keuangan.layouts.main')

@section('title')
Histori Kwitansi - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.kwitansi.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <h4 class="mb-0">History Kwitansi</h4>
            </div>
            <div class="block-content py-20">    
                <div class="row">
                    <div class="col-3">
                        <form class="form-horizontal form-material" action="{{ route('kwitansi_history') }}" method = "get">
                            <label>Tampilkan</label>
                            <button type="submit" class="btn btn-outline-secondary" style="width: 80%">All Data</button>
                        </form>
                    </div>
                    <div class="col-4" id="by-date">
                        <form class="form-horizontal form-material" action="{{ route('kwitansi_getDate') }}" method = "get">
                            <label for="example-datepicker1">Tanggal Transaksi</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="js-datepicker form-control" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', time())}}">
                                </div>
                                <div class="col-2" style="padding-left:0">
                                    <button type="submit" class="btn btn-alt-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <hr>                
                    </div> 
                    <div class="col-12">
                        <table class="table table-striped table-hover table-vcenter js-dataTable-simple">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#  </th>
                                    <th class="text-center" style="width: 200px;">Tanggal  </th>
                                    <th class="text-center" style="width: 100px;">Tipe  </th>
                                    <th class="text-center" style="width: 200px;">Jenis  </th>
                                    <th class="text-center" style="width: 150px;">Total  </th>
                                    <th class="text-center" style="width: 200px;">Pembayar  </th>
                                    <th class="text-center" style="width: 200px;">Penerima  </th>
                                    <th class="text-center">Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 0 @endphp
                                @foreach($kwitansi as $item)
                                <tr>
                                    <td class="text-center">{{++$count}}</td>
                                     <td class="text-center">{{date('d F Y', strtotime($item->tanggal_transaksi))}}</td>
                                    <td class="text-left">
                                        @if($item->type == 1)
                                            Pemasukan
                                        @elseif($item->type == 2)
                                            Pengeluaran
                                        @endif
                                    </td>
                                    <td class="text-left">{{$item->jenis_transaksi}}</td>
                                    <td class="text-right">Rp {{number_format($item->total)}}</td>
                                    <td class="text-left">{{$item->pembayar_nama}}</td>
                                    <td class="text-left">{{$item->penerima_nama}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kwitansi_single', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/keuangan/kwitansi/history.js')}}"></script>


@endsection