<div class="modal fade" id="modalSplitTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan/split">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Split Tagihan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content px-0 row">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="tagihanSplitID">

                        <div class="form-group col-md-6">
                            <label>Tanggal Awal </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Pilih Tanggal"  data-date-format="dd-mm-yyyy" autocomplete="off" value="{{date('d-m-Y')}}" onkeydown="return false" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Akhir </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_akhir" placeholder="Pilih Tanggal"  data-date-format="dd-mm-yyyy" autocomplete="off" value="{{date('d-m-Y')}}" onkeydown="return false" required>
                        </div>
                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass btn-click-animate">
                        <i class="fa fa-check"></i> Split Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

