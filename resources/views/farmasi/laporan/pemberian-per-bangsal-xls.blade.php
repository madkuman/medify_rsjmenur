<table>
  <thead>
    <tr>
      <th colspan="4">{{config('app.name')}}</th>
    </tr>
    <tr>
      <th colspan="4">DEPARTEMEN FARMASI</th>
    </tr>
    <tr>
      <th colspan="4">{{strtoupper(session('farmasi')->sluger)}}</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th colspan="7">LAPORAN PEMBERIAN OBAT @if(!$bangsal) SEMUA @endif BANGSAL {{$bangsal}}</th>
    </tr>
    <tr>
      <th colspan="7">TANGGAL {{date('d F Y',strtotime($min_date))}} - {{date('d F Y',strtotime($max_date))}}</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    {{-- <tr>
      <th colspan="7">No. RM : {{$pasien->no_rm}}</th>
    </tr>
    <tr>
      <th colspan="7">Nama Pasien : {{$pasien->name}}</th>
    </tr> --}}
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th>NO.</th>
      <th>KODE OBAT</th>
      <th>NAMA OBAT</th>
      <th>SATUAN</th>
      <th>JUMLAH</th>
      <th>HARGA SATUAN</th>
      <th>HARGA</th>
    </tr>

    @php $i=1 @endphp
    <?php $total_1=0; $total_2=0; $total_3=0;?>
    @foreach($items as $row)
    <tr>
      <td colspan="2">
        <b>Tanggal : {{date('d-M-Y',strtotime($row->paid_at))}}</b>
      </td>
      <td>
        <b>No. Resep : {{$row->final_detail->nomor_resep ? $row->final_detail->nomor_resep : "-"}}</b>
      </td>
      <td colspan="2">
        <b>Dari : {{$row->final_detail->owner_detail ? $row->final_detail->owner_detail->nama : "-"}}</b>
      </td>
      <td colspan="2">
        <b>Dokter : {{$row->created_by_detail->name}}</b>
      </td>
    </tr>
    @foreach($row->final_detail->resep_detail as $res)
    <tr>
      <td>{{$i++}}</td>
      <td>{{$res->obat_detail ? $res->obat_detail->item_detail->kode : ""}}</td>
      <td>{{$res->nama_obat}}</td>
      <td>{{$res->satuan}}</td>
      @php $total=0 @endphp
      @if($res->tipe) @php $total=$res->jumlah @endphp
      @else
      @foreach($res->log as $log)
      @php $total += $log->jumlah; $total -= $log->jumlah_retur @endphp
      @endforeach
      @endif
      <td>{{$total}}</td>
      <?php $total_1+=$total; ?>
      <td>{{number_format($res->harga)}}</td>
      <?php $total_2+=$res->harga; ?>
      <td>{{number_format($res->harga * $total)}}</td>
      <?php $total_3+=$res->harga * $total; ?>
    </tr>
    @endforeach
    @endforeach
    <tr>
      <td colspan="4">T O T A L</td>
      <td>{{number_format($total_1)}}</td>
      <td>{{number_format($total_2)}}</td>
      <td>{{number_format($total_3)}}</td>
    </tr>
  </thead>
</table>