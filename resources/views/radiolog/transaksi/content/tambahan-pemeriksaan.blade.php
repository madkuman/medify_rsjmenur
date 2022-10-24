<p class="h5 my-0 mb-10 mt-0">TAMBAHAN PEMERIKSAAN</p>
<div class="form-group">
    <div class="form-layanan">
        <p class="mb-0">*Layanan harus ada pada kelas dan tipe yang dipilih</p>
        <div class="form-group single-layanan  layananBaru" id="layanan_0" data-index="0">
            <table class="table table-bordered table-vcenter">
                <tr>
                    <th style="width: 180px">Layanan Tambahan</th>
                    <th>Jumlah Pemeriksaan</th>
                    <th>Film Dipakai</th>
                    <th>Film Direject</th>
                    <th style="width: 145px">Alasan Film Direject</th>
                    <th style="width: 110px">Ukuran Film</th>
                    <th>Foto Ulang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="width: 125px">Alasan Foto Ulang</th>
                    <th>Kontras Dipakai</th>
                    <th>Kontras Dikembalikan</th>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-layanan js-select2" id="layanan0" style="width: 200px;" >
                                <option value="0" selected="">Pilih Layanan</option>
                                @foreach($layanan as $row)
                                <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="number" class="form-control new-jumlah-periksa" value="1" min="1">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="text" value="0" min="0" class="form-control new-film-dipakai" placeholder="Masukkan Jumlah Film yang Dipakai">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="text" value="0" min="0" class="form-control new-film-direject" placeholder="Masukkan Jumlah Film yang Di-reject">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-alasan-film-direject" style="width: 100%;" >
                                <option value="" selected="">-</option>
                                @foreach($alasan_direject as $ad)
                                <option value="{{$ad}}">{{$ad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-ukuran-film" style="width: 100%;" >
                                <option value="" selected="">-</option>
                                @foreach($ukuran as $u)
                                <option value="{{$u}}">{{$u}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-foto-ulang">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <select class="form-control" style="width: 100%;">
                                <option value="" selected="">-</option>
                                @foreach($alasan_ulang as $au)
                                <option value="{{$au}}">{{$au}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-kontras-dipakai">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-kontras-dikembalikan">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="10"><button class="btn btn-hero btn-primary btn-hasil-baca" type="button" data-toggle="modal" data-target="#hasil_baca_new_0_modal">Hasil Baca</button></th>
                </tr>
            </table>
        </div>
    </div>
    <button type="button" id="tambahBtn" class="btn btn-rounded btn-noborder btn-success float-right mr-30" onclick="addForm();">
        <i class="fa fa-plus mr-5"> Tambah</i>
    </button>
</div>