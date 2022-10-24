<div class="modal" id="modal-analisa-resep">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/analisa')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" id="transaksi-id">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="block-title">Pengkajian Resep </h3>
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close" style="color:yellow;">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                    <div class="block-content" style="font-size: 13px">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3"><label>Nama Pasien</label></div>
                                    <div class="col-1"><label>:</label></div>
                                    <div class="col-8"><label id="pasien-label"></label></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><label>Berat Badan</label></div>
                                    <div class="col-1"><label>:</label></div>
                                    <div class="col-8"><label id="bb-label"></label></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"><label>Tinggi Badan</label></div>
                                    <div class="col-1"><label>:</label></div>
                                    <div class="col-8"><label id="tb-label"></label></div>
                                </div>
                                <br>
                                <br>
                                <h6>SYARAT ADMINISTRASI</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>1. SEP</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                            <input type="radio" class="css-control-input analisa_resep_sep_1" name="analisa_resep_sep" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                            <input type="radio" class="css-control-input analisa_resep_sep_0" name="analisa_resep_sep" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>2. Fotokopi Kartu</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                            <input type="radio" class="css-control-input analisa_resep_fotokopi_kartu_1" name="analisa_resep_fotokopi_kartu" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                            <input type="radio" class="css-control-input analisa_resep_fotokopi_kartu_0" name="analisa_resep_fotokopi_kartu" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>3. Identitas Pasien (Nama, Domisili, Tgl Lahir)</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                            <input type="radio" class="css-control-input analisa_resep_identitas_pasien_1" name="analisa_resep_identitas_pasien" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                            <input type="radio" class="css-control-input analisa_resep_identitas_pasien_0" name="analisa_resep_identitas_pasien" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>4. Paraf Dokter</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                            <input type="radio" class="css-control-input analisa_resep_paraf_dokter_1" name="analisa_resep_paraf_dokter" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                            <input type="radio" class="css-control-input analisa_resep_paraf_dokter_0" name="analisa_resep_paraf_dokter" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>ASPEK FARMASETIK</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>5. Nama, Bentuk, Kekuatan</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_nama_obat_1" name="analisa_resep_nama_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_nama_obat_0" name="analisa_resep_nama_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>6. Jumlah Obat</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_jumlah_obat_1" name="analisa_resep_jumlah_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_jumlah_obat_0" name="analisa_resep_jumlah_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>7. Signa / Aturan Pakai</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_signa_obat_1" name="analisa_resep_signa_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                            <input type="radio" class="css-control-input analisa_resep_signa_obat_0" name="analisa_resep_signa_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <h6>ASPEK KLINIS</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <label>8. Tepat Indikasi</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_indikasi_1" name="analisa_resep_tepat_indikasi" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_indikasi_0" name="analisa_resep_tepat_indikasi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>9. Tepat Dosis</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_dosis_1" name="analisa_resep_tepat_dosis" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_dosis_0" name="analisa_resep_tepat_dosis" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>10. Tepat Rute</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_rute_1" name="analisa_resep_tepat_rute" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_rute_0" name="analisa_resep_tepat_rute" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>11. Tepat Waktu</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="interaksi-potensial">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_waktu_1" name="analisa_resep_tepat_waktu" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm  css-control-primary css-radio" id="css-control-sm interaksi-potensial">
                                            <input type="radio" class="css-control-input analisa_resep_tepat_waktu_0" name="analisa_resep_tepat_waktu" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>12. Tidak Duplikasi Terapi</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                            <input type="radio" class="css-control-input analisa_resep_duplikasi_terapi_1" name="analisa_resep_duplikasi_terapi" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                            <input type="radio" class="css-control-input analisa_resep_duplikasi_terapi_0" name="analisa_resep_duplikasi_terapi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>13. Tidak Ada Alergi Obat & ROTD</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                            <input type="radio" class="css-control-input analisa_resep_alergi_obat_1" name="analisa_resep_alergi_obat" value="1" checked="" > <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                            <input type="radio" class="css-control-input analisa_resep_alergi_obat_0" name="analisa_resep_alergi_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>14. Tidak Ada Interaksi Obat</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="analisa_resep_interaksi_obat">
                                            <input type="radio" class="css-control-input analisa_resep_interaksi_obat_1" name="analisa_resep_interaksi_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm control css-control-primary css-radio" id="analisa_resep_interaksi_obat">
                                            <input type="radio" class="css-control-input analisa_resep_interaksi_obat_0" name="analisa_resep_interaksi_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>15. Tidak Ada Kontra Indikasi</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm css-control-primary css-radio" id="analisa_resep_kontra_indikasi">
                                            <input type="radio" class="css-control-input analisa_resep_kontra_indikasi_1" name="analisa_resep_kontra_indikasi" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="css-control css-control-sm control css-control-primary css-radio" id="analisa_resep_kontra_indikasi">
                                            <input type="radio" class="css-control-input analisa_resep_kontra_indikasi_0" name="analisa_resep_kontra_indikasi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Obat</th>
                                            <th>Jumlah</th>
                                            <th>Aturan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="analisa-tabel-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan-analisa">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>