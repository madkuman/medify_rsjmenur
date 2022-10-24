<div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-12 mb-0">
                        Tambah Akun
                    </h4>
                    <form method="POST" class="col-md-12" action="{{url()->current()}}/baru">
                        {{csrf_field()}}
                        <h6 class="font-size-s font-w400 mt-5">Tambah akun untuk keuangan</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="text-center my-15">
                            <div class="form-group row">
                                <input type="text" class="col-md-4 form-control ml-15" name="nama" placeholder="Nama" required>
                                <input type="number" class="col-md-4 form-control ml-5" name="no_rekening" placeholder="No. Rekening" required>
                            </div>
                        </div>
                        <button type="submit" id="submitgroup" class="btn btn-xs btn-primary float-right">
                            Simpan
                        </button>
                        <button type="button" id="submitgroup" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>