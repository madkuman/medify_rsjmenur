<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width : 100%;
            font-family : sans-serif;
            font-size: 13px;
        }
        table.bordered {
            border: 1px solid #000;
        }
        table.bordered td {
            border: 1px solid #000;
        }
        .td-bordered {
            border: 1px solid #000 !important;
        }
        table.no-border td {
            border: none;
        }
        .big{
            font-size: 17px;
            text-transform: uppercase;
            text-align: center;
        }
        td{
            vertical-align : top
        }
        .h1, .h2, .h3, .h4{
            font-size : 16px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        .h5{
            font-size : 14px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        .h6{
            font-size : 13px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        table td.va-mid {
            vertical-align: middle;
        }
        table td.va-bottom {
            vertical-align: bottom;
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
        .mt-4 {
            margin-top: 4px;
        }
        .mt-0 {
            margin-top: 0;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        p {
            font-family: "Arial";
            font-size: 16px;
        }
        .rounded {
            border-radius: 50%; 
            border: 1px solid #000; 
            padding: 3px; margin: 3px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="15%" align="right">
                <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
            </td>
            <td width="63%" align="center" class="va-mid">
                <p style="font-size: 14px; margin: 0;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                <p style="font-size: 16px; margin: 0;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                <p style="font-size: 12px; margin: 0;"><b>Jln. Menur No.120, Telp. (031) 5021635, 5021637</b></p>
                <p style="font-size: 13px; margin: 0;"><b>S U R A B A Y A</b></p>
            </td>
            <td width="17%" align="left">
                <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px;">
        <tr>
            <td align="center" style="font-size: 16px;"><b>NOTA PENGHAPUSAN</b></td>
        </tr>
    </table>

    <table style="margin-top: 10px;">
        <tr>
            <td width="30%">Unit Penghapus</td>
            <td width="3%">:</td>
            <td width="67%">{{$penghapusan->farmasi->nama ?? "-"}}</td>
        </tr>
        <tr>
            <td>Alasan Penghapusan</td>
            <td>:</td>
            <td>{{$penghapusan->penghapusan_jenis->nama ?? "-"}}</td>
        </tr>
        <tr>
            <td>Tanggal Penghapusan</td>
            <td>:</td>
            <td>
                @if(!empty($penghapusan->tgl_pengeluaran))
                {{ indonesian_date($penghapusan->tgl_pengeluaran) }}
                @else
                {{ indonesian_date($penghapusan->created_at) }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Surat Perintah</td>
            <td>:</td>
            <td>{{$penghapusan->surat_perintah ?? "-"}}</td>
        </tr>
        <tr>
            <td>No Pengeluaran</td>
            <td>:</td>
            <td>{{$penghapusan->no_pengeluaran ?? "-"}}</td>
        </tr>
        <tr>
            <td>Nama Penyedia</td>
            <td>:</td>
            <td>{{$penghapusan->penyedia->nama ?? "-"}}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{$penghapusan->keterangan ?? "-"}}</td>
        </tr>
    </table>

    <table class="bordered" cellpadding="3" style="margin-top: 10px;">
        <tr>
            <td align="center">No.</td>
            <td align="center">Barang</td>
            <td align="center">Jumlah</td>
            <td align="center">Harga Satuan</td>
            <td align="center">Subtotal</td>
        </tr>
        @php $total = 0 @endphp
        @foreach($items as $row)
        @php
        $harga = is_null($row->detail_item->harga_saat_itu) ? $row->detail_item->detail_item->harga : $row->detail_item->harga_saat_itu;
        $total += $harga*$row->jumlah;
        @endphp
        
        <tr>
            <td align="center">{{$loop->iteration}}</td>
            <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
            <td align="center">{{$row->jumlah}} {{$row->detail_item->detail_item->item_detail->satuan}}</td>
            <td align="right">Rp. {{number_format($harga)}}</td>
            <td align="right">Rp. {{number_format($harga*$row->jumlah)}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">Total</td>
            <td align="right">Rp. {{number_format($total)}}</td>
        </tr>
    </table>

    <table style="margin-top: 30px;">
        <tr>
            <td width="50%" align="center">Surabaya, {{indonesian_date($penghapusan->created_at,'d F Y')}}</td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td align="center">Penghapus</td>
            <td align="center">Koordinator Pengelola Perbekalan Farmasi</td>
        </tr>
        <tr>
            @if($penghapusan->created_by_detail->ttd)
            <td align="center"><img src="{{{url('')}}}/{{$penghapusan->created_by_detail->ttd}}" height="75px"></td>
            @else
            <td style="padding-top: 75px;"></td>
            @endif

            <td style="padding-top: 75px;"></td>
        </tr>
        <tr>
            <td align="center">{{$penghapusan->created_by_detail->name ?? "-"}}</td>
            <td align="center">......................................................</td>
        </tr>
    </table>


	{{-- <h1>Penghapusan #{{$penghapusan->slug}}</h1>
	<label>TANGGAL Penghapusan</label>
	<h5>{{ date('d F Y', strtotime($penghapusan->tanggal)) }}</h5>
	<label>NO REFERENSI</label>
	<h4>{{ is_null($penghapusan->nomor_referensi) ? "-" : $penghapusan->nomor_referensi }}</h4>
	<table class="table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $row)

            @php 
            $harga = is_null($row->detail_item->harga_saat_itu) ? $row->detail_item->detail_item->harga : $row->detail_item->harga_saat_itu;
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                <td>{{$row->jumlah}} {{$row->detail_item->detail_item->item_detail->satuan}}</td>
                <td>Rp. {{number_format($harga)}}</td>
                <td>Rp. {{number_format($harga*$row->jumlah)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>
</html>