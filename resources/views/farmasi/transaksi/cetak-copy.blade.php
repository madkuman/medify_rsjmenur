<!DOCTYPE html>
<html>
<head>
    <title>
        Print Resep
    </title>
    <style>
    table {
        border-collapse: collapse;
        width: 100vw;
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
        font-size: 10px;
        color: white;
    }
    @page { margin: 10px; }
    body { margin: 10px; }
    .bold{
        font-weight: bold;
    }
    .centered{
        text-align: center;
    }
</style>
</head>
<body>
    
<table width="100%">
    <tr>
        <td width="100%" style="text-align: center"><img src="{{url('assets/img/kop_menur.png')}}" width="350" height="75"></td>
    </tr>
</table>
    <table><tr><td class="dummy">.</td></tr></table>
    <table>
        <tr>
            <td class="bold" style="text-align: center; font-size: 16px; text-decoration: underline;">COPY RESEP</td>
        </tr>
    </table>
    <br>
    <table style="font-size: 10px">
        <tr>
            <td style="width: 24%">Dari Dokter</td>
            <td style="width: 1%">:</td>
            <td style="width: 25%">{{$transaksi->dokter_nama}}</td>
            <td style="width: 25%"></td>
            <td style="width: 25%"></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ date('d F Y') }}</td>
            <td>Dibuat tgl.</td>
            <td>{{ date('d F Y', strtotime($transaksi->created_at)) }}</td>
        </tr>
        <tr>
            <td>No. Resep</td>
            <td>:</td>
            <td>{{$transaksi->final_detail->nomor_resep}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Pro.</td>
            <td>:</td>
            <td colspan="3">{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</td>
        </tr>
        <tr>
            <td>No RM</td>
            <td>:</td>
            <td colspan="3">{{$transaksi->pasien_detail ? $transaksi->pasien_detail->no_rm : '-'}}</td>
        </tr>
    </table>
    <hr>
    @foreach($transaksi->final_detail->resep_detail as $detail)
    <div style="padding-top: 10px;padding-bottom: 10px; width: 100%">
        R/ {{$detail->nama_obat}} ({{$detail->satuan}}), No {{$detail->detail_asal->roman ?? $detail->roman ?? ''}}<br>
        <span style="font-family: Dejavu Sans, sans-serif;">&int;</span> {{$detail->aturan}}<br>
        <table style="width: 100vw">
            <tr>
                <td style="width: 85%"><hr></td>
                <td style="width: 15%">
                    @if(!empty($detail->detail_asal_id))
                    {{$detail->detail_asal->attr_info_copy_resep->jumlah_diambil > 0 ? 'det '.$detail->detail_asal->attr_info_copy_resep->jumlah_diambil : 'nde'}}
                    @else
                        nde
                    @endif
                </td>
            </tr>
        </table>
    </div>
    @endforeach
    <!-- <table style="font-size: 13px;">
        <tr>
            <td>R/</td>
        </tr>
    </table> -->
</body>
</html>
