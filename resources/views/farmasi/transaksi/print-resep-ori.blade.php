<!DOCTYPE html>
<html>
<head>
    <title>
        Print Resep
    </title>
    <style>
    table {
        border-collapse: collapse;
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
        font-size: 60px;
        color: white;
    }
    @page{
        margin: 15px;
    }
</style>
</head>
<body>
    @php $count=1; @endphp
    @for($k=0;$k<$total_page;$k++)
    <div class="page-header">
        <div style="width: 65%">
            <b>{{config('app.name')}}</b><br>
            Pelayanan Khusus Peserta BPJS Kesehatan<br><br>
            Poli/UPF: {{{session('farmasi')->sluger}}}
        </div>
        @if($transaksi->kasus_detail && $transaksi->kasus_detail->lokasi->lokasi->lokasi_departemen_id == 2)
        <div style="position: absolute; top: 0px; ; left: 335px; width: 35%;">
            <table style="width: 100vw; font-size: 15px">
                <tr>
                    <td style="width: 100%; border: 1px solid black">
                        Poli : {{{$transaksi->kasus_detail->lokasi->lokasi->nama}}}
                    </td>
                </tr>
            </table>
        </div>
        @endif
    </div>
    <div class="page-content">
        <div style="width: 65%; border: 2px solid black; border-left: 1px solid white;">
            <table style="width: 100vw; font-size: 13px">
                <tr>
                    <td style="color: white; font-size: 5px">.</td><td></td><td></td>
                </tr>
                <tr>
                    <td style="width: 49%">Prop/Dati II</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">............</td>
                </tr>
                <tr>
                    <td style="width: 49%">No.Surat Rujukan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">............</td>
                </tr> 
                <tr>
                    <td style="width: 49%">No. Jaminan Perawatan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">{{{$transaksi->sep_detail ? $transaksi->sep_detail->no_sep : "-"}}}</td>
                </tr> 
                <tr>
                    <td style="width: 49%">Tanggal Rujukan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">{{{ $transaksi->sep_detail ? date('d F Y', strtotime($transaksi->sep_detail->created_at)) : "-"}}}</td>
                </tr> 
                <tr>
                    <td style="width: 49%">No. KP - PHB</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">............</td>
                </tr>     
                <tr>
                    <td style="width: 49%">Jenis Pelayanan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">............</td>
                </tr>     
                <tr>
                    <td style="width: 49%">Status Penderita</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 50%">............</td>
                </tr>     
                <tr>
                    <td colspan="3" style="text-align: center">Tanda tangan tim Pengendali</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center; color: white">((dummy)</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">(...................................)</td>
                </tr>
                <tr>
                    <td style="color: white; font-size: 3px">.</td><td></td><td></td>
                </tr>
            </table>
        </div>
        <div style="position: absolute; top: 77px; ; left: 335px; width: 35%; border-top: 2px solid black;">
            <table style="width: 100vw; font-size: 13px; text-align: center;">
                <tr><td style="color: white; font-size: 5px">.</td></tr>
                <tr>
                    <td>Surabaya, {{indonesian_date($transaksi->dikerjakan_at) ?? indonesian_date($transaksi->created_at)}}</td>
                </tr>
                <tr>
                    <td>Nama &amp; Tanda Tangan</td>
                </tr>
                <tr>
                    <td>Dokter</td>
                </tr>
                <tr>
                    @if(!empty($dokter_ttd))
                    <td class="text-center"><img src="{{{url('')}}}/{{{$dokter_ttd}}}" height="50px"></td>
                    @else
                    <td class="dummy">.</td>
                    @endif
                </tr>
                <tr>
                    <td>{{{$dokter}}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page-content" style="position: absolute; top: 275px; height: 250px;">
        @if($detail[$count]['tipe']==0)
            @for($j=1;$j<=4;$j++)
                @if(isset($detail[$count])) 
                    @if($detail[$count]['tipe']==0)
                        R/ {{{$detail[$count]['nama_obat']}}} 
                        @forelse($detail[$count]['racikan'] as $racikan_detail)
                            {{{$racikan_detail->nama_obat}}}<br>
                        @empty
                        @endforelse
                        ({{{$detail[$count]['satuan']}}}), No {{{$detail[$count]['roman']}}}<br>
                        <span style="font-family: Dejavu Sans, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&int;</span> {{{$detail[$count]['aturan']}}}<hr style="margin-top: 4px; margin-bottom: 4px">
                        @php $count++; @endphp
                    @endif
                @endif
            @endfor
        @else
            @if(isset($detail[$count]))
                R/
                @forelse($detail[$count]['racikan'] as $racikan_detail)
                    {{{$racikan_detail->nama_obat}}}<br>
                @empty
                    {{$detail[$count]['nama_obat']}}<br>
                @endforelse
                ({{{$detail[$count]['satuan']}}}), No {{{$detail[$count]['roman']}}}<br>
                <span style="font-family: Dejavu Sans, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&int;</span> {{{$detail[$count]['aturan']}}}<hr style="margin-top: 4px; margin-bottom: 4px">
                @php $count++; @endphp
            @endif
        @endif
    </div>
    <div class="page-content" style="position: absolute; top: 510px;">
        <table style=" width: 100vw; border-bottom: 2px solid black; font-size: 13px">
            <tr>
                <td style="width: 20%">Pro : Nama Pasien</td>
                <td style="width: 30%">{{{substr($transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien,0,16)}}}</td>
                <td style="width: 12%"> Umur</td>
                <td style="width: 27%">{{{$transaksi->pasien_detail->age ?? "-"}}} tahun 
                    @if(!empty($transaksi->pasien_detail))
                        ({{{date('d/m/Y', strtotime($transaksi->pasien_detail->date_of_birth))}}})
                    @endif
                </td>
                <td style="width: 5%">Kode</td>
                <td style="width: 3%">-</td>
            </tr>
            <tr>
                <td style="width: 20%">No BPJS </td>
                <td style="width: 30%">{{{$transaksi->pembayaran_detail->no_asuransi ?? ''}}}</td>
                <td style="width: 12%"> No RM</td>
                <td style="width: 27%">{{{$transaksi->pasien_detail->no_rm ?? '-'}}}</td>
                <td style="width: 5%"></td>
                <td style="width: 3%"></td>
            </tr>
        </table>
    </div>
    <div class="page-content" style="position: absolute; top: 555px; width: 40%;">
        <table style="width: 100vw; font-size: 14px;">
            <tr><td style="color: white; font-size: 5px">.</td></tr>
            <tr>
                <td style="text-align: left;">No. Resep : {{{$transaksi->ori_detail->nomor_resep}}}</td>
            </tr>
            <tr>
                <td style=" text-align: center;">Tanda tangan pelayan obat</td>
            </tr>
            <tr>
                <td style="color: white; font-size: 60px;">.</td>
            </tr>
            <tr>
                <td style=" text-align: center;">(.............................)</td>
            </tr>
        </table>
    </div>
    <div class="page-content" style="position: absolute; top: 560px; left: 220px; width: 55%;">
        <table style="width: 100vw; border: 2px solid black">
            <tr>
                <td colspan="7" style="font-weight: bold; text-align: center; border: 2px solid black">TANDA TERIMA OBAT</td>
            </tr>
            <tr>
                <td style="font-size: 13px; width: 10%">&nbsp;&nbsp;1.</td>
                <td colspan="3" style="font-size: 13px; width: 43%;"> Jumlah tab/kap/amp/btl</td>
                <td style="font-size: 13px; width: 2%;"></td>
                <td style="font-size: 13px; width: 15%;"></td>
                <td style="font-size: 13px; width: 30%;"></td>
            </tr>
            @php $i=2 @endphp
            @foreach($transaksi->ori_detail->resep_detail as $det)
            <tr>
                <td style="font-size: 13px;">&nbsp;&nbsp;{{{$i++}}}.</td>
                <td style="font-size: 13px; width: 16%">{{{$det->jumlah}}}</td>
                <td style="font-size: 13px; width: 10%">s.d.a</td>
                <td style="font-size: 13px; width: 17%">{{{$det->satuan}}}</td>
                <td style="font-size: 13px;"></td>
                <td style="font-size: 13px;"></td>
                <td style="font-size: 13px;"></td>
            </tr>
            @endforeach
            <!-- <tr>
                <td style="font-size: 13px;">&nbsp;&nbsp;3.</td>
                <td style="font-size: 13px;">.........</td>
                <td style="font-size: 13px;">s.d.a</td>
                <td style="font-size: 13px;">.........</td>
                <td style="font-size: 13px;">=</td>
                <td style="font-size: 13px; border-bottom: 1px solid black">Harga</td>
                <td style="font-size: 13px; border-bottom: 1px solid black">Rp.______</td>
            </tr> -->
            <tr>
                <td colspan="5" style="font-size: 13px;"></td>
                <td style="font-size: 13px;"></td>
                <td style="font-size: 13px; color: white">dummy</td>
            </tr>
            <tr>
                <td colspan="7" style="font-size: 13px;">&nbsp;&nbsp;Tanda tangan Penerima &nbsp;&nbsp;&nbsp;&nbsp; : ....................</td>
            </tr>
            <!-- <tr>
                <td colspan="7" style="font-size: 15px; text-align: center">NAMA TERANG</td>
            </tr> -->
            <tr>
                <td colspan="7" style="font-size: 13px;">&nbsp;&nbsp;Hubungan Keluarga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : P / I / S / A</td>
            </tr>
            <tr>
                <td colspan="7" style="color: white; font-size: 10px;">.</td>
            </tr>
        </table>
    </div>
    <?php if($k+1<$total_page) { ?>
    <div style="page-break-after: always;"></div>
    <?php } ?>
    @endfor
</body>
</html>