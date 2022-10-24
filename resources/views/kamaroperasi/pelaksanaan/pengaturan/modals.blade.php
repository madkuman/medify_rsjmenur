<div class="modal fade" id="modal-ganti-jadwal" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="pengaturan/ganti_jadwal" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $transaksi->id }}">
              <div class="block-content">
                <h3 class="block-title">Pergantian Jadwal Operasi</h3>
                <br>
                <p>Anda akan melakukan pergantian jadwal operasi. Jadwal operasi akan diatur kembali oleh administrasi Departemen Bedah. Anda mungkin akan dihubungi oleh administrasi terkait jadwal.</p>
                <label>Keterangan</label>
                <textarea name="keterangan" rows="4" placeholder="Sampaikan waktu yang anda rekomendasikan untuk melakukan operasi" class="form-control"></textarea>
                <br>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
              <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-check"></i> Submit
              </button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-ganti-dokter" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="pengaturan/edit_dokter" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $transaksi->id }}">
              <div class="block-content">
                <h3 class="block-title">Pergantian Dokter Penanggung Jawab Operasi</h3>
                <br>
                <label>Dokter</label>
                <select class="js-select2 form-control" style="width: 100%;" id="ganti_dokter_dropdown" name="dokter" data-placeholder="Pilih Dokter" required>
                <option value="{{$transaksi->doctor_id}}" selected="">{{$transaksi->dokter->name}}</option>
                </select>
                <br>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
              <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-check"></i> Submit
              </button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-batal-operasi" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="pengaturan/batal_operasi" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $transaksi->id }}">
              <div class="block-content">
                <h3 class="block-title">Pembatalan Jadwal Operasi</h3>
                <br>
                <h4 class="block-title">Anda akan membatalkan operasi ini?</h4>
                <input type="text" class="form-control" style="width: 100%" name="alasan_batal" placeholder="Alasan Pembatalan" required>
                <br>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-danger">
                  <i class="fa fa-check"></i> Ya, Batalkan
              </button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-ganti-judul" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="pengaturan/edit_judul" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $transaksi->id }}">
              <div class="block-content">
                <h3 class="block-title">Pergantian Judul Operasi</h3>
                <br>
                <label>Judul</label>
                <input type="text" class="form-control" style="width: 100%" id="ganti_judul" name="judul" placeholder="Ganti Judul" value="{{ $transaksi->judul or ''}}" required>
                <br>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
              <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-check"></i> Submit
              </button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-operasi-join" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="pengaturan/edit_operasi_join" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
            {{ csrf_field() }}
            <input type="hidden" name="parent_id" value="{{ $transaksi->id }}">
            <div class="block-content">
              <h3 class="block-title">Pengaturan Join Operasi</h3>
              <br>
              <div id="operasi-join-container">
                @forelse($transaksi->child as $child)
                <div class="form-group">
                  <div class="row">
                    <input type="hidden" name="id[]" value="{{ $child->id }}">
                    <label class="col-5 child-field">Judul Operasi</label>
                    <label class="col-5 ml-5 child-field">Dokter Penanggung Jawab</label>
                    <input type="text" class="col-5 form-control ml-15 mr-5 child-field" autocomplete="off" name="judul_child[]" value="{{ $child->judul }}" placeholder="Masukkan Judul Operasi" required>
                    <select class="js-select2 col-5 form-control ml-15 ganti_dokter_child_dropdown child-field" style="width: 45%;" name="dokter_child[]" data-placeholder="Pilih Dokter" required>
                      <option value="{{$child->doctor_id or $transaksi->doctor_id}}" selected="">{{$child->dokter->name or $transaksi->dokter->name}}</option>
                    </select>
                    <a href="javascript:void(0);" class="remove_button col-1 pr-0 child-field"><span class="fa fa-2x fa-trash" style="color: red;"></a>
                  </div>
                </div>
                @empty
                @endforelse
              </div>
              <a href="javascript:void(0);" id="add-operasi-join-btn" class="btn btn-primary mb-5" title="Add field">
                <span class="fa fa-plus-circle text-center"></span> Tambah Operasi
              </a>
              <br>
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-alt-primary">
                <i class="fa fa-check"></i> Submit
            </button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-ganti-diagnosis" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Ganti Diagnosis</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kamaroperasi')}}/pelaksanaan/ganti-diagnosis" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $transaksi->id }}">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label class="col-12" for="example-autocomplete1">Diagnosis</label>
                                <div class="col-lg-12">
                                    <input type="text" class="diagnosis-autocomplete form-control" id="nama-diagnosis" name="nama-diagnosis" placeholder="Ketikkan diagnosis...">
                                </div>
                                <span id="diagnosis_error_wrapper"></span>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="id-diagnosis" name="id-diagnosis" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submit-create-diagnosis" class="btn-alt btn-click-animate btn-hero btn-primary float-right min-width-175">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                        <hr>
                        <h6>Sugesti Diagnosis njeng</h6>
                        <div data-toggle="slimscroll" data-always-visible="true">
                            @foreach($suggest_diagnosis as $item)
                            <div class="p-10 border-bottom">
                                <div class="row">
                                    <div class="col-10">
                                        <span>{{$item->icd->code_icd}} - {{$item->icd->long_desc}}</span>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-sm btn-alt-primary pull-right" type="button" onclick="addDiagnosisSuggest(this)" data-id="{{$item->icd->id}}" data-desc="{{$item->icd->code_icd}} - {{$item->icd->long_desc}}">+ Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>