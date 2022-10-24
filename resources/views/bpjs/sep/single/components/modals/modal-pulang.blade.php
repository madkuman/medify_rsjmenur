<div class="modal fade" id="modal-sep-pulang" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-content pt-1 pl-5">
                    <form method="POST" action="{{url('api/bpjs/sep/pulang')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Nomor SEP</label>
                            <input type="text" name="no_sep" readonly="" class="form-control" id="no_sep_krs">    
                        </div>
                        <div class="form-group">
                            <label>Tanggal KRS</label>
                            <input type="text" class="js-datepicker form-control" id="tgl" name="tgl" data-autoclose="true" autocomplete="false"  data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy">    
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>