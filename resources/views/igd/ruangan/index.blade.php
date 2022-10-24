@extends('igd.layouts.main')

@section('title')
Ruangan - IGD - Medify
@endsection

@section('subtitle')
Ruangan
@endsection

@section('content')


<main id="main-container">
    @include('igd.layouts.navbar')
	<div class="container">
        <div class="block">
            <div class="input-group input-group-lg">
                            <input type="text" id="myInput"class="js-icon-search form-control" placeholder="Cari Pasien">
                {{--
                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                </div>--}}
            </div>
        </div>
        @foreach($ruangan as $key => $ruang)
        <div class="block block-themed">
            @if($ruang->level == 1)
            <div class="block-header bg-danger">
            @elseif($ruang->level == 2)
            <div class="block-header bg-warning">
            @elseif($ruang->level == 3)
            <div class="block-header bg-success">
            @elseif($ruang->level == 4)
            <div class="block-header bg-corporate">
            @else 
            <div class="block-header bg-info">
            @endif
                <h3 class="block-title text-center">{{$ruang->name}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" id="flip{{$key}}" >
                            <i class="si si-arrow-down"></i>
                        </button>
                    </div>
            </div>
        </div>
        <div class="panel" id="panel{{$key}}">

        @for($i = 0; $i < count($pasiens123[$key]);$i++)
                
        <div class="block toSearch">

            <div class="block-content pb-20">
                <div class="row p-0 m-0">
                    <div class="col-md-1 text-center h-100 d-flex align-self-center">
                        <h3 class="mb-0">{{$i+1}}</h3>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h4 class="mb-0">{{$pasiens123[$key][$i]->kasus->identitas->nama or '-'}}<br>
                            <small class="font-w400">
                                @if(!empty($pasiens123[$key][$i]->pasien_detail->gender))
                                    @if($pasiens123[$key][$i]->pasien_detail->gender == 1) Laki laki
                                    @else Perempuan
                                    @endif

                                    , {{$pasiens123[$key][$i]->pasien_detail->age}}
                                @else
                                    @if($pasiens123[$key][$i]->kasus->identitas->jenis_kelamin == "L") Laki laki
                                    @else Perempuan
                                    @endif
                                    , {{$pasiens123[$key][$i]->kasus->identitas->umur}}
                                @endif
                            </small>
                        </h4>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0"><small class="font-w400">Waktu Masuk</small><br>
                            {{date('d F y, H:i', strtotime($pasiens123[$key][$i]->created_at))}}
                        </h5>
                    </div>
                    <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0"><small class="font-w400">Update Terakhir</small><br>
                            @if(date('d F y, H:i', strtotime($pasiens123[$key][$i]->updated_at)) == date('d F y, H:i', strtotime($pasiens123[$key][$i]->created_at)))
                            Data Belum Dimasukkan
                            @else
                            {{date('d F y, H:i', strtotime($pasiens123[$key][$i]->updated_at))}}
                            @endif
                        </h5>
                    </div>
                    <div class="col-md-2 h-100 d-flex align-self-center">
                       <a href="{{url('')}}/igd/transaksi/update-pengisian/{{$pasiens123[$key][$i]->id}}/{{$pasiens123[$key][$i]->kasus->nomor_kasus}}" class="btn btn-primary" type="submit">Pemeriksaan</a>
                    </div>


                </div>
                @include('igd.ruangan.component-transaksi-file',['transaksi'=>$pasiens123[$key][$i]])
            </div>
        </div>
        @endfor
        </div>
        @endforeach
        
	</div>
</main>
@endsection
@section('angular')
<script type="text/javascript">
$('input[type="text"]').keyup(function(){

    var that = this, $allListElements = $('.toSearch');
    $(".panel").toggle(true);
    var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),
            searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });

    $allListElements.hide();
    $matchingListElements.show();

});
 



$(document).ready(function(){
    $("#flip0").click(function(){
            $("#panel0").slideToggle("slow");
        });
    $("#flip1").click(function(){
            $("#panel1").slideToggle("slow");
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
