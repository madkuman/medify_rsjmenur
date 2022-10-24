
                <div class="transaksi-file">
                    @if(!empty($transaksi->rm_transaksi_id))
                    @if($transaksi->rm_transaksi->status == 1)
                    <div class="row block-content">
                        <div class="col-md-3 text-center ml-auto">
                            <form method="POST" action="{{url('igd/transaksi/rekam-medis/konfirmasi')}}/{{$transaksi->id}}">
                                {{csrf_field()}}
                                <button class="btn btn-primary text-center pull-right" type="submit">File RM : Konfirmasi File</button>
                            </form>
                        </div>
                    </div> 
                    @elseif($transaksi->rm_transaksi->status == 0)
                    <div class="row block-content">
                        <div class="col-md-3 text-center ml-auto">
                            <button class="btn btn-info text-center pull-right" type="" disabled>File RM : Sedang Dikirim</button>
                        </div>
                    </div>
                    @else
                    <div class="row block-content">
                        <div class="col-md-3 text-center ml-auto">
                            <button class="btn btn-primary text-center pull-right" type="" disabled>File RM : Telah Dikonfirmasi</button>
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="row block-content">
                        <div class="col-md-3 text-center ml-auto">
                            <button class="btn btn-warning text-center pull-right" type="" disabled>File RM : Transaksi Tidak Ditemukan</button>
                        </div>
                    </div>
                    @endif
                </div> 