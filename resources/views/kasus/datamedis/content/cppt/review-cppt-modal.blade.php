<div class="modal fade" id="modal-review-cppt" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Review CPPT</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/cppt/review-post" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" class="cppt-id">
                        <div class="form-group row">
                            <label class="col-12" for="">Review</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg"  name="review" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>