<div class="modal fade" id="modal-update-kanker-stadium" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Stadium Kanker</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/diagnosis/update-kanker-stadium" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="input-id-diagnosis" name="id">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label class="">Stadium</label>
                                <select class="form-control input-stadium" name="stadium" required>
                                    @for($i=1;$i<=4;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submit-create-diagnosis" class="btn-alt btn-click-animate btn-hero btn-primary btn-block ml-0">
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