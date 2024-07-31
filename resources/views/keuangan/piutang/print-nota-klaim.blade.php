<!DOCTYPE html>
<html>
<head>
    <title>Perincian Biaya Piutang - Klaim</title>
    <style type="text/css">
        @page{
            margin: 10mm;
            margin-top: 0px !important;
            size: 210mm 270mm;
        }
        body{
            font-family: sans-serif;
            font-size: 11px;
            font-weight: bold;
        }
        .table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
        }
        .table-bordered, .table-bordered th {
            border: 1px solid #000;
        }
        .table-bordered td {
            font-weight: normal;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }

        .table-bordered td, .table-bordered th{
            padding: 4px;
        }
        .text-left {
            text-align: left
        }
        .text-right {
            text-align: right
        }
        .float-right{
            float: right;
        }

        .text-center
        {
            text-align: center
        }
        td.hr{
            border-bottom: 1px solid  #000;
        }
        tr.none-bold th
        {
            font-weight: 400;
        }
        li{
            margin: 10px 0;
        }
        .footer {
            position: fixed;
            bottom: 0px;
        }
        h2
        {
            font-weight: 800;
        }

        .table
        {
            width: 100%;
        }
        table.table,.table th,.table td {
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 2px;
            vertical-align: top
        }
        .date td{
            text-align: center;
        }
        .list{
            width: 100%;
        }
        .list td{
            font-size: 12px;
            vertical-align: top;
        }
        .nogap td{
            line-height: 10px;
        }
        hr{
            margin-top: 5px; 
            margin-bottom: 5px;
        }
        .pemasukan-show{
            display: table-cell !important;
        }
        .pemasukan-hide{
            display: none;
        }
        .f-13{
            font-size: 13px;
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="5">
        <tr>
            <td width="15%" align="right">
                <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
            </td>
            <td width="70%" align="center" >
                <p style="font-size: 14px;">
                    RUMAH SAKIT JIWA MENUR SURABAYA PROVINSI JAWA TIMUR<br>
                    Jl.Menur No. 120, Kode Pos 60282. Surabaya <br>
                    Phone Telp: (031)5021635 Fax: (031)5021637
                </p>
            </td>
            <td width="15%" align="left" >
                <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
            </td>
        </tr> 
    </table>
    <table class="table">
        <tr>
            <td class="text-center" style="font-size: 14px;"><b>KWITANSI @if(isset($piutang->kasusTagihan)) @if($piutang->kasusTagihan->kasus->tipe_ri == 1) RAWAT INAP @else RAWAT JALAN @endif @else PELAYANAN @endif</b></td>
        </tr>
    </table>
    <br>
    <table class="table">
        <tr>
            <td width="20%">No Medrec</td>
            <td width="1%">:</td>
            <td width="34%">{{$piutang->pasien->no_rm ?? '-'}}</td>
            <td width="20%">Kelompok Pasien</td>
            <td width="1%">:</td>
            <td width="24%">{{$piutang->kasusTagihan->kasus->pembayaran->perusahaan->tipe->nama ?? '-'}}</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td>{{$piutang->pasien->name ?? '-'}}</td>
            <td>Umur</td>
            <td>:</td>
            <td>{{$piutang->pasien->age ?? '-'}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$piutang->pasien->address ?? '-'}}</td>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{$piutang->pasien->alamat_kecamatan->nama ?? ''}}</td>
        </tr>
        <tr>
            <td>
                @if(isset($piutang->kasusTagihan) && $piutang->kasusTagihan->kasus->tipe_ri == 1)
                Tgl Masuk
                @else
                Tgl Pelayanan
                @endif
            </td>
            <td>:</td>
            <td>
                {{isset($piutang->kasusTagihan) ? $piutang->kasusTagihan->kasus->created_at ? indonesian_date(date('j M Y', strtotime($piutang->kasusTagihan->kasus->created_at))) : '' : indonesian_date(date('j M Y', strtotime($piutang->tanggal_transaksi)))}}
                {{isset($piutang->kasusTagihan) ? $piutang->kasusTagihan->kasus->created_at ? date(', H:i', strtotime($piutang->kasusTagihan->kasus->created_at)) : '' : date(', H:i', strtotime($piutang->tanggal_transaksi))}}
            </td>
            <td>Dirawat Unit</td>
            <td>:</td>
            <td>{{$piutang->lokasi->nama ?? '-'}}</td>
        </tr>
        <tr>
            @if(isset($piutang->kasusTagihan) && $piutang->kasusTagihan->kasus->tipe_ri == 1)
            <td>Tgl Keluar</td>
            <td>:</td>
            <td>
                {{$piutang->kasusTagihan->kasus->krs_at ? indonesian_date(date('j M Y', strtotime($piutang->kasusTagihan->kasus->krs_at))) : ''}}
                {{$piutang->kasusTagihan->kasus->krs_at ? date(', H:i', strtotime($piutang->kasusTagihan->kasus->krs_at)) : ''}}
            </td>
            @else
            <td>Dokter</td>
            <td>:</td>
            <td>@if(!empty($piutang->kasusTagihan)){{$piutang->kasusTagihan->kasus->admin->user->name ?? '-'}} @elseif(!empty($piutang->transaksi_rawat_jalan)) {{$piutang->transaksi_rawat_jalan->dokter->name ?? '-'}} @else {{$piutang->dokter->name ?? '-'}} @endif</td>
            @endif
            <td>Spesialisasi</td>
            <td>:</td>
            <td>{{$piutang->kasusTagihan->kasus->kategori_pasien}}</td>
        </tr>
        <tr>
            @if(isset($piutang->kasusTagihan) && $piutang->kasusTagihan->kasus->tipe_ri == 1)
            <td>Dokter</td>
            <td>:</td>
            <td>@if(!empty($piutang->kasusTagihan)){{$piutang->kasusTagihan->kasus->admin->user->name ?? '-'}} @else {{$piutang->dokter->name ?? '-'}} @endif</td>
            @else
            <td></td>
            <td></td>
            <td></td>
            @endif
            <td>Status Pulang</td>
            <td>:</td>
            <td>{{$piutang->kasusTagihan->kasus->status_krs->nama ?? ''}}</td>
        </tr>
    </table>
    <br>
    <hr width="100%">
    <table class="list">
        <tr>
            <th style="width: 5%;">Tgl</th>
            <th style="width: 35%;">Uraian</th>
            <th style="width: 20%;" colspan="2">Harga Satuan</th>
            <th style="width: 20%;">Jumlah</th>
            <th style="width: 20%;" colspan="2" align="right">Subtotal</th>
        </tr>
        <tr>
            <th colspan="7">
                <hr style="margin-bottom: 0px; margin-top: 0px;">
            </th>
        </tr>

        @php $count = 0 @endphp
        @foreach($piutang_details as $tanggal => $kategori_item)
        <tr class="date">
            <td colspan="7">
                <hr>
                {{$tanggal}}
                <hr>
            </td>
        </tr>
        @if(!empty($kategori_item['Tindakan']))
        @php $temp_data['pemasukan_detail'] = $kategori_item['Tindakan'] @endphp
        @php $temp_data['kategori'] = 'Tindakan' @endphp
        @include('keuangan.piutang.components-nota.klaim-content',$temp_data)
        @endif

        @if(!empty($kategori_item['Farmasi']))
        @php $temp_data['pemasukan_detail'] = $kategori_item['Farmasi'] @endphp
        @php $temp_data['kategori'] = 'Farmasi' @endphp
        @include('keuangan.piutang.components-nota.klaim-content',$temp_data)
        @endif

        @if(!empty($kategori_item['Penunjang']))
        @php $temp_data['pemasukan_detail'] = $kategori_item['Penunjang'] @endphp
        @php $temp_data['kategori'] = 'Penunjang' @endphp
        @include('keuangan.piutang.components-nota.klaim-content',$temp_data)
        @endif

        @if(!empty($kategori_item['Pemulasaran Jenazah']))
        @php $temp_data['pemasukan_detail'] = $kategori_item['Pemulasaran Jenazah'] @endphp
        @php $temp_data['kategori'] = 'Pemulasaran Jenazah' @endphp
        @include('keuangan.piutang.components-nota.klaim-content',$temp_data)
        @endif

        @if(!empty($kategori_item['Lain lain']))
        @php $temp_data['pemasukan_detail'] = $kategori_item['Lain lain'] @endphp
        @php $temp_data['kategori'] = 'Lain lain' @endphp
        @include('keuangan.piutang.components-nota.klaim-content',$temp_data)
        @endif

        @endforeach

    </table>
    <hr width="100%">
    <table width="100%">
        <tbody>
            <tr>
                <td width="60%" class="text-right">Jumlah Total</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                <td class="text-right">
                    <strong>{{number_format($piutang->total)}}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="color: white">dummy</td>
            </tr>
        </tbody>
    </table>
    <table width="100%">
        <tr>
            <td width="45%" class="text-center"></td>
            <td width="10%"></td>
            <td width="45%" class="text-center">Surabaya, {{indonesian_date(date('d F Y'))}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>                
            <td class="text-center">Petugas</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="text-center">
                {{$nama_kasir}}
            </td>
        </tr>
    </table>
</body>
</html>