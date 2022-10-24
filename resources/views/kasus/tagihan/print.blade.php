<!DOCTYPE html>
<html>
<head>
    <title>Print Tagihan {{$tagihan->id}}</title>
    <style type="text/css">
    @page{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    body{
        font-family: sans-serif; 
        font-size: 11px;
    }
</style>
</head>
<!-- Page Content -->
<body>
    <div class="content">
        <!-- Invoice -->

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="margin-bottom: 0px;">#INV {{$tagihan->id}}</h3>
            </div>
            <div class="block-content">
                <!-- Invoice Info -->
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <div>
                                <p style="font-size: 14px; margin-top: 0px; margin-bottom: 0px;"><b>{{config('app.name')}}</b></p>
                            </div>
                        </td>
                        <td width="50%" align="right">
                            <div>
                                <p style="text-align: right; font-size: 14px; margin-top: 0px; margin-bottom: 0px"><b>{{$kasus->pasien->name}}</b></p>
                                <address style="text-align: right;">
                                    {{$kasus->pasien->no_rm_formatted}}<br>
                                    @if(empty($kasus->pasien->address))
                                    -
                                    @else
                                    {{$kasus->pasien->address}} @endif <br>
                                    @if(!empty($kasus->pasien->alamat_kecamatan->nama))
                                    {{$kasus->pasien->alamat_kecamatan->nama}} @else - @endif , 
                                    @if(!empty($kasus->pasien->alamat_kota->nama))
                                    {{$kasus->pasien->alamat_kota->nama}}
                                    @else - @endif
                                    @if(!empty($kasus->pasien->phone))
                                    {{$kasus->pasien->phone}}
                                    @else - @endif
                                </address>
                            </div>
                        </td>
                    </tr>
                </table>

                <hr width="100%">
                <!-- Table -->
                    <table width="100%">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Uraian</th>
                                <th style="width: 20%;" colspan="2">Harga Satuan</th>
                                <th style="width: 10%;">Jumlah</th>
                                <th style="width: 20%; text-align: right;" colspan="2">Subtotal</th>
                            </tr>
                            <tr>
                                <th colspan="6">
                                    <hr style="margin-bottom: 0px; margin-top: 0px;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $curr_date = '00/00/0000'; @endphp
                            @foreach($tagihan->detail_descending as $key => $item)
                            @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
                            <tr>
                                <td colspan="6" style="text-align: center;">
                                    <hr style="margin-bottom: 0px; margin-top: 0px;">
                                    <b>{{date('d F Y', strtotime($item->created_at))}}</b>
                                    <hr style="margin-bottom: 0px; margin-top: 0px;">
                                </td>
                            </tr>
                            @php $curr_date = $item->created_at; @endphp
                            @endif
                            <tr style="page-break-inside: avoid;">
                                <td class="font-w400">
                                    {{$item->lokasi->nama}} &bull; ({{date('d M y, H:i', strtotime($item->created_at))}})<br>
                                    <b>{{$item->desc}}</b>
                                </td>
                                <td style="vertical-align: middle;">Rp</td>
                                <td style="text-align: right; vertical-align: middle;">
                                    {{number_format($item->unit_price,0)}}
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    {{$item->qty}}
                                </td>
                                <td style="vertical-align: middle;">Rp</td>
                                <td style="text-align: right; vertical-align: middle;">
                                    {{number_format($item->subtotal,0)}}
                                </td>
                            </tr>
                            
                            @if(isset($tagihan->detail_descending[$key+1]))
                            @if (date('d F Y', strtotime($curr_date)) == date('d F Y', strtotime($tagihan->detail_descending[$key+1]->created_at)))
                            <tr>
                                <td colspan="6" style="color: white; border-bottom: 1px solid gainsboro; font-size: 2px;">dummy</td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <hr width="100%" style="margin-top: 20px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="80%">
                                    <h4 class="mb-5 mt-5 pull-right">Total</h4>
                                </td>
                                <td><h4 class="mb-5 mt-5">Rp</h4></td>
                                <td> 
                                    <h4 style="text-align: right">{{number_format($tagihan->total_sum,0)}}</h4>
                                </td>
                            </tr>
                            @if($tagihan->total_paid > 0)
                            <tr>
                                <td width="80%">
                                    <h4 class="mb-0 pull-right">Pembayaran</h4>
                                </td>
                                <td><h4 class="mb-0">Rp</h4></td> 
                                <td>
                                    <h4 style="text-align: right">{{number_format($tagihan->total_paid,0)}}</h4>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <table width="100%">
                        <tr>
                            <td style="padding-top: 12px;" width="3%"><b style="font-size: 30px;">*</b></td>
                            <td style="vertical-align: middle;"><b>belum termasuk biaya administrasi</b></td>
                        </tr>
                    </table>
                <!-- END Table -->
            </div>
        </div>
        <!-- END Invoice -->
    </div>
</body>
<!-- END Page Content -->

</html>