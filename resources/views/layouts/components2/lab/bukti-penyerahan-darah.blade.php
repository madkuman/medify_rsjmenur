<div class="col-12">
    <br><p class="h6 my-0 mb-10">BUKTI PENYERAHAN DARAH</p>
    <a type="btn" class="btn btn-primary mb-10" href="{{url('labpk/transaksi/cetak/bukti-penyerahan-darah/'.$transaksi->slug)}}" target="_blank">
        <i class="fa fa-print mr-5"></i> Print Bukti Penyerahan Darah
    </a>    
    <table class="table table-bordered table-vcenter">
        <tr>
            <td><label>Tanggal</label></td>
            <td><label>Jam</label></td>
            <td><label>No Kantong</label></td>
            <td><label>No Slang</label></td>
            <td><label>Jenis Darah</label></td>
            <td><label>Golongan Darah</label></td>
            <td><label>Rhesus</label></td>
            <td><label>Hasil Cross</label></td>
            <td><label>Pemberi</label></td>
            <td><label>Penerima</label></td>
        </tr>
        @foreach($transaksi->hasil_transfusi as $h)
            <tr>
                <td>{{date('d/M/Y', strtotime($h->tanggal))}}</td>
                <td>{{date('H:i', strtotime($h->jam))}}</td>
                <td>{{$h->no_kantong}}</td>
                <td>{{$h->no_slang}}</td>
                <td>{{$h->jenis_darah}}</td>
                <td>{{$h->gol_darah}}</td>
                <td>{{$h->rhesus}}</td>
                <td>{{$h->hasil_cross}}</td>
                <td>{{$h->pemberi}}</td>
                <td>{{$h->penerima}}</td>
            </tr>
        @endforeach

    </table>
</div>