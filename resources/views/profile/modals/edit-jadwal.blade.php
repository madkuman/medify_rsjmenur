<div class="modal fade" id="edit-jadwal{{$jadwal->id}}" tabindex="false" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-4 mb-0">
                        Edit Jadwal Praktek
                    </h4>
                    <form method="POST" class="col-md-12" action="{{route('edit.jadwal')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="jadwal_id" value="{{$jadwal->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Ubah atau hapus jadwal praktek yang telah ada</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="ml-15 my-15">
                            <div class="form-group row">
                                <div class="col-md-3 mx-0 px-0">
                                    <select class="js-select2 form-control" id="poli" name="poli" style="width: 100%" data-placeholder="{{$jadwal->poli->name}}" disabled="disabled" required>
                                    </select>
                                </div>
                                <div class="col-md-3 mx-0 px-0 ml-5">
                                    <select class="js-select2 form-control" id="days" name="days" style="width: 100%" required>
                                        <option value="{{$jadwal->hari_order}}|{{$jadwal->hari}}" selected="selected">{{$jadwal->hari}}</option>
                                        <option value="1|Senin">Senin</option>
                                        <option value="2|Selasa">Selasa</option>
                                        <option value="3|Rabu">Rabu</option>
                                        <option value="4|Kamis">Kamis</option>
                                        <option value="5|Jumat">Jumat</option>
                                        <option value="6|Sabtu">Sabtu</option>
                                        <option value="7|Minggu">Minggu</option>
                                    </select>
                                </div>
                                <input type="text" class=" js-masked-time form-control js-masked-enabled col-md-2 ml-5" id="time_start" name="time_start" value="{{ Carbon\Carbon::parse($jadwal->jam_buka)->format('H:i') }}" placeholder="Jam Mulai" required>
                                <input type="text" class=" js-masked-time form-control js-masked-enabled col-md-2 ml-5" id="time_finish" name="time_finish" value="{{ Carbon\Carbon::parse($jadwal->jam_tutup)->format('H:i') }}" placeholder="Jam Selesai" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-jadwal{{$jadwal->id}}"  data-dismiss="modal">
                            <i class="fa fa-trash"></i> Hapus Entry
                        </button>
                        <button type="submit" name="submit" class="btn btn-xs btn-primary float-right">
                            Simpan
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