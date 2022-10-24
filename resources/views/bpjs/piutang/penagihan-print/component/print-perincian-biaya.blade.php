@foreach($piutang as $item)
@php $total_piutang = 0 @endphp
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>
<br><br>
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
        <td>{{$item->kasusTagihan->kasus->pembayaran->perusahaan->tipe->nama ?? '-'}}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{$item->pasien->name}}</td>
        <td></td>
        <td>No Register</td>
        <td>:</td>
        <td>{{$item->pasien->no_rm}}</td>
    </tr>
    <tr>
        <td>Perusahaan</td>
        <td>:</td>
        <td>{{$item->perusahaan->nama}}</td>
        <td></td>
        <td>Ruang</td>
        <td>:</td>
        <td>{{$item->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{$item->perusahaan->alamat}}</td>
        <td></td>
        <td>Kelas</td>
        <td>:</td>
        <td>{{$kelas_custom ?? $item->kasusTagihan->kasus->kelas->nama ?? '-'}}</td>
    </tr>
</table>
<hr>
<br>
<br>

<table class="table table-striped" >
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
        @php $count = 0; $curr_date = '00/00/0000'; @endphp
        @foreach($item->detail as $item_detail)
        @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item_detail->created_at)))
        <tr class="date">
            <td colspan="5">
                <hr>
                {{date('d F Y', strtotime($item_detail->created_at))}}
                <hr>
            </td>
        </tr>
        @php $curr_date = $item_detail->created_at; @endphp
        @endif
        <tr>
            <td class="text-center">{{++$count}}</td>
            <td>
                {{$item_detail->deskripsi}} 
                @if (!empty($item_detail->tarif_tipe_id))
                @if($item_detail->tipe->slug == 'cito')
                <div class="text-muted">{{$item_detail->tipe->nama}}</div>
                @endif
                @endif
            </td>
            <td class="text-right">Rp {{number_format($item_detail->harga,0)}}</td>
            <td  class="text-center">
                {{$item_detail->jumlah}}
            </td>
            <td class="text-right">Rp {{number_format($item_detail->subtotal)}}</td>
            @php $total_piutang += $item_detail->subtotal @endphp
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right">Subtotal</td>
            <td class="text-right">
                Rp {{number_format($total_piutang)}}
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">Diskon</td>
            <td class="text-right" id="diskon">
                Rp {{number_format($item->diskon)}}
            </td>
        </tr>
        @foreach($item->kasusTagihanSister as $tagihan)
        <tr>
           <td colspan="4" class="text-right">
            @if($tagihan->perusahaan->tunai)
            Beban Pasien
            @else
            Beban {{$tagihan->perusahaan->nama}}
            @endif
            </td>
            <td class="text-right" id="diskon">
                Rp {{number_format($tagihan->total)}}
            </td>
        </tr>

        @php $total_piutang -= $tagihan->total @endphp

        @endforeach
        <tr class="table-warning">
            <td colspan="4" class="text-right"><strong>TOTAL TAGIHAN</strong></td>
            <td class="text-right">
                <strong>Rp {{number_format($total_piutang)}}</strong>
            </td>
        </tr>
    </tbody>
</table>

<br><br>

@if(!$loop->last)
<pagebreak></pagebreak>
@endif
@endforeach