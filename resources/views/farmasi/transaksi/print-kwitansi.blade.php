<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi</title>
    <style type="text/css">
    table {
        border-collapse: collapse;
        font-size: 15px;
    }
    .bordered {
        border: 1px solid black;
    }
    .small{
        font-size: 13px;
    }
    .dummy{
        color: white;
        font-size: 28px;
    }

</style>
</head>
<body>
    <div style="width:15%; height:200px; position: absolute; top: 0px; left: 0px; border: 1px solid black;">
        <table style="width: 200px; height:200px; transform: rotate(270deg);">
            <tr>
                <td style="font-size: 10px; text-align: center">UNIT PELAYANAN FARMASI</td>
            </tr>
            <tr>
                <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
            </tr>
        </table>
    </div>
    <div style="width:80%; position: absolute; top: 0px; right: 0px;">
        <table style="width: 100vw;">
            <tr>
                <td style="width:100%; text-align: right;">No Kwitansi {{str_pad($transaksi->id, 10, "0", STR_PAD_LEFT)}}</td>
            </tr>            
        </table>
        <table style="width: 100vw;">
            <tr>
                <td style="width:20%;">Sudah terima dari</td>
                <td style="width: 2%;">:&nbsp;</td>
                <td style="width:78%;">{{$pj}}</td>
            </tr>
            <tr>
                <td style="width:20%;">Jumlah Uang</td>
                <td style="width: 2%;">:&nbsp;</td>
                <td style="width:78%;">{{$terbilang}} Rupiah</td>
            </tr>
            <tr>
                <td style="width:20%;">Untuk Pembayaran</td>
                <td style="width: 2%;">:&nbsp;</td>
                <td style="width:78%;">Resep No : {{$transaksi->final_detail->nomor_resep}}, Dokter : {{!empty($dokter) ? $dokter : $transaksi->created_by_detail->name}}</td>
            </tr>
            <tr>
                <td style="width:20%;"></td>
                <td style="width: 2%;"></td>
                <td style="width:78%;">Pro : {{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</td>
            </tr>              
        </table>
        <table style="width: 100vw">
            <tr>
                <td style="width: 75%"></td>
                <td style="width: 25%">Surabaya, {{date('d F Y')}}</td>
            </tr>
            <tr>
                <td colspan="2" style="color: white; font-size: 25px;">.</td>
            </tr>
            <tr>
                <td style="width: 60%; text-align: center;"></td>
                <td style="width: 40%; text-align: center;">Petugas Farmasi</td>
            </tr>
        </table>
        <table style="width: 100vw;">
            <tr>
                <td style="width:20%;">Terbilang</td>
                <td style="width: 2%;">:&nbsp;</td>
                <td style="width:78%;">Rp {{number_format($transaksi->total_biaya_obat)}}</td>
            </tr>
        </table>
    </div>
</body>
</html>