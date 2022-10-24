<div class="modal fade" id="addModalTerima" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Form Transfer Internal Rumah Sakit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id-terima">
                    <input type="hidden" name="terima_by" value="" id="terima-by">
                    <input type="hidden" name="flag_terima" value="1">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 row mx-0">
                                <div class="col-12">
                                    <h4>Pemeriksaan di Ruangan Tujuan</h4>
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Ruangan Tujuan</label>
                                    <input type="text" class="form-control" name="ruangan_tujuan" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Nama perawat penerima</label>
                                    <input type="text" class="form-control" name="nama_perawat_penerima" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Jam tiba di ruangan</label>
                                    <input type="text" class="form-control time" name="jam_tiba_di_ruangan" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Tekanan darah</label>
                                    <input type="text" class="form-control" name="tekanan_darah_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Nadi</label>
                                    <input type="text" class="form-control" name="nadi_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Suhu (°C)</label>
                                    <input type="text" class="form-control" name="suhu_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>Respirasi</label>
                                    <input type="text" class="form-control" name="respirasi_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>GCS : E</label>
                                    <input type="text" class="form-control" name="gcs_e_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>GCS : V</label>
                                    <input type="text" class="form-control" name="gcs_v_2" >
                                </div>
                                <div class="form-group col-sm-9">
                                    <label>GCS : M</label>
                                    <input type="text" class="form-control" name="gcs_m_2" >
                                </div>
                                <div class="col-12 full-only">
                                    &nbsp;
                                </div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Gelisah</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="gelisah_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="gelisah_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only"></div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Agresif</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="agresif_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="agresif_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only"></div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Fiksasi</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="fiksasi_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="fiksasi_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only"></div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Korban pasung</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="korban_pasung_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="korban_pasung_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only"></div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Indikasi bunuh diri</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="indikasi_bunuh_diri_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="indikasi_bunuh_diri_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only"></div>
                                <div class="col-md-4 col-12">
                                    <h6 class="">Indikasi jatuh</h6>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="indikasi_jatuh_2" value="Ya">
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="indikasi_jatuh_2" value="Tidak">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 full-only">
                                    &nbsp;
                                </div>
                                <div class="col-12">
                                    <h5 class="mb-5">Skala nyeri</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Tidak Nyeri">
                                            <img src="{{asset('assets/img/nyeri/face(1).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Tidak Nyeri
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Ringan">
                                            <img src="{{asset('assets/img/nyeri/face(2).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Nyeri Ringan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Mengganggu">
                                            <img src="{{asset('assets/img/nyeri/face(3).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Nyeri Mengganggu
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Menyusahkan">
                                            <img src="{{asset('assets/img/nyeri/face(4).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Nyeri Menyusahkan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Hebat">
                                            <img src="{{asset('assets/img/nyeri/face(5).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Nyeri Hebat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Sangat Hebat">
                                            <img src="{{asset('assets/img/nyeri/face(6).png')}}" class="mr-5">
                                            <span class="css-control-indicator"></span> Nyeri Sangat Hebat
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>