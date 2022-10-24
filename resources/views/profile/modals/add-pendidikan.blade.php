<div class="modal fade" id="add-pendidikan" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Pendidikan
                    </h4>
                    <div class="col-md-9 mb-0">
                        <a id="import-pendidikan" class="link-effect float-right font-size-s" href="javascript:void(0)">
                            <span class="fa fa-download"></span> Import data kepegawaian
                        </a>
                    </div>
                    <form method="POST" class="col-md-12" action="{{route('create.pendidikan')}}">
                        {{csrf_field()}}
                        <h6 class="font-size-s font-w400 mt-5">Cantumkan informasi pendidikan yang ingin anda bagikan</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
                        <div id="pend-wrapper" class="text-center my-15">
                            
                        </div>
                        <a href="javascript:void(0);" id="add-pendidikan-btn" class="btn btn-primary" title="Add field"><span class="fa fa-plus-circle text-center"></span> Tambah input</a>
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