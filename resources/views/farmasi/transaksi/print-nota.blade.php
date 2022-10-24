<!DOCTYPE html>
<html>
<head>
    <title>Nota</title>
    <style type="text/css">
    .table {
        border-collapse: collapse;
    }
    .bordered {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .small{
        font-size: 13px;
    }
    .dummy{
        color: white;
        font-size: 28px;
    }
    .text-right{
        text-align: right;
    }
    .text-center{
        text-align: center;
    }
</style>
</head>
<body>
    <div style="width: 94%; margin: auto;">
        <table style="width: 100vw; font-weight: bold;">
            <tr>
                <td>{{config('app.name')}}</td>
            </tr>
            <tr>
                <td>PASIEN UMUM</td>
            </tr>
            <tr>
                <td style="text-align: right">No : {{str_pad($transaksi->id, 10, "0", STR_PAD_LEFT)}}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px;">NOTA PEMBELIAN OBAT / ALKES</td>
            </tr>
        </table>
        <br>
        <table style="width: 100vw;">
            <tr>
                <td style="width: 14%">No RM</td>
                <td style="width: 1%">:&nbsp;</td>
                <td style="width: 36%">{{$transaksi->pasien_detail ? $transaksi->pasien_detail->no_rm : "-"}}</td>
                <td style="width: 14%">No Resep</td>
                <td style="width: 1%">:&nbsp;</td>
                <td style="width: 34%">{{$transaksi->final_detail->nomor_resep}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Nama Pasien</td>
                <td style="vertical-align: top">:&nbsp;</td>
                <td style="vertical-align: top">{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</td>
                <td style="vertical-align: top">Nama Dokter</td>
                <td style="vertical-align: top">:&nbsp;</td>
                <td style="vertical-align: top">{{!empty($dokter) ? $dokter : $transaksi->created_by_detail->name}}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:&nbsp;</td>
                <td>{{ date('d F Y', strtotime($transaksi->paid_at)) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>
        <table class="table" style="width: 100vw;">
            <tr>
                <td class="small bordered text-center" style="font-weight: bold; width: 3%">NO</td>
                <td class="small bordered" style="font-weight: bold;">NAMA OBAT/ALKES</td>
                <td class="small bordered text-center" style="font-weight: bold; width: 10%">JUMLAH</td>
                <td class="small bordered text-center" style="font-weight: bold; width: 9%">SATUAN</td>
                <td class="small bordered text-center" style="font-weight: bold; width: 22%">HARGA SATUAN</td>
                <td class="small bordered text-center" style="font-weight: bold; width: 17%">SUBTOTAL</td>
            </tr>
            @php $i=1 @endphp
            @foreach($transaksi->final_detail->resep_detail as $detail)
            @php 
                $jumlah = ($transaksi->status_retur) ? ($detail->jumlah - $detail->logLast->jumlah_retur) : $detail->jumlah;
            @endphp
            <tr>
                <td class="small bordered text-center">{{$i++}}</td>
                <td class="small bordered">&nbsp;{{$detail->nama_obat}}
                    @forelse($detail->racikan as $kan)
                    <br>&nbsp;&nbsp;-&nbsp;{{$kan->obat_detail->item_detail->nama}} : {{$kan->jumlah}}
                    @empty
                    @endforelse
                </td>
                <td class="small bordered text-center">
                    {{$jumlah}}
                </td>
                <td class="small bordered text-center">{{$detail->satuan}}</td>
                <td class="small bordered text-right">{{number_format($detail->harga)}}</td>
                <td class="small bordered text-right">{{number_format($jumlah *$detail->harga)}}</td>
            </tr>
            @endforeach
            <tr>
                <td class="small bordered text-center">{{$i++}}</td>
                <td class="small bordered">&nbsp;Embalase</td>
                <td class="small bordered text-center">1</td>
                <td class="small bordered text-center"></td>
                <td class="small bordered text-right">{{number_format($transaksi->embalase)}}</td>
                <td class="small bordered text-right">{{number_format($transaksi->embalase)}}</td>
            </tr>
            <tr>
                <td class="small bordered" colspan="5">TOTAL</td>
                <td class="small bordered text-right">{{number_format($total_biaya)}}</td>
            </tr>
        </table>
        <br>
        <table style="width: 100vw">
            <tr>
                <td class="small">Terbilang : {{$terbilang}}</td>
            </tr>
            <tr>
                <td class="small" style="text-align: right;">Petugas Farmasi</td>
            </tr>
            <tr>
                <td class="dummy">.</td>
            </tr>
            <tr>
                <td class="small" style="text-align: right;">(.......................)</td>
            </tr>
        </tr>
    </table>
</div>
</body>
</html>