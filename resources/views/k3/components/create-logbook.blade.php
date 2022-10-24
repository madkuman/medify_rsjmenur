@section('css')

@endsection
<form class="" method="POST" action="{{url()->current()}}">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Nama Pegawai</label><br>
                <input type="text" name="pegawai" class="form-control" placeholder="Nama Lengkap Pegawai" autocomplete="off" required>
                <p class="text-danger teksWarning" id="pegawaiWarn" style="display: none; margin-bottom: 8px;"></p>
            </div>

            <div class="form-group">
                <label class="control-label">Status Pegawai</label>
                <select name="status_pegawai" class="js-select2 form-control" style="width: 100%" required>
                    <option value="" selected disabled>Pilih Status Pegawai</option>
                    <option value="pegawai tetap">Pegawai Tetap</option>
                    <option value="pegawai tidak tetap">Pegawai Tidak Tetap</option>
                    <option value="pegawai outsourching">Pegawai Outsourching</option>
                    <option value="mahasiswa / magang">Mahasiswa / Magang</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="control-label">Tanggal Kejadian</label>
                <input type="text" class="js-datepicker form-control datepicker" style="width: 80%" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" autocomplete="off" name="tanggal" placeholder="Tanggal Kejadian" required>
            </div>

            <div class="form-group">
                <label class="control-label">Lokasi Kejadian</label>
                <input type="text" class="form-control" name="lokasi" placeholder="Isikan Lokasi" style="width: 80%;" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Kronologi Kejadian</label>
                <textarea class="form-control form-control-lg" name="kronologi" rows="3" placeholder="Isikan Kronologi" required></textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Letak Cedera</label>
                <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="letakcedera" style="width: 60%;" required>
                    <option value="" disabled selected>Pilih Letak Cedera</option>
                    <option value="Kepala">Kepala</option>
                    <option value="Tangan">Tangan</option>
                    <option value="Kaki">Kaki</option>
                    <option value="Tubuh">Tubuh</option>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label">Fatality</label>
                <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="fatality" style="width: 60%;" required>
                    <option value="" disabled selected>Pilih Fatality</option>
                    <option value="Ringan">Ringan</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Berat">Berat</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="pull-right">
                <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" >
                    Kembali
                </button>
                </a>
                <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
                    <i class="fa fa-send mr-5"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</form>