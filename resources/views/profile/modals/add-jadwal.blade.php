<div class="modal fade" id="add-jadwal" tabindex="false" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Jadwal Praktek
                    </h4>
                    <form method="POST" class="col-md-12" action="{{route('create.jadwal')}}">
                        {{csrf_field()}}
                        <h6 class="font-size-s font-w400 mt-5">Tambahkan jadwal praktek yang ingin anda bagikan</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div id="jadwal-wrapper" class="ml-15 my-15">
                            
                        </div>
                        <a href="javascript:void(0);" id="add-jadwal-btn" class="btn btn-primary" title="Add field"><span class="fa fa-plus-circle text-center"></span> Tambah input</a>
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