<html>
<head>
    <style type="text/css">
    @page {
     margin: 60px;
     margin-left: 0px;
    }
    body{
        font-style: "Tahoma";
        font-size: 13px;
        text-transform: uppercase;
    }
    .text-center
    {
        text-align: center
    }
    .text-right
    {
        text-align: right;
    }
    .table
    {
        width: 100%;
    }
    table.table,.table th,.table td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 8px;
        font-style: "Tahoma";
        font-size: 11px;
        text-transform: uppercase;
    }
    .date td{
        text-align: center;
    }
    .underline{
        text-decoration: underline;
    }
</style>
</head>
<body style="margin-left: 50px; margin-right: 50px;">
    <table style="width: 100%">
        <tr>
            <th style="width: 15%"></th>
            <th style="width: 2%"></th>
            <th style="width: 28%"></th>
            <th style="width: 55%"></th>
        </tr>
        <tr>
            <td colspan="3" class="">{{config('app.name')}}</td>
            <td colspan="1"></td>
        </tr>
        <tr>
            <td colspan="3" class="underline">{{$kasir->nama}}</td>
            <td class="text-right">{{str_pad($tagihan->id,20,"0",STR_PAD_LEFT)}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center underline">NOTA PEMBAYARAN TAGIHAN PELAYANAN</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td>{{$tagihan->pasien->name}}</td>
            <td></td>
        </tr>
        <tr>
            <td>No RM</td>
            <td>:</td>
            <td>{{$tagihan->pasien->no_rm}}</td>
            <td></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{date('d - m - Y', strtotime($tagihan->paid_date))}}</td>
            <td></td>
        </tr>
    </table>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 22%;">Uraian</th>
                <th style="width: 16%; font-size: 9px; padding-left: 4px;">Departemen</th>
                <th style="width: 15%;">Harga Satuan</th>
                <th style="width: 11%; font-size: 9px;">Jumlah</th>
                <th style="width: 11%; font-size: 9px;">Diskon</th>
                <th style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 0; $curr_date = '00/00/0000'; @endphp
            @foreach($tagihan->detail as $item)
            @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
            <tr class="date">
                <td colspan="7">
                    {{date('d F Y', strtotime($item->created_at))}}
                </td>
            </tr>
            @php $curr_date = $item->created_at; @endphp
            @endif
            <tr>
                <td class="text-center">{{++$count}}</td>
                <td>
                    {{$item->desc}}
                </td>
                <td class="text-center">
                    @if(!empty($item->kategori->kategori->name))
                    {{$item->kategori->kategori->name}}
                    @else
                    {{$item->tarif->departemen->name}}
                    @endif
                </td>
                <td class="text-right">Rp {{number_format($item->unit_price,0)}}</td>
                <td  class="text-center">
                    {{$item->qty}}
                </td>
                <td class="text-center">
                    {{$item->diskon}} %
                </td>
                <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6" class="text-center">Subtotal</td>
                <td class="text-right">
                    Rp {{number_format($tagihan->subtotal)}}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">Diskon</td>
                <td class="text-right" id="diskon">
                    Rp {{number_format($tagihan->diskon)}}
                </td>
            </tr>
            <tr class="table-warning">
                <td colspan="6" class="text-right">Total</td>
                <td class="text-right">
                    Rp {{number_format($tagihan->total_bill)}}
                </td>
            </tr>
            @if($total >= $tagihan->total_bill)
            <tr>
                <td colspan="6" class="text-right">Pembayaran Tunai</td>
                <td class="text-right">Rp {{number_format($pemasukan)}}</td>
            </tr>
            @if($piutang>0)
            <tr>
                <td colspan="6" class="text-right">Melalui Piutang</td>
                <td class="text-right">Rp {{number_format($piutang)}}</td>
            </tr>
            @endif
            <tr>
                <td colspan="6" class="text-right">Kembalian</td>
                <td class="text-right">Rp {{number_format($tagihan->total_paid-$tagihan->total_bill)}}</td>
            </tr>
            @else
            <tr>
                <td colspan="6" class="text-right">Terbayar Tunai</td>
                <td class="text-right" id="total_paid">Rp {{number_format($pemasukan)}}</td>
            </tr>
            @if($piutang>0)
            <tr>
                <td colspan="6" class="text-right">Melalui Piutang</td>
                <td class="text-right">Rp {{number_format($piutang)}}</td>
            </tr>
            @endif
            <tr style="display:none" id="total_paid-par">
                <td colspan="6" class="text-right">Pembayaran Tunai</td>
                <td class="text-right " id="total_paid"></td>
            </tr>
            <tr style="display:none" id="kembalian-par">
                <td colspan="6" class="text-right">Kembalian</td>
                <td class="text-right" id="kembalian"></td>
            </tr>
            @endif
        </tbody>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: 70%"></td>
            <td style="width: 30%; text-align: center;">Dr. Faiq Aminullaha</td>
        </tr>
        <tr>
            <td colspan="2" style="color: white; font-size: 30px;">.</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: center;">(..............................)</td>
        </tr>
    </table>
</body>
</html>