@extends('gizi.layouts.index')

@section('title')
    {{$bangsal->nama}} - Gizi Monitoring - Medify
@endsection

@section('subtitle')

    {{$bangsal->nama}}
@endsection

@section('content')
    <div class="content px-0" style="background-color: #f5f6f7">
        <div class="text-center py-20">
            <h3 class="mb-0">Bangsal / {{$bangsal->nama}}</h3>
        </div>
    </div>
    <div class="container">
        <div class="row gutters-tiny">
            <div class="col">
                <div class="block text-center" >
                    <div class="block-content">
                        <p class="font-size-h1 mb-5 text-success">
                            <strong>{{$mark['total_pasien']-$mark['belum_pesan']}}</strong>
                        </p>
                        <p class="font-size-md font-w600 text-uppercase">
                            Sudah Pesan Makan
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="block text-center" >
                    <div class="block-content">
                        <p class="font-size-h1 mb-5 text-success">
                            <strong>{{$mark['total_pasien']}}</strong>
                        </p>
                        <p class="font-size-md font-w600 text-uppercase">
                            Total Pasien
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-10">Daftar Pasien</h4>

        <div class="form-group">
            <input type="text" class="form-control fuzzy-search" placeholder="Cari Pasien">
        </div>
        <div id="kasus-rawatinap">
            <ul class="list">
                @php $count = 0; @endphp
                @foreach($bangsal->ruangan as $ruang)
                    @foreach($ruang->bed as $bed)
                        <li>
                            <div class="block">
                                <div class="block-content pb-20 @if(empty($bed->transaksi->pasien)) bg-secondary-lighter @endif ">
                                    <div class="row p-0 m-0">
                                        <div class="col-md-2 text-center h-100 d-flex align-self-center">
                                            <h5 class="mb-0">{{$ruang->nama}} - {{$bed->nama}}</h5>
                                        </div>
                                        <div class="col-md-1 p-0 text-center flex-center-vertically">
                                            @if(!empty($bed->transaksi->pasien))
                                                <img class="img-avatar full-only" src="{{asset('')}}/{{$bed->transaksi->pasien->photo_thumb}}">
                                            @endif
                                        </div>
                                        <div class="col-md-3 h-100 d-flex align-self-center">
                                            <h4 class="mb-0 ">
                                                @if(!empty($bed->transaksi->pasien))
                                                    <span class="nama"> {{$bed->transaksi->pasien->name}}</span>
                                                    <br>
                                                    <small class="font-w400">

                                                        @if($bed->transaksi->pasien->gender == 1) Laki laki
                                                        @else Perempuan
                                                        @endif
                                                        , {{$bed->transaksi->pasien->age}}

                                                        <br>
                                                        No RM : <span class="no_rm"> {{$bed->transaksi->pasien->no_rm}}</span>
                                                        <br>
                                                        MRS : {{$bed->transaksi->waktu_masuk->format('d F Y, H:i')}}
                                                        <span class="dpjp"> DPJP : {{$bed->transaksi->kasus->admin->user->name ?? '-'}} </span></small>
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="col-md-4 h-100 d-flex align-self-center">
                                            @if(!empty($bed->transaksi))
                                                @if($bed->transaksi->kasus_id!=0)
                                                    <h5 class="mb-0"><small class="font-w400">Judul Kasus</small><br>
                                                        <span class="judul_kasus"> {{$bed->transaksi->kasus->judul_kasus}}</span>
                                                        @else
                                                            -
                                                        @endif
                                                        @endif
                                                    </h5>
                                        </div>
                                        <div class="col-md-2 h-100 d-flex align-self-center mt-5">
                                            @if(!empty($bed->transaksi))
                                                @if(is_null($bed->transaksi->kedatangan_at))
                                                    @if($bed->pemesanan == 0)
                                                        <p class="font-w400 ml-10" style="position: relative; top: 5px;">
                                                            <span class="badge badge-danger">Belum Pesan Makan</span></p>
                                                        <br>
                                                    @else
                                                        <p class="font--w400 ml-10" style="position: relative; top: 5px;">
                                                            <span class="badge badge-success">{{$bed->kode_diet}}</span></p>
                                                        <br>
                                                    @endif
                                                @elseif($bed->transaksi->kasus_id!=0)
                                                    @if($bed->pemesanan == 0)
                                                        <p class="font-w400 ml-10" style="position: relative; top: 5px;">
                                                            <span class="badge badge-danger">Belum Pesan Makan</span></p>
                                                        <br>
                                                        @else
                                                        <p class="font--w400 ml-10" style="position: relative; top: 5px;">
                                                            <span class="badge badge-success">{{$bed->kode_diet}}</span></p>
                                                        <br>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($bed->booking_id))
                                    <hr>
                                    <div class="block-content pb-20 @if(empty($bed->transaksi->pasien)) bg-secondary-lighter @endif ">
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 text-center h-100 d-flex align-self-center">
                                            </div>
                                            <div class="col-md-1 p-0 text-center flex-center-vertically">
                                                @if(!empty($bed->booking->pasien))
                                                    <img class="img-avatar full-only" src="{{asset('')}}/{{$bed->booking->pasien->photo_thumb}}">
                                                @endif
                                            </div>
                                            <div class="col-md-3 h-100 d-flex align-self-center">
                                                <h4 class="mb-0">
                                                    @if(!empty($bed->booking->pasien))
                                                        {{$bed->booking->pasien->name}}
                                                        <br>
                                                        <small class="font-w400">
                                                            @if(!empty($bed->booking->pasien))

                                                                @if($bed->booking->pasien->gender == 1) Laki laki
                                                                @else Perempuan
                                                                @endif
                                                                , {{$bed->booking->pasien->age}}
                                                            @endif

                                                            <br>
                                                            No RM : <span class="no_rm"> {{$bed->booking->pasien->no_rm}}</span>
                                                            <br>
                                                            MRS : {{$bed->booking->waktu_masuk->format('d F Y, H:i')}}</small>
                                                        </small>
                                                    @endif
                                                </h4>
                                            </div>

                                            <div class="col-md-4 h-100 d-flex align-self-center">
                                                @if(!empty($bed->booking))
                                                    @if($bed->booking->kasus_id!=0)
                                                        <h5 class="mb-0"><small class="font-w400">Judul Kasus</small><br>
                                                            {{$bed->booking->kasus->judul_kasus}}
                                                            @else
                                                                -
                                                            @endif
                                                            @endif
                                                        </h5>
                                            </div>
                                            <div class="col-md-2 h-100 d-flex align-self-center">
                                                @if(!empty($bed->booking))
                                                    @if(is_null($bed->booking->kedatangan_at))
                                                        @if($bed->pemesanan == 0)
                                                            <p class="font-w400 ml-10" style="position: relative; top: 5px;">
                                                                <span class="badge badge-danger">Belum Pesan Makan</span></p>
                                                            <br>
                                                        @else
                                                            <p class="font--w400 ml-10" style="position: relative; top: 5px;">
                                                                <span class="badge badge-success">{{$bed->kode_diet}}</span></p>
                                                            <br>
                                                        @endif
                                                    @elseif($bed->booking->kasus_id!=0)
                                                        @if($bed->pemesanan == 0)
                                                            <p class="font-w400 ml-10" style="position: relative; top: 5px;">
                                                                <span class="badge badge-danger">Belum Pesan Makan</span></p>
                                                            <br>
                                                        @else
                                                            <p class="font--w400 ml-10" style="position: relative; top: 5px;">
                                                                <span class="badge badge-success">{{$bed->kode_diet}}</span></p>
                                                            <br>
                                                        @endif
                                                    @endif


                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    </main>

@endsection

@section('js')

    <script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
    <script type="text/javascript">
        var options = {
            valueNames: [ 'nama', 'no_rm','judul_kasus','dpjp' ]
        };

        var rawatInapList = new List('kasus-rawatinap', options);

        $(".fuzzy-search").keyup(function(){
            rawatInapList.search($(this).val());
        });
    </script>
@endsection