@extends('igd.layouts.main')

@section('title')
{{$ruangan->name}} - IGD - Medify
@endsection

@section('subtitle')
{{$ruangan->name}}
@endsection

@section('content')
<main id="main-container">
    @include('igd.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="input-group input-group-lg">
                            <input type="text" class="js-icon-search form-control" placeholder="Cari Pasien">
                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                </div>
            </div>
        </div>
        <div class="block block-themed">
            <div class="block-header bg-danger">
                <h3 class="block-title">P1</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" id="flip">
                            <i class="si si-arrow-down"></i>
                        </button>
                    </div>
            </div>
        </div>
        <div class="" id="panel">
        @forelse($pasiens as $index => $pasien)
        <div class="block">

            <div class="block-content pb-20">
                <div class="row p-0 m-0">
                    <div class="col-md-1 text-center h-100 d-flex align-self-center">
                        <h3 class="mb-0">{{$index+1}}</h3>
                    </div>
                    <div class="col-md-1 p-0 ">
                        <img class="img-avatar" src="{{asset('')}}/{{$pasien->pasien_detail->photo_thumb}}">
                    </div>
                    <div class="col-md-4 h-100 d-flex align-self-center">
                        <h4 class="mb-0">{{$pasien->pasien_detail->name}}<br>
                            <small class="font-w400">
                                @if($pasien->pasien_detail->gender == 1) Laki laki
                                @else Perempuan
                                @endif

                                , {{$pasien->pasien_detail->age}}
                            </small>
                        </h4>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0"><small class="font-w400">Waktu Masuk</small><br>
                            {{date('d F y, H:i', strtotime($pasien->created_at))}}
                        </h5>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                       <a href="{{url('')}}/kasus/{{$pasien->kasus->nomor_kasus}}/datamedis" class="btn btn-primary" type="submit">Proses</a>
                    </div>
                </div>
                @include('igd.ruangan.component-transaksi-file',['transaksi'=>$pasien])
            </div>
        </div>
        @empty
        <div class="block">
            <div class="block-content text-center pb-20">
                Tidak ada pasien pada ruangan ini.
            </div>
        </div>
        @endforelse
        </div>
        <div class="block block-themed">
            <div class="block-header bg-danger">
                <h3 class="block-title">P2</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" id="flip2">
                            <i class="si si-arrow-down"></i>
                        </button>
                    </div>
            </div>
        </div>
        <div class="" id="panel2">
        @forelse($pasiens2 as $index => $pasien)
        <div class="block">
            <div class="block-content pb-20">
                <div class="row p-0 m-0">
                    <div class="col-md-1 text-center h-100 d-flex align-self-center">
                        <h3 class="mb-0">{{$index+1}}</h3>
                    </div>
                    <div class="col-md-1 p-0 ">
                        <img class="img-avatar" src="{{asset('')}}/{{$pasien->pasien_detail->photo_thumb}}">
                    </div>
                    <div class="col-md-4 h-100 d-flex align-self-center">
                        <h4 class="mb-0">{{$pasien->pasien_detail->name}}<br>
                            <small class="font-w400">
                                @if($pasien->pasien_detail->gender == 1) Laki laki
                                @else Perempuan
                                @endif

                                , {{$pasien->pasien_detail->age}}
                            </small>
                        </h4>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0"><small class="font-w400">Waktu Masuk</small><br>
                            {{date('d F y, H:i', strtotime($pasien->created_at))}}
                        </h5>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                       <a href="{{url('')}}/kasus/{{$pasien->kasus->nomor_kasus}}/datamedis" class="btn btn-primary" type="submit">Proses</a>
                    </div>


                </div>
                @include('igd.ruangan.component-transaksi-file',['transaksi'=>$pasien])
            </div>
        </div>
        @empty
        <div class="block">
            <div class="block-content text-center pb-20">
                Tidak ada pasien pada ruangan ini.
            </div>
        </div>
        @endforelse
        </div>
        <div class="block block-themed">
            <div class="block-header bg-danger">
                <h3 class="block-title">P3</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" id="flip3">
                            <i class="si si-arrow-down"></i>
                        </button>
                    </div>
            </div>
        </div>
        <div class="" id="panel3">
        @forelse($pasiens3 as $index => $pasien)
        <div class="block">

            <div class="block-content pb-20">
                <div class="row p-0 m-0">
                    <div class="col-md-1 text-center h-100 d-flex align-self-center">
                        <h3 class="mb-0">{{$index+1}}</h3>
                    </div>
                    <div class="col-md-1 p-0 ">
                        <img class="img-avatar" src="{{asset('')}}/{{$pasien->pasien_detail->photo_thumb}}">
                    </div>
                    <div class="col-md-4 h-100 d-flex align-self-center">
                        <h4 class="mb-0">{{$pasien->pasien_detail->name}}<br>
                            <small class="font-w400">
                                @if($pasien->pasien_detail->gender == 1) Laki laki
                                @else Perempuan
                                @endif

                                , {{$pasien->pasien_detail->age}}
                            </small>
                        </h4>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0"><small class="font-w400">Waktu Masuk</small><br>
                            {{date('d F y, H:i', strtotime($pasien->created_at))}}
                        </h5>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                       <a href="{{url('')}}/kasus/{{$pasien->kasus->nomor_kasus}}/datamedis" class="btn btn-primary" type="submit">Proses</a>
                    </div>


                </div>
                @include('igd.ruangan.component-transaksi-file',['transaksi'=>$pasien])
            </div>
        </div>


        @empty
        <div class="block">
            <div class="block-content text-center pb-20">
                Tidak ada pasien pada ruangan ini.
            </div>
        </div>
        @endforelse
    </div>
    </div>
</main>




@endsection
@section('angular')
<script type="text/javascript">


    $( document ).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
        $("#flip2").click(function(){
            $("#panel2").slideToggle("slow");
        });
         $("#flip3").click(function(){
            $("#panel3").slideToggle("slow");
        });
    });
   
</script>
@endsection
