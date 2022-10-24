<div class="modal fade" id="edit-ttd{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Edit TTD
                    </h4>
                    <form method="POST" class="col-md-12" action="{{url()->current()}}/edit">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Ubah informasi TTD yang telah ada</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="text-center my-15">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control ml-5 mb-5" name="nama" placeholder="Nama" value="{{$value->nama}}" required>
                                    <input type="text" class="form-control ml-5" name="pangkat" placeholder="Pangkat" value="{{$value->pangkat}}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control ml-5 mb-5" name="jabatan" placeholder="Jabatan" value="{{$value->jabatan}}" required>
                                    <input type="text" class="form-control ml-5" name="nip" placeholder="NRP" value="{{$value->nip}}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control ml-5 mt-5" name="sipa" placeholder="SIPA" value="{{$value->sipa}}">
                                </div>
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