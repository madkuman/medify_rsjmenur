<!DOCTYPE html>
<html>
<head>
    <title>Perincian Pemasukan</title>
    <style type="text/css">
    body{
        font-family: sans-serif;
        font-size: 13px;
        font-weight: 600 !important;
    }
    @page{
        margin-top: 25px;
        margin-bottom: 25px; 
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
    }
    .nogap td{
        line-height: 10px;
    }
    td{
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
    <table width="100%" class="nogap" style="font-size: 14px;">
        <tr>
            <td>RUMAH SAKIT JIWA MENUR SURABAYA PROVINSI JAWA TIMUR</td>
        </tr>
        <tr>
            <td>Jl.Menur No. 120, Kode Pos 60282.</td>
        </tr>
        <tr>
            <td>Surabaya</td>
        </tr>
        <tr>
            <td>Telp: (031)5021635 Fax: (031)5021637</td>
        </tr>
        <tr>
            <td>-----------------------------------------------------</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>No Kwitansi</td>
            <td>:</td>
            <td>INC{{$pemasukan->id}}</td>
        </tr>
        <tr>
            <td>No Medrec</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->no_rm}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td></td>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{date('d M Y')}}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td>:</td>
            <td>@if(!empty($pemasukan->piutang->kasusTagihan)){{$pemasukan->piutang->kasusTagihan->kasus->admin->user->name ?? '-'}} @else {{$pemasukan->piutang->dokter->name ?? '-'}} @endif</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->name ?? ''}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->address ?? ''}} {{$pemasukan->pasien->alamat_kecamatan->nama ?? ''}}, {{$pemasukan->pasien->alamat_kota->nama ?? ''}}<br></td>
        </tr>
        <tr>
            <td>Unit</td>
            <td>:</td>
            <td>{{$pemasukan->piutang->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
        </tr>
    </table>
    <hr>
    <table class="list">
        <tr>
            <td style="font-size: 15px; width: 4%;">No</th>
            <td style="font-size: 15px; width: 36%;">Uraian</th>
            <td style="font-size: 15px; width: 20%; text-align: right;">Subtotal</th>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tbody>

            @php $count = 0 @endphp
            @foreach($pemasukan_details as $tanggal => $kategori_item)
            
            @if(!empty($kategori_item['Tindakan']))
            @php $temp_data['pemasukan_detail'] = $kategori_item['Tindakan'] @endphp
            @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)
            @php $count += count($kategori_item['Tindakan']) @endphp
            @endif

            @if(!empty($kategori_item['Farmasi']))
            @php $temp_data['pemasukan_detail'] = $kategori_item['Farmasi'] @endphp
            @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)
            @php $count += count($kategori_item['Farmasi']) @endphp
            @endif

            @if(!empty($kategori_item['Penunjang']))
            @php $temp_data['pemasukan_detail'] = $kategori_item['Penunjang'] @endphp
            @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)
            @php $count += count($kategori_item['Penunjang']) @endphp
            @endif

            @if(!empty($kategori_item['Lain lain']))
            @php $temp_data['pemasukan_detail'] = $kategori_item['Lain lain'] @endphp
            @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)
            @php $count += count($kategori_item['Lain lain']) @endphp
            @endif

            @endforeach

        </tbody>
    </table>
    <hr width="100%">
    <table width="100%">
        <tbody>
            <tr>
                <td width="60%" class="text-right">Jumlah Total</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                <td class="text-right">
                    @if(!empty($pemasukan->diskon))
                    {{number_format($pemasukan->jumlah + $pemasukan->diskon)}}
                    @else
                    {{number_format($pemasukan->jumlah)}}
                    @endif
                </td>
            </tr>
            <tr class="table-warning">
                <td width="60%" class="text-right"><strong>TUNAI</strong></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                <td class="text-right">
                    <strong>{{number_format($pemasukan->total )}}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="color: white">dummy</td>
            </tr>
        </tbody>
    </table>
    <table width="100%">
        <tr>
            <td width="45%" class="text-center">Operator :</td>
            <td width="10%"></td>
            <td width="45%" class="text-center">Surabaya, {{indonesian_date(date('d F Y'))}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>                
            <td class="text-center">{{$nama_kasir}}</td>
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
                (...................)
            </td>
        </tr>
    </table>
</body>