<!--
@extends('layouts.main-simple')

@section('content')
<div class="row justify-content-center mt-100" >
    <div class="col-6">
        <div class="block-content">
            <div class="text-center">
                <h6 class="mb-0">Klinik Percobaan</h6>
                <p class="mb-0">{{ $resep->doctor['name'] }}</p>
                <p class="mb-0">0822-1313-9900</p>
           </div>

            <hr>
            <div class="py-10">
                <span class="float-right"> {{ $resep->tanggal }} </span>
            </div>

            @foreach ( $resep->resepDetail as $resepDetail )

            <span class="text-muted font-w400"> {{ $resepDetail->type }} </span><br>
            @if($resepDetail->kategori == 'racikan')
            <span class="font-w600 mb-5" style="white-space: pre;">{{ $resepDetail->racikan }} </span>
            @else
            <span class="font-w600 mb-5 mt-5"> {{ $resepDetail->obat_name }} </span>
            @endif
            <br>
            <span>{{ $resepDetail->jumlah }}, </span>
            <span>{{ $resepDetail->aturan }}</span>
            <hr>

            @endforeach

            <div class="py-20"></div>
            <h6 class="mb-5">Pro</h6>
            <span>{{$kasus->pasien->name}}</span><br>

            @if($kasus->pasien->gender == 1)
            <span>Laki laki,</span>
            @else
            <span>Perempuan,</span>
            @endif

             <span>{{$kasus->pasien->age}} tahun</span><br>
            @if($kasus->jenis_pasien == 1)
            <span>Pasien Umum</span>
            @elseif($kasus->jenis_pasien == 2)
            <span>Pasien BPJS</span>
            @elseif($kasus->jenis_pasien == 3)
            <span>Pasien Kerjasama</span>
            @endif

        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
    window.print()
</script>
-->