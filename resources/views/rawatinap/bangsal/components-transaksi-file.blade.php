
<div class="transaksi-file">
    @if(!empty($transaksi->rm_transaksi_id))
    @if($transaksi->rm_transaksi->status == 1)
    <div class="row block-content">
        <div class="col-md-8 text-center ml-auto">

            <form method="POST" action="{{url('rawatinap/transaksi/rekam-medis/konfirmasi')}}/{{$transaksi->id}}">
                {{csrf_field()}}
                <button class="btn btn-primary text-center pull-right" type="submit">File RM : Konfirmasi File</button>
            </form>

            @if(is_null($transaksi->kedatangan_at))
            <a class="btn btn-secondary text-center pull-right mr-5" href="{{url('kasus')}}/{{$transaksi->kasus->nomor_kasus}}/administrasi/rawatinap/pindah">Pindah Ruangan</a>
            @endif

            <a href="javascript:void(0)" onclick="permintaan_gizi('{{$bed->transaksi->kasus_id}}')"
                class="btn btn-secondary text-center pull-right mr-5"><i class="fa fa-utensils"></i> Buat Order Diet</a>
            @if ($transaksi->farmasi_transaksi_obat_kirim_ruangan->count() != 0)
                @include('rawatinap.bangsal.components.button-penerimaan-perawat')
            @endif
        </div>
    </div> 
    @else
    <div class="row block-content">
        <div class="col-md-8 text-center ml-auto"> 

            <button class="btn btn-primary text-center pull-right" type="" disabled>File RM : Telah Dikonfirmasi</button>

            @if(is_null($transaksi->kedatangan_at))
            <a class="btn btn-secondary text-center pull-right mr-5" href="{{url('kasus')}}/{{$transaksi->kasus->nomor_kasus}}/administrasi/rawatinap/pindah">Pindah Ruangan</a>
            @endif

            <a href="javascript:void(0)" onclick="permintaan_gizi('{{$bed->transaksi->kasus_id}}')"
                class="btn btn-secondary text-center pull-right mr-5"><i class="fa fa-utensils"></i> Buat Order Diet</a>
            @if ($transaksi->farmasi_transaksi_obat_kirim_ruangan->count() != 0)
                @include('rawatinap.bangsal.components.button-penerimaan-perawat')
            @endif
        </div>
    </div>
    @endif
    @else
    <div class="row block-content">
        <div class="col-md-8 text-center ml-auto">
            <button class="btn btn-warning text-center pull-right" type="" disabled>File RM : Transaksi Tidak Ditemukan</button>


            @if(is_null($transaksi->kedatangan_at))
            <a class="btn btn-secondary text-center pull-right mr-5" href="{{url('kasus')}}/{{$transaksi->kasus->nomor_kasus}}/administrasi/rawatinap/pindah">Pindah Ruangan</a>
            @endif

            <a href="javascript:void(0)" onclick="permintaan_gizi('{{$bed->transaksi->kasus_id}}')"
                class="btn btn-secondary text-center pull-right mr-5"><i class="fa fa-utensils"></i> Buat Order Diet</a>
            @if ($transaksi->farmasi_transaksi_obat_kirim_ruangan->count() != 0)
                @include('rawatinap.bangsal.components.button-penerimaan-perawat')
            @endif
        </div>
    </div>
    @endif
</div> 