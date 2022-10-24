
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>
<br>

<h4 class="text-center">DAFTAR TAGIHAN</h4>
<h4 class="text-center">@foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach</h4>
<br>

<table class="table table-bordered table-vcenter">
    <tr class="none-bold">
        <th>NO</th>
        <th>NAMA</th>
        <th>NO. PIUTANG</th>
        <th>JUMLAH</th>
    </tr>

    @php $total = 0 @endphp

    @foreach($piutang as $item)
    <tr>
        <td class="text-center">{{$loop->iteration}}</td>
        <td>{{$item->pasien->name}}</td>
        <td class="text-center">PTG{{$item->id}}</td>
        <td class="text-right">Rp {{number_format($item->total)}} </span></td>
    </tr>
    @php $total = $total + $item->total @endphp
    @endforeach
    <tr>
        <th colspan="3">Total</th>
        <th  class="text-right">Rp {{number_format($total)}}</th>
    </tr>
</table>

<br>
<br>
