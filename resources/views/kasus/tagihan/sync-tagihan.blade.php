<div class="modal fade" id="modalSyncTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Tagihan <span id="title-number"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{url('kasus')}}/{{ $kasus->nomor_kasus }}/tagihan/sync" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control form-control-lg" id="tagihanSyncID" name="id" placeholder=""></textarea>
                        <h5 class="font-w400">
                            Terdapat tagihan yang tidak menggunakan SEP yang sama. Kami merekomendasikan anda untuk melakukan sinkronisasi sehingga semua tagihan akan menggunakan SEP yang sama.
                        </h5>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-100 float-right">
                                    <i class="fa fa-send mr-5"></i> Sinkronisasi Tagihan
                                </button>
                                <button type="button" data-dismiss="modal" class="btn-alt btn-click-animate btn-hero btn-regular min-width-100 float-right">Batal
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>