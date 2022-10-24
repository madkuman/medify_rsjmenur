<div class="col-lg-6 col-12 p-10 mb-10">
    <div class="border p-10" style="height: 100%">
       <p class="h6 my-0 mb-10">JADWAL PEMERIKSAAN</p>
       @if (is_null($transaksi->inspect_creator['name']))
       <h6>Belum Dijadwalkan</h6>
       <button class="btn btn-secondary" data-toggle="modal" data-target="#modalConfirmation">Jadwalkan</button>
       @else
       <h6>{{date('d F Y', strtotime($transaksi->inspected_at))}}</h6>
       Dijadwalkan Oleh :<br>
       {{$transaksi->inspect_creator['name']}}<br>
       {{date('d F y, H:i', strtotime($transaksi->inspected_at_created_at))}}
       <br><br>
       <button class="btn btn-secondary" data-toggle="modal" data-target="#modalConfirmation">Ubah Jadwal</button>
       @endif
       <hr>
      @include('layouts.components2.lab.permintaan-oleh')
   </div>
</div>

<div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="block block-themed block-transparent mb-0">
            <div class="block-content">
               <form action="{{url($link.'/transaksi/permintaan/edit/'.$transaksi->slug)}}" method="POST">
                         <h3>Jadwalkan Pemeriksaan</h3>
                         {{csrf_field()}}
                         <p>Koordinasikan jadwal pemeriksaan dengan pemeriksa dan juga dokter laboratorium</p>
                         {{ Form::label('tanggal_periksa', 'Pilih Tanggal')}}
                         <input type="text" class="js-datepicker form-control" id="example-datepicker3" name="tanggal_periksa" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="dd-mm-yyyy" autocomplete="off" value="{{!is_null($transaksi->inspected_at) ? date('Y-m-d', strtotime($transaksi->inspected_at)) : date('Y-m-d')}}">
                         <br>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal
                     </button>
                     <button type="submit" class="btn btn-primary">Simpan
                     </button>
                 </form>
             </div>
         </div>
     </div>
 </div>
</form>