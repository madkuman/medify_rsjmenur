<div class="modal fade" id="modalLihatHistoriLab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/hasil-lab')}}" method="get">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLihatHistoriLabLabel">Pilih Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                    <input type="text" class="form-control input-daterange-start" autocomplete="off" name="daterange_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_start_month_default->format('d-m-Y')}}" required="">
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text font-w600">to</span>
                    </div>
                    <input type="text" class="form-control input-daterange-end" autocomplete="off" name="daterange_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_end_month_default->format('d-m-Y')}}" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
  </div>
</div>