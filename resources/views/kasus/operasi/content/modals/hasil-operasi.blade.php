@forelse($hasil_operasi as $key => $item)
<div class="modal fade show" id="modal-hasil-operasi-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="{{url('kamaroperasi/pelaksanaan/pasca')}}" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
              <div class="block-content">
                <h3 class="block-title">Hasil Operasi</h3>
                <br>
                {{ csrf_field() }}
                <input type="hidden" name="pasca_id" value="{{ $item->id }}">
                <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Diagnosa Awal</label>
                      <input type="text" name="diag_awal" class="form-control" placeholder="Diagnosa pasien sebelum operasi" value="{{ $item->diagnosis_awal}}" required>
                    </div>
                    <div class="form-group">
                      <label>Diagnosa Akhir</label>
                      <input type="text" name="diag_akhir" class="form-control" placeholder="Diagnosa pasien setelah operasi" value="{{$item->diagnosis_akhir}}" required>
                    </div>
                    <div class="form-group">
                      <label>Persiapan</label>
                      <textarea name="persiapan" rows="3" class="form-control" placeholder="Hal yang dilakukan sebelum operasi" required>{{ $item->persiapan}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Posisi Pasien</label>
                      <input type="text" name="posisi" class="form-control" placeholder="Posisi pasien saat dioperasi" value="{{$item->posisi}}" required>
                    </div>
                    <div class="form-group">
                      <label>Disinfektan</label>
                      <input type="text" name="disinfektan" class="form-control" placeholder="Disinfektan yang digunakan" value="{{$item->disinfektan}}" required>
                    </div>
                    <div class="form-group">
                      <label>Incisi</label>
                      <input type="text" name="incisi" class="form-control" placeholder="Incisi yang dilakukan" value="{{$item->incisi}}" required>
                    </div>
                    <div class="form-group">
                      <label>Temuan Operasi</label>
                      <input type="text" name="temuan" class="form-control" placeholder="Temuan pasca operasi" value="{{$item->temuan_operasi}}" required>
                    </div>
                    <div class="form-group">
                      <label>Tindakan Operasi</label>
                      <textarea name="tindakan" rows="3" class="form-control" placeholder="Tindakan yang dilakukan saat operasi" required>{{$item->tindakan}}</textarea>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label>Pendarahan</label>
                      <input type="text" name="pendarahan" class="form-control" placeholder="Jumlah pendarahan yang terjadi pada pasien" value="{{$item->pendarahan}}" required>
                    </div>
                    <div class="form-group">
                      <label>Advice Post Ops</label>
                      <textarea name="advice" rows="3" class="form-control" placeholder="Saran yang diberikan pasca operasi" required>{{$item->advice_post}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Pemeriksaan PA</label>
                      <select class="form-control" style="width: 100%;" name="pemeriksaan_pa" required>
                        <option value="" disabled>-- Pilih --</option>
                        <option value="ya" {{ $item->pemeriksaan_pa == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ $item->pemeriksaan_pa == 'tidak' ? 'selected' : '' }}>Tidak</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jenis Operasi</label>
                      <select class="form-control" style="width: 100%;" name="jenis_operasi" required>
                        <option value="" disabled>-- Pilih --</option>
                        @foreach($jenis_operasi as $jenis_item)
                        <option value="{{$jenis_item->id}}" {{ $item->jenis_operasi == $jenis_item->id ? 'selected' : '' }}>{{$jenis_item->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Operasi</label>
                      <input type="text" class="js-datepicker form-control" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="dd/mm/yy" value="{{$item->tanggal_operasi->format('d F Y')}}" required autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label>Waktu Mulai</label>
                      <input type="text" class="js-masked-time form-control" name="waktu_mulai" placeholder="00:00" value="{{$item->waktu_mulai}}" required>
                    </div>
                    <div class="form-group">
                      <label>Waktu Selesai</label>
                      <input type="text" class="js-masked-time form-control" name="waktu_selesai" placeholder="00:00" value="{{$item->waktu_selesai}}" required>
                    </div>
                    <div class="form-group">
                      <label>Lama Anastesi</label>
                      <input type="text" class="js-masked-time form-control" name="anastesi" placeholder="00:00" value="{{$item->lama_anastesi}}" required>
                    </div>
                    <div class="form-group">
                      <label>Macam Anastesi</label>
                      <select class="form-control" style="width: 100%;" name="macam_anestesi" required>
                        <option value="" disabled>-- Pilih --</option>
                        <option value="general" {{$item->macam_anestesi == 'general' ? 'selected' : ''}}>General Anestesi</option>
                        <option value="regional" {{$item->macam_anestesi == 'regional' ? 'selected' : ''}}>Regional Anestesi</option>
                        <option value="local" {{$item->macam_anestesi == 'local' ? 'selected' : ''}}>Local Anestesi</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Status Pasien</label>
                      <select class="form-control" style="width: 100%;" name="status_pasien" required>
                        <option value="" disabled>-- Pilih --</option>
                        <option value="Hidup" {{$item->status_pasien == 'Hidup' ? 'selected' : ''}}>Hidup</option>
                        <option value="Mati" {{$item->status_pasien == 'Mati' ? 'selected' : ''}}>Mati</option>
                      </select>
                    </div>
                  </div>
                </div>
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
@empty
@endforelse