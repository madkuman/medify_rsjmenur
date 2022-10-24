<div class="row">
    <div class="col-12">
        <h4 class="mb-0">Berkas Pasien</h4>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <h4 style="text-align: center">Kartu Tanda Penduduk (KTP)</h4>
                <div class="avatar-upload berkas-upload">
                    <div class="avatar-edit">
                        <input type="file" id="file_ktp" class="read-file-upload" name="file_ktp" accept=".png, .jpg, .jpeg" />
                        <label for="file_ktp"></label>
                    </div>
                    <div class="avatar-preview berkas-preview">
                        <div id="imagePreview_file_ktp" style="background-image: url({{url($pasien['identitas']->photo_identity_thumb ?? 'assets/img/placeholder.jpg')}});">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h4 style="text-align: center">Kartu Keluarga (KK)</h4>
                <div class="avatar-upload berkas-upload">
                    <div class="avatar-edit">
                        <input type="file" id="file_kk" class="read-file-upload" name="file_kk" accept=".png, .jpg, .jpeg" />
                        <label for="file_kk"></label>
                    </div>
                    <div class="avatar-preview berkas-preview">
                        <div id="imagePreview_file_kk" style="background-image: url({{url($pasien['identitas']->file_kk ?? 'assets/img/placeholder.jpg')}});">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h4 style="text-align: center">Kartu Asuransi</h4>
                <div class="avatar-upload berkas-upload">
                    <div class="avatar-edit">
                        <input type="file" id="file_kartu_asuransi" class="read-file-upload" name="file_kartu_asuransi" accept=".png, .jpg, .jpeg" />
                        <label for="file_kartu_asuransi"></label>
                    </div>
                    <div class="avatar-preview berkas-preview">
                        <div id="imagePreview_file_kartu_asuransi" style="background-image: url({{url($pasien['identitas']->file_kartu_asuransi ?? 'assets/img/placeholder.jpg')}});">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>