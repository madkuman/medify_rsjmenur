<div class="modal fade" id="print-po" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-12 mb-0">
                        Pilih TTD
                    </h4>
                    <form method="POST" class="col-md-12" action="{{url()->current()}}/print">
                        {{csrf_field()}}
                        <input type="hidden" id="print-id" name="id" value="{{$po->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Pilih TTD untuk Print</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="my-15">
                            @if($po->jenis_po == 'Farmasi')
                            <div class="form-group row">
                                <label class="col-12" for="example-datepicker1">Apoteker</label>
                                <select class="js-select2 form-control col-6" id="apoteker" name="apoteker" style="width: 100%;" data-placeholder="Pilih TTD">
                                    <option></option>
                                    @foreach($ttd as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->jabatan}})</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-12" for="example-datepicker1">Pejabat Pengadaan</label>
                                <select class="js-select2 form-control col-6" id="pejabat" name="pejabat" style="width: 100%;" data-placeholder="Pilih TTD">
                                    <option></option>
                                    @foreach($ttd as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->jabatan}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="example-datepicker1">Mengetahui</label>
                                <select class="js-select2 form-control col-6" id="mengetahui" name="mengetahui" style="width: 100%;" data-placeholder="Pilih TTD">
                                    <option></option>
                                    @foreach($ttd as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->jabatan}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="example-datepicker1">Keterangan/NB:</label>
                                @if($po->jenis_po == 'Farmasi')
                                <textarea rows="4" class="form-control js-summernote mb-5" name="keterangan">Mohon Pengiriman Barang Lengkap Sesuai dengan Surat Pesanan & <b>Exp. Date minimal 1 tahun</b></textarea>
                                @else
                                <textarea rows="4" class="form-control js-summernote mb-5" name="keterangan"></textarea>
                                @endif
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