@php $asesmen = json_decode($data_asesmen->val); @endphp
<!DOCTYPE html>
<html>
<head>
	<title>Pengkajian Keperawatan Pasien</title>
	<style type="text/css">
        body {
            font-family: sans-serif;
            margin: -10px -28px;
            font-size: 12px;
            padding: 0px;
        }

        table {
            width: 100%;
            margin: 0px;
            padding: 0px;
            /* border-collapse: collapse; */
        }

        table tr td {
            padding: 2px;
            vertical-align: top;
            page-break-inside: always;
            /* white-space: nowrap; */
        }

        .table-rm {
            border: 1.5px solid #000;
            border-radius: 30%;
        }

        .title {
            margin: 15px 0px;
            text-align: center;
            font-size: 13px;
        }
        .checkbox {
            line-height: 0;
            margin-top: 1.2px;
        }
        .text-center {
            text-align: center;
        }
        .text-justify {
            text-align: justify;
        }
        .v-middle,
        .vertical-align{
            vertical-align: middle;
        }

        .break {
            word-wrap: break-word;
        }
        .alpha {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .bold {
            font-weight: bold;
        }
        p {
            margin-top: 0;
            margin-bottom: 0;
        }
        .cbx::after{
            content: "4";
            line-height: 0.6;
            z-index: 100;
            font-family: ZapfDingbats, sans-serif;
        }
        .cb{
            border: 1px solid black;
            display: inline-block;
            width: 7px;
            height: 7px;
            margin-right: 5px;
        }
        .mt-3 {
            margin-top: 10px;
        }
        .my-3 {
            margin: 10px 0;
        }
        .bg-secondary {
            background-color: grey;
        }
        .text-white {
            color : white
        }
        .m-0 {
            margin: 0;
        }
        .m-1 {
            margin: 5px;
        }
	</style>
    @php
    $tab_space =" &nbsp; &nbsp; &nbsp; &nbsp; " ;
    @endphp
</head>
<body>
	<table cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
        <tr>
            <td width="58%">
                <img src="{{config('app.kop_lg')}}" alt="logo-rs" width="300px" style="margin-top: 10px;"> 
            </td>
            <td width="2%"></td>
            <td class="table-rm">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ (substr($kasus->pasien->name, 0, 30) ?? '-')  . ' ('. ($kasus->pasien->getJenisKelaminLpAttribute() ?? '') .')' }}</td>
                    </tr>
                    <tr>
                        <td width="25%">NO. RM</td>
                        <td>: {{ $kasus->pasien->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>: {{$kasus->pasien->date_of_birth ? indonesian_date(date("d-m-Y", strtotime($kasus->pasien->date_of_birth))) : "-"}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <h2 class="text-center">IDENTIFIKASI BAYI</h2></td>

    <div style="border: 1px solid;">
        <div style="border: 1px solid; background-color: grey; color:white"><h3 class="m-1">KEPERAWATAN</h3></div>
        <div style="margin: 4px;">
            <h4 class="text-center">Bagan Kematangan Neuromuskular</h4>
            <table class="table mews w-100 table-bordered" style="width: 100%;" border="1" cellpadding=0 cellspacing=0>
                <tr class="text-center">
                    <th>Parameter</th>
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <th width="10%">{{$i}}</th>
                    @endfor
                    <th width="10%">Skor</th>
                </tr>
                @foreach($data_bagan_neuromuskular as $bagan_neuromuskular)
                <tr>
                    <td class="v-middle">{!! $bagan_neuromuskular->parameter !!}</td>
                    @php $var = 'neuromuskular_'.$bagan_neuromuskular->variabel; @endphp
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <td class="text-center">
                        @if(!in_array($i, $bagan_neuromuskular->skip))
                        <img src="{{ url('assets/img/asesmen/asesmen-identitikasi-bayi/' . $bagan_neuromuskular->variabel . '_' . $i . '.png') }}" width="73px" alt="">
                        <div class="@if(($asesmen->$var ?? null) != null && $asesmen->$var == $i) cbx @endif mt-3"></div>
                        @endif
                    </td>
                    @endfor
                    <td class="text-center skor_{{$bagan_neuromuskular->variabel}} v-middle">{{$asesmen->$var}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"  class="text-right">Jumlah</td>
                    <td class="text-center total_skor_neuromuskular">{{$asesmen->total_skor_neuromuskular}}</td>
                </tr>
            </table>
            <h4 class="text-center">New Ballard Score</h4>
            <table class="table mews w-100 table-bordered" style="width: 100%;" border="1" cellpadding=0 cellspacing=0>
                <tr class="text-center">
                    <th>Parameter</th>
                    @for($i = -1 ; $i <= 5 ; $i++)
                    <th width="12%">{{$i}}</th>
                    @endfor
                    <th width="8%">Skor</th>
                </tr>
                @foreach($data_bagan_ballard as $ballard)
                <tr>
                    <td class="v-middle">{!! $ballard->parameter !!}</td>
                    @php $var = 'ballard_'.$ballard->variabel; @endphp
                    @foreach($ballard->data as $index => $text)
                    <td class="">
                        <div class="text-justify ">
                            {!! $text !!}
                        </div>
                        <div class="text-center">
                            <div class="@if(($asesmen->$var ?? null) != null && $asesmen->$var == $index - 1) cbx @endif mt-3"></div> <!-- -1 karna index mulai dari 0 -->
                        </div>
                    </td>
                    @endforeach
                    <td class="text-center skor_{{$ballard->variabel}} v-middle">{{$asesmen->$var}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"  class="text-right">Jumlah</td>
                    <td class="text-center total_skor_ballard">{{$asesmen->total_skor_ballard}}</td>
                </tr>
            </table>
            <div class="text-center my-3">
            Maturational assessment of gestational age (New Ballard Score). (Reproduced, with permission, form Ballard Jl., Khoury JC., Wedig K., Wang L., Elters-Walsman Bl., Lipp R. New Ballard Score, expanded to include extremely premature infants. J Pediatr. 1991;119;417.
            </div>
        </div>
    </div>

    <div style="page-break-after: always;"></div>

    <div style="border: 1px solid; padding:4px">
        <h4 class="text-center">Tabel Penilaian Tingkat Kematangan</h4>
        <table class="table w-100 table-borderless tabel-getasi" border="1" cellpadding=0 cellspacing=0>
            <tr class="text-center">
                <td>Nilai</td>
                <td>Minggu</td>
            </tr>
            @php 
                $j = 25 ;
                $total_score = intval($asesmen->total_skor_neuromuskular ?? 0) + intval($asesmen->total_skor_ballard ?? 0);
            @endphp
            @for($i = 0 ; $i <= 50; $i += 5)
            <tr class="text-center {{ ($total_score == $i) ? 'bg-secondary text-white' : '' }}">
                <td>{{$i}}</td>
                <td>{{$j++}}</td>
            </tr>

            @if($i == 50) @continue @endif
            <tr class="text-center {{ ( in_array($total_score , [$i+1, $i+2, $i+3, $i+4])) ? 'bg-secondary text-white' : '' }}">
                <td>{{$i + 1}} - {{$i + 4}}</td>
                <td>{{$j++}}</td>
            </tr>
            @endfor
        </table>
    </div>

</body>
</html>