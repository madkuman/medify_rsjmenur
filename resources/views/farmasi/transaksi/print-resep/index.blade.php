<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <title>
        Print Resep
    </title>
    <style>
    body{
        border:solid 2px #000;
        padding:10px;
        padding-bottom: 0px;
        font-size: 10px;
    }
    table {
        border-collapse: collapse;
        font-family: sans-serif;
        width: 100%;
    }
    #footer { 
        position: fixed; 
        left: 5px;
        bottom: 0px; 
        right: 0px; 
        height: 20px; 
        width: 50px;
    }
    table.border td{
        border:solid 1px #000;
    }

    thead:before,
    thead:after {
        display: none;
    }

    tbody:before,
    tbody:after {
        display: none;
    }
    .dummy{
        font-size: 60px;
        color: white;
    }
    @page{
        margin: 15px;
        margin-bottom: 0px;
    }
    .vertical-align-top td{
        vertical-align: top
    }
    table td{
        font-size: 10px;
    }
    table.font-8 td{
        font-size: 8px;
    }
    .text-center{
        text-align: center
    }
    table.text-left td{
        text-align: left
    }
    .watermark{
        font-family: sans-serif;
        position:absolute;
        bottom: 109px;
        right: 207px;
        opacity:1;
        font-size: 38px;
        font-weight: bold;
        color:red;
        border: 3px solid red;
        margin-right: 6px;
        -webkit-transform: rotate(-5deg);
    }
</style>
</head>
<body>
    @php $count=1; @endphp
    @foreach($detail as $page => $obat_page)

    @php 
        $slug = $transaksi->kasus_detail->pembayaran->perusahaan->tipe->slug ?? '';
        if($slug == 'bpjs') 
            $print = 'BPJS';
        elseif($slug == 'tunai')
            $print = 'UMUM';
        else
            $print = 'ASURANSI';
    @endphp
    @if($transaksi->cito == 1)
    <div class="watermark">CITO</div>
    @endif
    <table class="vertical-align-top">
        <tr>
            <td style="width: 60%">
                @include('farmasi.transaksi.print-resep.left-header')
                @include('farmasi.transaksi.print-resep.left-resep-info')
                @include('farmasi.transaksi.print-resep.left-resep-content')
                @include('farmasi.transaksi.print-resep.left-pasien')
                @include('farmasi.transaksi.print-resep.left-info')
            </td>
            <td style="width: 40%; padding:10px;text-align: center;height: 50px;">
                @include('farmasi.transaksi.print-resep.right-asuransi')
                @include('farmasi.transaksi.print-resep.right-analisa-resep')
                @include('farmasi.transaksi.print-resep.right-telaah-obat')
                @include('farmasi.transaksi.print-resep.right-konfirmasi')
            </td>
        </tr>
    </table>
    {{-- <div id="footer">{{$page}}/{{count($detail)}}</div> --}}
    @if(!$loop->last)
    <div style="page-break-after: always;"></div>
    @endif
    @endforeach
</body>
</html>