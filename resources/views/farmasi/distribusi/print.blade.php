<!DOCTYPE html>
<html>
<head>
    <title>Distribusi Permintaan</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            font-size: 13px;
        }
        .bordered {
            border: 1px solid black;
        }
        .dummy{
            color: white;
        }
        .text-center{
            text-align: center;
        }

    </style>
</head>
<body>
    @php $i=1 @endphp
    <table width="100%">
        <tr>
            <td width="100%" style="text-align: center"><img src="{{config('app.kop_lg')}}" height="90"></td>
        </tr>
    </table>
    <br>
    <table style="width: 100vw; font-weight: bold;">
        <tr>
            <td style="text-align: center;  font-size: 21px;">NOTA TRANSAKSI ANTAR UNIT</td>
        </tr>
        <tr>
            <td style="text-align: center;  font-size: 18px;">{{session('farmasi')->sluger}}</td>
        </tr>
    </table>
    <br>
    <table style="width: 100vw;">
        <tr>
            <td style="width:15%">UNIT PENERIMA</td>
            <td style="width:3%">:</td>
            <td style="width:82%">{{strtoupper($distribusi_penerima->owner_detail->nama)}}</td>
        </tr>
        <tr>
            <td>UNIT PENGIRIM</td>
            <td>:</td>
            <td>{{strtoupper($distribusi_pengirim->owner_detail->nama)}}</td>
        </tr>
    </table>
    <br>
    <table style="width: 100vw">
        <tr>
            <td class="bordered" style="text-align: center; width: 7%">NO</td>
            <td class="bordered" style="text-align: center; width: 32%">NAMA BARANG</td>
            <td class="bordered" style="text-align: center; width: 12%">SATUAN</td>
            <td class="bordered" style="text-align: center; width: 15%">PERMINTAAN</td>
            <td class="bordered" style="text-align: center; width: 15%">REALISASI</td>
            <td class="bordered" style="text-align: center; width: 15%">EXP DATE</td>
        </tr>
        @foreach($barang as $barangs)
        <tr>
            <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{$i++}}</td>
            <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{$barangs['nama']}}</td>
            <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{$barangs['satuan']}}</td>
            <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{$barangs['minta']}}</td>
                @if(is_array($barangs['dikasih']) )
                @php $j=0 @endphp
                @foreach($barangs['dikasih'] as $index => $item)
                    @if($j > 0 )
                        <tr>
                        @endif
                        <td class="bordered" style="text-align: center;">{{$item}}</td>
                        <td class="bordered" style="text-align: center;">{{!empty($barangs['kadaluarsa'][$index]) ? date('d/m/Y',strtotime($barangs['kadaluarsa'][$index])) : '-'}}</td>
                        </tr>
                    @php $j++ @endphp
                @endforeach
                @else
                <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{$barangs['dikasih']}}</td>
                <td class="bordered" style="text-align: center;" @if(is_array($barangs['dikasih']) ) rowspan="{{count($barangs['dikasih'])}}" @endif>{{isset($barangs['kadaluarsa']) ? date('d/m/Y',strtotime($barangs['kadaluarsa'])) : '-'}}</td>
                </tr>
                @endif
        @endforeach
    </table>
    <br><br>
    <table style="width: 100vw;">
        @php
            $tanggal_kirim = $distribusi_pengirim->log[0]->created_at ?? $distribusi_pengirim->created_at;
        @endphp
        <tr>
            <td style="text-align: center; width: 50%">Surabaya, {{indonesian_date($distribusi_penerima->verified_at,'d F Y')}}</td>
            <td style="text-align: center; width: 50%">Surabaya, {{indonesian_date($tanggal_kirim,'d F Y')}}</td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50%">Penerima</td>
            <td style="text-align: center; width: 50%">Pengirim</td>
        </tr>
        <tr>


            @if(!empty($penerima) || !empty($pengirim ))
            @if(!empty($penerima->ttd))
            <td style="text-align: center; width: 50%">
                <img src="{{{url('')}}}/{{$penerima->ttd}}" height="75px">
            </td>
            @else
            <td class="dummy" style="font-size: 35px;">.</td>
            @endif
            @if(!empty($pengirim->ttd))
            <td style="text-align: center; width: 50%">
                <img src="{{{url('')}}}/{{$pengirim->ttd}}" height="75px">
            </td>
            @else
            <td class="dummy" style="font-size: 35px;">.</td>
            @endif
            @else
            <td colspan="2" class="dummy" style="font-size: 35px;">.</td>
            @endif

            
        </tr>
        <tr>
            @if($distribusi->tipe == 1)
            <td style="text-align: center; width: 50%">{{$distribusi->verified_by_detail->name ?? '................................................'}}</td>
            <td style="text-align: center; width: 50%">{{$distribusi->distribusi_detail->verified_by_detail->name ?? '................................................'}}</td>
            @else
            <td style="text-align: center; width: 50%">{{$distribusi->distribusi_detail->verified_by_detail->name ?? '................................................'}}</td>
            <td style="text-align: center; width: 50%">{{$distribusi->verified_by_detail->name ?? '................................................'}}</td>
            @endif
        </tr>
        <tr>
            <td colspan="2" class="dummy" style="font-size: 35px;">.</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Mengetahui</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; width: 50%">Koordinator Pengelola Perbekalan Farmasi</td>
        </tr>
        <tr>
            <td colspan="2" class="dummy" style="font-size: 75px;">.</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; width: 50%">................................................</td>
        </tr>
    </table>
</body>
</html>