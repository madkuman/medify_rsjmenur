@extends('urikkes.layouts.main')

@section('title')
Histori Transaksi - Medical Checkup
@endsection

@section('subtitle')
Histori Transaksi
@endsection

@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
        <div class="row mb-20">
            <div class="form-group col-6">
                <label for="tanggal">Tanggal Pemeriksaan</label>
                <form method="GET">
                    <div class="row">
                        <div class="col-8 input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="js-datepicker form-control" id="date_start" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" @if(!empty($date_start)) value="{{$date_start->format('d-m-Y')}}" @else value="{{date('d-m-Y')}}" @endif>
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="js-datepicker form-control" id="date_end" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" required data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" @if(!empty($date_end)) value="{{$date_end->format('d-m-Y')}}" @else value="{{date('d-m-Y')}}" @endif>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" id="filter"> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <a href="{{url('pasien')}}" class="btn btn-primary pull-right">Daftarkan Pasien Baru</a>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <h4>Daftar Histori Transaksi</h4>
                <hr>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tabelPegawai">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th>No RM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->pasien_detail->no_rm}}</td>
                            <td>{{$item->pasien_detail->name}}</td>
                            <td>
                                {{$item->pasien_detail->address}}, 
                                @if(!empty($item->pasien_detail->city))
                                {{$item->pasien_detail->alamat_kota->nama}}
                                @endif
                            </td>
                            <td>
                                {{$item->ordered_at->format('d F Y')}}
                            </td>
                            <td>
                                <form method="POST" action="{{url('urikkes/transaksi/layani')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$item->id}}" name="transaksi_id">
                                    @if($item->status==1)
                                    <button class="btn @if($item->is_last) btn-success @else btn-secondary @endif" type="submit">Lihat Hasil</button>
                                    @else 
                                    <button class="btn @if($item->is_last) btn-primary @else btn-secondary @endif" type="submit">Periksa Pasien</button>
                                    <a class="btn btn-danger mt-5" href="{{url('urikkes/transaksi/batalkan/'.$item->id)}}">Batalkan</a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')


<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        columnDefs: [ { orderable: false, targets: [ 0 ] } ],
        pageLength: 10,
        lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
        autoWidth: false
    });
    $('#waktu_awal').click(function(){
        $('#date_start').val('01-01-1970');
    })

</script>
@endsection