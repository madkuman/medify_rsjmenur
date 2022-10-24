<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @include('kamarjenazah.layouts.css')
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    @include('kamarjenazah.layouts.kop')
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right">
                                <p >{{date("d F Y")}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <h2 style="margin: 0px"><b/>INVOICE KAMAR JENAZAH</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p align="center">#{{$invoice['transaksi_id']}}
                        </tr>
                    </table>
                    <table>
                        <tr style="padding-bottom: 0px;">
                            <td width="50%">
                                <h3 align="left"><b/>Identitas Jenazah</h3>
                            </td>
                            <td>
                                <h3 align="right"><b/>Identitas Penanggung Jawab</h3>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <p align="left">{{$pasien['identitas']['name']}}</p>
                            </td>
                            <td>
                                <p align="right">
                                    @if($jenazah['nama_penanggung'][0]['nama_penanggung'] == '') Tanpa Penanggung
                                    @else {{$jenazah['nama_penanggung'][0]['nama_penanggung']}}
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <p align="left">
                                    @if($pasien['identitas']['gender'] == 1) Laki laki
                                    @else Perempuan
                                    @endif, {{$pasien['identitas']['age']}} Tahun
                                </p>
                            </td>
                            <td>
                                <p align="right">
                                    @if($jenazah['nama_penanggung'][0]['nama_penanggung'] == '') -
                                    @else {{$jenazah['kelamin_penanggung'][0]['kelamin_penanggung']}}, {{$jenazah['usia_penanggung'][0]['usia_penanggung']}} Tahun
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr class="information">
                            <td width="50%">
                                <p align="left">RM : {{$pasien['identitas']['id']}}</p>
                            </td>
                            <td>
                                <p align="right">{{$jenazah['hubungan_penanggung'][0]['hubungan_penanggung']}}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr class="heading">
                <td>
                    Rincian Layanan Perawatan Jenazah
                </td>

                <td colspan="2">
                    Tarif
                </td>
            </tr>
            @if(!empty($invoice))
            @for($i = 0; $i <= $invoice['jumlah']; $i++)
            <tr class="item">
                <td>
                    {{$invoice[$i][0]->nama_layanan}}
                </td>
                <td style="text-align: left">
                    Rp
                </td>
                <td style="text-align: right">
                    {{number_format($invoice[$i][0]->harga_layanan)}}
                </td>
            </tr>
            @endfor
            @endif
            <tr style="padding-top: 50px" class="total">
                <td><strong>Total</strong></td>

                <td style="text-align: left">
                    <strong>Rp</strong>
                </td>
                <td style="text-align: right">
                    <strong>{{number_format($invoice['total'])}}</strong>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
