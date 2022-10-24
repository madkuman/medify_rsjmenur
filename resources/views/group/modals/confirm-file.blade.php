<div class="modal fade" id="confirm-file" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                        {{csrf_field()}}
                        <div class="block-content block-content-full text-center p-30 mb-20">
                            <h4 class="mb-5">Konfirmasi File RM</h4>
                            <p>Masukkan no RM. Gunakan barcode scanner untuk mempercepat proses</p>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input id="noRM" type="text" class="form-control">
                                    </div>
                                    <button class="btn btn-primary" type="button" id="btnSubmit">Submit</button> 
                                    <button class="btn btn-primary" type="button" id="btnSubmitLoading" disabled="">Submit <i class="fa fa-cog fa-spin"></i> </button> 
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>