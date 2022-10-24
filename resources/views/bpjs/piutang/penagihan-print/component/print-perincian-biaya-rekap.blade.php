
@foreach($piutang_new as $item)
@php $total_piutang = 0 @endphp
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>

<h2 style="text-decoration: underline;" class="text-center">PERINCIAN BIAYA</h2>
<br>

<table>
    <tr>
    <td>No Bukti</td>
    <td>:</td>
    <td>PTG{{$item->id}}</td>
    <td width="50px"></td>
    <td>Jenis Pasien</td>
    <td>:</td>
    <td>{{$item->piutang->kasusTagihan->kasus->pembayaran->perusahaan->tipe->nama ?? '-'}}</td>
</tr>
<tr>
    <td>Nama</td>
    <td>:</td>
    <td>{{$item->piutang->pasien->name}}</td>
    <td></td>
    <td>No Register</td>
    <td>:</td>
    <td>{{$item->piutang->pasien->no_rm}}</td>
</tr>
<tr>
    <td>Perusahaan</td>
    <td>:</td>
    <td>{{$item->piutang->perusahaan->nama}}</td>
    <td></td>
    <td>Ruang</td>
    <td>:</td>
    <td>{{$item->piutang->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
</tr>
<tr>
    <td>Alamat</td>
    <td>:</td>
    <td>{{$item->piutang->perusahaan->alamat}}</td>
    <td></td>
    <td>Kelas</td>
    <td>:</td>
    <td>{{$item->kelas_custom ?? $item->piutang->kasusTagihan->kasus->kelas->nama ?? '-'}}</td>
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
        @foreach($item->detail as $kategori_item => $transaksi)

        @if(!empty($transaksi))
        @php $temp_data['pemasukan_detail'] = $transaksi @endphp
        @php $temp_data['kategori'] = $kategori_item @endphp
        @include('keuangan.pemasukan.components-nota.detail-content',$temp_data)

        @endif
        @endforeach

    </tbody>
</table>
<br><br>
<table width="100%">
        <tbody>
            @foreach($item->piutang_subtotal as $key => $subtotal)
            <tr>
                <td width="60%" class="text-right">Subtotal {{$key}}</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    {{number_format($subtotal)}}
                </td>
                {{$total_piutang += $subtotal}}
            </tr>
            @endforeach
            <tr class="table-warning">
                <td width="60%" class="text-right"><strong>TOTAL</strong></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
                <td class="text-right">
                    <strong>{{number_format($total_piutang)}}</strong>
                </td>
            </tr>
        </tbody>
    </table>
<br><br>
@if(!$loop->last)
<pagebreak></pagebreak>
@endif
@endforeach