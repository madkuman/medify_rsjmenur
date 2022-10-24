<div class="modal" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header ">
                    <h3 class="block-title">Permintaan Pemeriksaan Ultrasonografi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content row">
                    <div class="col-md-12">
                        <form method="POST" action="{{url()->current()}}/create">
                            {{csrf_field()}}
                            <div class="form-group  mb-20">
                                <label class=" mb-5">Pasien</label>
                                <input type="text" name="pasien" class="form-control" value="{{$kasus->pasien->name}}" disabled>
                            </div>
                            <div class="form-group  mb-20">
                                <label class=" mb-5">Tujuan</label>
                                <textarea class="form-control" id="tujuan" name="tujuan" rows="3"></textarea>
                            </div>
                            <div class="form-group  mb-20">
                                <label class=" mb-5">Hasil</label>
                                <textarea class="form-control" id="hasil" name="hasil" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>