<!DOCTYPE html>
<html>
<head>
    <title>Perincian Pemasukan</title>
    <style type="text/css">
    body{
        font-family: sans-serif;
        font-size: 100%;
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
    .table th {
        padding: 8px;
    }
    .date td{
        text-align: center;
    }
    .list td{
            font-size: 12px;
        }
</style>
</head>
<body>
    <table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
    </tr>
</table>
    
    <h2 style="text-decoration: underline;" class="text-center">PERINCIAN BIAYA</h2>

    <table>
        <tr>
            <td>No Bukti</td>
            <td>:</td>
            <td>INC{{$pemasukan->id}}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->name ?? ''}}</td>
        </tr>
        <tr>
            <td>No RM</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->no_rm}}</td>
        </tr>
        <tr>
            <td>Tanggal MRS</td>
            <td>:</td>
            <td>{{(isset($pemasukan->piutang->kasusTagihan->kasus->mrs_at) ? indonesian_date($pemasukan->piutang->kasusTagihan->kasus->mrs_at) :  indonesian_date($pemasukan->piutang->kasusTagihan->kasus->created_at)) ?? '-'}}</td>
        </tr>
        <tr>
            <td>Tanggal KRS</td>
            <td>:</td>
            <td>{{isset($pemasukan->piutang->kasusTagihan->kasus->krs_at) ? indonesian_date($pemasukan->piutang->kasusTagihan->kasus->krs_at) : '-'}}</td>
        </tr>
        @if(!empty($pemasukan->piutang->kasusTagihan))
        <tr>
            <td>Dokter</td>
            <td>:</td>
            <td>{{$pemasukan->piutang->kasusTagihan->kasus->admin->user->name ?? '-'}}</td>
        </tr>
        @endif
        <tr>
            <td>Tempat Pelayanan</td>
            <td>:</td>
            <td>{{$pemasukan->piutang->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{$pemasukan->piutang->kasusTagihan->kasus->kelas->nama ?? '-'}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$pemasukan->pasien->address ?? ''}} {{$pemasukan->pasien->alamat_kecamatan->nama ?? ''}}, {{$pemasukan->pasien->alamat_kota->nama ?? ''}}<br></td>
        </tr>
        <tr>
            <td>Jenis Pembayaran</td>
            <td>:</td>
            <td>{{$pemasukan->pihak_ketiga}}</td>
        </tr>
    </table>
    <hr>
    <table class="table table-striped list" >
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 30%;">Uraian</th>
                <th style="width: 20%;">Harga Satuan</th>
                <th style="width: 20%;">Jumlah</th>
                <th style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>

            @php $count = 0 @endphp
            @foreach($pemasukan_details as $kategori_item => $transaksi)

            @if(!empty($transaksi))
            @php $temp_data['pemasukan_detail'] = $transaksi @endphp
            @php $temp_data['kategori'] = $kategori_item @endphp
            @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)

            @endif
            @endforeach

        </tbody>
    </table>
    <hr width="100%">
    <table width="100%">
        <tbody>
            @foreach($pemasukan_subtotal as $key => $subtotal)
            <tr>
                <td width="60%" class="text-right">Subtotal {{$key}}</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($subtotal)}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td width="60%" class="text-right">Subtotal</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    @if(!empty($pemasukan->diskon))
                    {{number_format($pemasukan->jumlah + $pemasukan->diskon)}}
                    @else
                    {{number_format($pemasukan->jumlah)}}
                    @endif
                </td>
            </tr>
            <tr>
                <td width="60%" class="text-right">Diskon</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($pemasukan->diskon)}}
                </td>
            </tr>

            <tr>
                <td width="60%" class="text-right">Deposit</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($pemasukan->total_deposit)}}
                </td>
            </tr>
            <tr class="table-warning">
                <td width="60%" class="text-right"><strong>TOTAL</strong></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    <strong>{{number_format($pemasukan->jumlah - $pemasukan->total_deposit )}}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="color: white">dummy</td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>Terbilang: {{$banyaknya_uang}} Rupiah</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">{{indonesian_date(date('d F Y'))}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">{{$nama_kasir}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">
                    (...................)
                </td>
            </tr>
        </tbody>
    </table>
</body>