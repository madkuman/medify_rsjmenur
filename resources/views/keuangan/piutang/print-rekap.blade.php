<!DOCTYPE html>
<html>
<head>
    <title>Perincian Tagihan</title>
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
    <table class="text-center">
        <tr>
            <td>{{config('app.name')}}</td>
        </tr>
        <tr>
            <td>Jl.Menur No. 120, Kode Pos 60282.</td>
        </tr>
        <tr>
            <td>Telp: (031)5021635 Fax: (031)5021637</td>
        </tr>
    </table>
    
    <h2 style="text-decoration: underline;" class="text-center">PERINCIAN BIAYA</h2>
    <br>

    <table>
        <tr>
            <td>No Bukti</td>
            <td>:</td>
            <td>PTG{{$piutang->id}}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$piutang->pasien->name ?? ''}}</td>
        </tr>
        <tr>
            <td>No RM</td>
            <td>:</td>
            <td>{{$piutang->pasien->no_rm}}</td>
        </tr>
        @if(isset($piutang->kasusTagihan->kasus))
        <tr>
            <td>Tanggal MRS</td>
            <td>:</td>
            <td>{{(isset($piutang->kasusTagihan->kasus->mrs_at) ? indonesian_date($piutang->kasusTagihan->kasus->mrs_at) :  indonesian_date($piutang->kasusTagihan->kasus->created_at)) ?? '-'}}</td>
        </tr>
        <tr>
            <td>Tanggal KRS</td>
            <td>:</td>
            <td>{{isset($piutang->kasusTagihan->kasus->krs_at) ? indonesian_date($piutang->kasusTagihan->kasus->krs_at) : '-'}}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td>:</td>
            <td>{{$piutang->kasusTagihan->kasus->admin->user->name ?? '-'}}</td>
        </tr>
        @endif
        <tr>
            <td>Tempat Pelayanan</td>
            <td>:</td>
            <td>{{$piutang->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{$piutang->kasusTagihan->kasus->kelas->nama ?? '-'}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$piutang->pasien->address ?? ''}} {{$piutang->pasien->alamat_kecamatan->nama ?? ''}}, {{$piutang->pasien->alamat_kota->nama ?? ''}}<br></td>
        </tr>
        <tr>
            <td>Jenis Pembayaran</td>
            <td>:</td>
            <td>{{$piutang->pihak_ketiga}}</td>
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
            @foreach($piutang_details as $kategori_item => $transaksi)

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
            @foreach($piutang_subtotal as $key => $subtotal)
            <tr>
                <td width="60%" class="text-right">Subtotal {{$key}}</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($subtotal)}}
                </td>
            </tr>
            @endforeach

            @php $piutang_sebelum_split = 0@endphp
            @foreach($piutang->kasusTagihanSister as $tagihan)
            @php $piutang_sebelum_split += $tagihan->total @endphp
            @endforeach
            
            @if($piutang_sebelum_split != 0)
            <tr>
                <td width="60%" class="text-right">
                    Subtotal
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($piutang->total + $piutang_sebelum_split)}}
                </td>
            </tr>
            @endif

            @foreach($piutang->kasusTagihanSister as $tagihan)
            <tr>
                <td width="60%" class="text-right">
                    @if($tagihan->perusahaan->tunai)
                        Beban Pasien
                    @else
                        Beban {{$tagihan->perusahaan->nama}}
                    @endif
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($tagihan->total)}}
                </td>
            </tr>
            @endforeach

            <tr class="table-warning">
                <td width="60%" class="text-right"><strong>TOTAL</strong></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    <strong>{{number_format($piutang->total)}}</strong>
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