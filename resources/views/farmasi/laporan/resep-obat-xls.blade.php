<table>
    <thead>
        @include('farmasi.laporan.components.kop-xls')
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
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
            <th colspan="5">LAPORAN PEMBERIAN RESEP</th>
        </tr>
        <tr>
            <th colspan="5">TANGGAL {{date('d F Y',strtotime($min_date))}} - {{date('d F Y',strtotime($max_date))}}</th>
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
            <th colspan="7">No. RM : {{$pasien ? $pasien->no_rm : "-"}}</th>
        </tr>
        <tr>
            <th colspan="7">Nama Pasien : {{$pasien ? $pasien->name : "-"}}</th>
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
          <th>NO.</th>
          <th>KODE OBAT</th>
          <th>NAMA OBAT</th>
          <th>JUMLAH</th>
          <th>ATURAN PAKAI</th>
        </tr>
        @php $i=1 @endphp
        <?php $total_all=0 ?>
        @foreach($items as $row)
          <tr>
            <td colspan="2">
              <b>Tanggal : {{date('d-M-Y',strtotime($row->paid_at))}}</b>
            </td>
            <td colspan="1">
              <b>No. Resep : {{$row->final_detail->nomor_resep ? $row->final_detail->nomor_resep : "-"}}</b>
            </td>
            <td colspan="1">
              <b>Dari : {{$row->final_detail->owner_detail ? $row->final_detail->owner_detail->nama : "-"}}</b>
            </td>
            <td colspan="1">
              <b>Dokter : {{$row->created_by_detail->name}}</b>
            </td>
          </tr>
          @foreach($row->final_detail->resep_detail as $res)
            <tr>
              <td align="center">{{$i++}}</td>
              <td>{{$res->obat_detail ? $res->obat_detail->item_detail->kode : ""}}</td>
              <td>{{$res->nama_obat}}</td>
              @php $total=0 @endphp
              @if($res->tipe) @php $total=$res->jumlah @endphp
              @else
                @foreach($res->log as $log)
                  @php $total += $log->jumlah; $total -= $log->jumlah_retur @endphp
                @endforeach
              @endif
              <td align="right">{{$total}}</td>
              <?php $total_all+= $total ?>
              <td>{{$res->aturan}}</td>
            </tr>
          @endforeach
        @endforeach
        <tr>
          <td colspan="3" align="center">T O T A L</td>
          <td>{{number_format($total_all)}}</td>
          <td></td>
        </tr>
    </thead>
</table>