@extends('urikkes.layouts.main')

@section('title')
Pemeriksaan Harian - Medical Checkup
@endsection

@section('subtitle')
Pemeriksaan Harian
@endsection

@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
        <div class="row mb-20">
            <div class="form-group col-3">
                <label for="tanggal">Tanggal Pemeriksaan</label>
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="js-datepicker form-control js-datepicker-enabled" id="tanggal" name="tanggal" autocomplete="false" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required="" placeholder="dd-mm-yyyy" @if(!empty($date)) value="{{$date}}" @endif>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary" id="filter"> Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <a href="{{url('pasien')}}" class="btn btn-primary pull-right">Daftarkan Pasien Baru</a>
            </div>
        </div>
        <div id="pasien">
            <div class="row mb-20">
                <div class="col-12">
                    <input type="text" class="search form-control" placeholder="Cari Nama, NRP, Alamat">
                </div>
            </div>
            <div class="list">
                @forelse($transaksi as $index => $antrian)
                <div class="block">
                    <div class="block-content pb-20">
                        <div class="row p-0 m-0">
                            <div class="col-md-1 text-center h-100 d-flex align-self-center">
                                <h3 class="mb-0">{{++$index}}</h3>
                            </div>
                            <div class="col-md-1 text-center p-0 h-100 d-flex align-self-center">
                                <h3 class="mb-0">{{$antrian->nomor_antrian}}</h3>
                            </div>
                            <div class="col-md-1 p-0 h-100 d-flex align-self-center">
                                <img class="img-avatar" src="{{asset('')}}/{{$antrian->pasien_detail->photo_thumb}}">
                            </div>
                            <div class="col-md-3 h-100 d-flex align-self-center">
                                <h4 class="mb-0 pasien-nama">{{$antrian->pasien_detail->name}}<br>
                                    <small class="font-w400">
                                        @if($antrian->pasien_detail->gender == 1) Laki laki
                                        @else Perempuan
                                        @endif
                                        , {{$antrian->pasien_detail->age}}
                                    </small><br>
                                    <small class="text-black pasien-alamat">{{$antrian->pasien_detail->address}}, {{$antrian->pasien_detail->alamat_kota->nama ?? "-"}}</small><br>
                                    
                                </h4>
                            </div>
                            <div class="col-md-3 h-100 d-flex align-self-center">
                                <h5 class="mb-0"><small class="font-w400">Pendaftaran</small><br>
                                    {{date('d F y, H:i', strtotime($antrian->created_at))}}<br>
                                    <small class="font-w400">Paket</small><br>
                                    {{$antrian->transaksi_detail[0]->paket->nama ?? '-'}}

                                    @if($antrian->status==1 && isset($antrian->kasus))
                                    @if(count($antrian->kasus->resumeUrikkes) == 0)
                                    <span class="badge badge-pill badge-danger"><i class="fa fa-exclamation-circle mr-5"></i>Resume Belum Diisi</span>
                                    @else
                                    <span class="badge badge-pill badge-success"><i class="fa fa-check-circle mr-5"></i>Selesai</span>
                                    @endif
                                    @endif
                                </h5><br>
                            </div>
                            <div class="col-md-3 h-100 d-flex align-self-center">
                                <form method="POST" action="{{url('urikkes/transaksi/layani')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$antrian->id}}" name="transaksi_id">
                                    @if($antrian->status==1)
                                    <button class="btn btn-alt-success btn-hero" type="submit">Lihat Hasil Pemeriksaan</button>
                                    @else 
                                    <button class="btn btn-primary btn-hero" type="submit">Periksa Pasien</button>
                                    <a class="btn btn-hero btn-danger mt-5" href="{{url('urikkes/transaksi/batalkan/'.$antrian->id)}}">Batalkan</a>
                                    @endif
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
                @empty
                <div class="block">
                    <div class="block-content text-center pb-20">
                        <h5>Antrian medical checkup untuk hari ini masih kosong</h5>
                        <a href="{{url('pasien')}}" class="btn btn-outline-primary">+ Daftarkan Pasien ke Medical Checkup</a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</main>

@endsection

@section('js')
<script type="text/javascript" src="{{url('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tanggal").datepicker( {
            format: "dd-mm-yyyy",

        });

        $('#filter').on('click', function(){
            date = $('#tanggal').val();
            get(date);
        });


    });

    function get(date){
        console.log(date);
        var url = new URL(window.location.href);
        url.searchParams.set('date', date);
        window.location.href = url.href;
    };

    var options = {
      valueNames: [ 'pasien-nama','pasien-alamat','pasien-nrp']
    };

    var userList = new List('pasien', options);


</script>
@endsection