<div class="modal fade" id="undang-anggota" tabindex="false" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-6 mb-0">
                        Undang Anggota
                    </h4>
                    <div class="col-md-6">
                        <a class="float-right btn btn-sm btn-circle btn-outline-primary" href="javascript:void(0)"data-dismiss="modal" aria-label="Close">
                            <span class="fa fa-close"></span>
                        </a>
                    </div>
                    <form method="post" class="col-md-12">
                        {{ csrf_field() }}
                        <h6 class="font-size-s font-w400 mt-5">Undang anggota baru untuk bergabung ke grup ini</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="form-group">
                            <label for="example-input-normal">Masukkan Nama</label>
                            <input type="text" class="form-control" id="inputSearch" name="keyword" placeholder="Cari.." autocomplete="off">
                        </div>
                        <div id="daftarPengguna" style="min-height: 300px;">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>