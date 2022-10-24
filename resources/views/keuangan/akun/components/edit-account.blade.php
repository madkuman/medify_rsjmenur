<div class="modal fade" id="edit-account{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Edit Akun
                    </h4>
                    <form method="POST" class="col-md-12" action="{{url()->current()}}/edit">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Ubah informasi akun yang telah ada</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="text-center my-15">
                            <div class="form-group row">
                                <input type="text" class="col-md-4 form-control ml-15" name="nama" placeholder="Nama" value="{{$value->nama}}" required>
                                <input type="number" class="col-md-4 form-control ml-5" name="no_rekening" placeholder="No. Rekening" value="{{$value->no_rekening}}" required>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-xs btn-primary float-right">
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