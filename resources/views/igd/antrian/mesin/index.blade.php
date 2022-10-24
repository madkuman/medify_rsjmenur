@extends('igd.layouts.blank')

@section('title')
Mesin Antrian IGD
@endsection

@section('css')
<style type="text/css">
main {display: block;}
#print {display: hide;}
    h1{
        font-size: 60px;
    }

@media print {
    @page {
        size: 300mm 300mm;
    }

    html, body {
        background-color: white;
        margin-left: 15px;
        padding: 0px;
        width: 100mm;
        height: 10mm;
    }
    h1{
        font-size: 60px;
    }
    main {display: none;}
    #print {display: block;}
}
.fw-600{
    font-weight: 600;
}
.ws-pre{
    white-space: pre-wrap;
}
</style>

@endsection

@section('content')
<main class="container" style="padding-top: 75px">
    <div class="text-center">
        <img src="{{asset(config('app.logo_url'))}}" width="12%">
    </div>
    <h2 class="text-center mb-0 mt-10 fw-600">CETAK ANTRIAN</h2>
    <h4 class="text-center mb-30">Cetak nomor antrian pasien berdasarkan tingkat urgensitas</h4>
    <div class="row mb-20">
        @php $i=1; @endphp
        @foreach($level as $item)
        <div class="col-4">
            <a type="btn" class="btn btn-block btn-hero {{$item->class}} button-print mt-0 text-center" data-levelid="{{$item->id}}" style="height: 200px;">
                <span class="text text-light h4">{{$item->nama}}</span>
                <span class="loading hide"><i class="fa fa-spin fa-spinner fa-4x"></i></span>
                <div class="text-center mt-15 mb-10">
                    @if($i==1)
                    <img src="{{asset('assets/img/igd/high.png')}}" width="32%">
                    @elseif($i==2)
                    <img src="{{asset('assets/img/igd/medium.png')}}" width="32%">
                    @elseif($i==3)
                    <img src="{{asset('assets/img/igd/low.png')}}" width="32%">
                    @endif
                </div>
                @if($i==1)
                <h5 class="text text-light text-center ws-pre">Antrian pasien urgensitas tinggi</h5>
                @elseif($i==2)
                <h5 class="text text-light text-center ws-pre"">Antrian pasien urgensitas menengah</h5>
                @elseif($i==3)
                <h5 class="text text-light text-center ws-pre">Antrian pasien urgensitas rendah</h5>
                @endif
            </a>
            @if($i==1)
            <br>
            Antrian Tersisa : <span id="sisa-1"></span>
            @elseif($i==2)
            <br>
            Antrian Tersisa : <span id="sisa-2"></span>
            @elseif($i==3)
            <br>
            Antrian Tersisa : <span id="sisa-3"></span>
            @endif
                @php $i++; @endphp
        </div>
        @endforeach
        <div class="col-12 text-center pt-50">
            Diupdate terakhir pada : <span id="tanggal-last-update"></span>
        </div>
    </div>
    <!-- <button class="btn btn-block btn-hero button-reset">
        Reset
    </button> -->
</main>
<div id="print" class="hide" style="width: 315px;height: 300px;overflow-y: hidden;">
    <div class="text-center">
        <h4 class="mb-5">IGD</h4>
        <h4>{{config('app.name')}}</h4>
        <h1 id="antrian-nomor">
            A001
        </h1>
        <h5>Level Prioritas : </span><span id="level_prioritas">High</h5>
        <h5>Waktu Cetak : </span><span id="waktu_cetak"></h5>

        <br><br><br>
        <span style="font-weight: 800;">________</span>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.button-print').click(function(){
        $(this).find('.text').hide();
        $(this).find('.loading').show();
        var level_id = $(this).data('levelid');
        disabledAllButton(true)
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: API_URL + '/igd/antrian-mesin/request/'+level_id,
            tryCount : 0, 
            retryLimit : 3,
            success: function (result) {
             $('#antrian-nomor').text(result.nomor_antrian);
             $('#level_prioritas').text(result.level_prioritas);
                
             var CurrentDate = moment().format("Do MMM, HH:mm");;
             $('#waktu_cetak').text(CurrentDate)
             reset();
             window.print();
             getAntrianIGDLeft();

         },
         error : function(xhr, textStatus, errorThrown ) {
            if (textStatus == 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }            
                return;
            }
            if (xhr.status == 500) {
                alert('error 500 - silahkan coba lagi');
                reset();
            } else {
                alert('error, silahkan coba lagi');
                reset();
            }
        }
    });

    })

    function disabledAllButton(val){
        $('.button-print').prop('disabled', val);
    }

    $('.button-reset').click(function(){
        reset()
    })

    function reset()
    {
        disabledAllButton(false)
        $('.text').show();
        $('.loading').hide();
    }


    function getAntrianIGDLeft() {
        $.ajax({
            url: "{{url('')}}/api/igd/get-antrian-igd-left",
            dataType: 'json',
            cache: false,
            type: 'GET',
            error: function(){
                countUnread();
            },
            success: function(result) {
                var CurrentDate = moment().format("Do MMM, HH:mm:ss");;
                $('#tanggal-last-update').text(CurrentDate);
                if (result) {
                    $('#sisa-1').text(result.p1);
                    $('#sisa-2').text(result.p2);
                    $('#sisa-3').text(result.p3);
                }
                setTimeout(function () {
                    getAntrianIGDLeft();
                }, 30000);
            },
            timeout: 5000
        });
    }
    
    $(document).ready(function(){
        getAntrianIGDLeft();
    });
</script>
@endsection
