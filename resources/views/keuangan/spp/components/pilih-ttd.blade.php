<div class="modal fade" id="print-spp" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-12 mb-0">
                        Pilih TTD
                    </h4>
                    <form method="POST" class="col-md-12" action="{{url('keuangan/spp/print')}}">
                        {{csrf_field()}}
                        <input type="hidden" id="print-id" name="id" value="">
                        <h6 class="font-size-s font-w400 mt-5">Pilih TTD untuk Print SPP</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="my-15">
                            <div class="form-group row">
                                <label class="col-12" for="example-datepicker1">TTD</label>
                                <select class="js-select2 form-control col-6" id="ttd" name="ttd" style="width: 100%;" data-placeholder="Pilih TTD">
                                    <option></option>
                                    @foreach($ttd as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->jabatan}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" id="submitgroup" class="btn btn-xs btn-primary float-right">
                            <i class="fa fa-print"></i> Print
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