@if($transaksi->status != -1)
    <div class="row">
        <div class="col-12" id="verifikasiDiv">


            @if(is_null($transaksi->verified_at))
            @if($is_dokter)
            <button class="btn btn-primary pull-right ml-5 wide-mobile" type="button" onclick="verifikasiTransaksi()">Verifikasi</button>
            @endif
            @else
            <button class="btn btn-primary pull-right ml-5 wide-mobile" type="button" disabled="">Sudah terverifikasi</button>
            @endif


            <button type="button" class="btn btn-secondary float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-angle-down"></i> Cetak
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button" onclick="window.open('{{url($link.'/transaksi/cetak/bukti-layanan/'.$transaksi->slug)}}', 
                    'newwindow', 
                    `width=${screen.width},height=${screen.height}`); return false;">Cetak Bukti Layanan
                </button>
                <button class="dropdown-item" type="button" onclick="window.open('{{url($link.'/transaksi/cetak/kwitansi/'.$transaksi->slug)}}', 
                    'newwindow', 
                    `width=${screen.width},height=${screen.height}`); return false;">Cetak Kwitansi
                </button>
                <button class="dropdown-item" type="button" onclick="window.open('{{url($link.'/transaksi/cetak/permintaan/'.$transaksi->slug)}}', 
                    'newwindow', 
                    `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan
                </button> 
            </div>
        </div>
    </div>
@endif