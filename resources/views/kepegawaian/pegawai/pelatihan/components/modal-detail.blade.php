<div class="modal fade" id="modal-detail-pelatihan" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title">Detail Pelatihan</h4>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-20">
          <p class="text-muted font-w400 mb-1">NAMA PELATIHAN </p>
          <h5 id="info-nama-pelatihan"></h5>        
          <p class="text-muted font-w400 mb-1">TAHUN PELATIHAN </p>
          <h5 id="info-tahun-pelatihan"></h5>                
          <p class="text-muted font-w400 mb-1">TEMPAT PELATIHAN </p>
          <h5 id="info-tempat-pelatihan"></h5>                
          {{-- <div class="row">
            <div class="col-6">
              <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
              <h6 id="creator" class="mb-0"></h6>
              <p id="info-uploader-pend" class="font-w400 mt-5"></p>
              
            </div>
            <div class="col-6" id="info-verificator-edu"></div>
          </div> --}}
          @if($is_hrd_member)
          <div id="verify-edu-mil" class="form-group">
            <form id="form-verifikasi" class="form-verifikasi-edu" method="POST" action="{{url('kepegawaian/pegawai/pelatihan/{id}/verifikasi')}}" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" id="form-detail-id" value="0">
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-danger btn-delete" data-id=""><i class="fa fa-trash mr-5"></i>Hapus</button>
          {{-- <button type="button" class="btn btn-alt-success edit-edu-button" data-id=""><i class="fa fa-pencil mr-5"></i>Ubah</button> --}}
          
          @if($is_hrd_member)
          <button type="submit" id="btn-verifikasi" class="btn btn-alt-primary verification-button-mil"><i class="fa fa-check mr-5"></i>Verifikasi</button>
          @endif
        </div>
    </form>
      </div>
    </div>
  </div>