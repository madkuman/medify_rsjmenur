
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Transfer Pasien</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                        	
							<div class="form-group col-md-3 col-sm-12">
							    <label>Dari Ruangan</label>
							    <input type="text" class="form-control" name="dari_ruangan" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Ke Ruangan</label>
							    <input type="text" class="form-control" name="ke_ruangan" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Tingkat Kesadaran</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran" value="Composmentis">
							            <span class="css-control-indicator"></span> Composmentis
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran" value="Somnolen">
							            <span class="css-control-indicator"></span> Somnolen
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran" value="Apatis">
							            <span class="css-control-indicator"></span> Apatis
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran" value="Stupor">
							            <span class="css-control-indicator"></span> Stupor
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran" value="Coma">
							            <span class="css-control-indicator"></span> Coma
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GCS</label>
							    <input type="text" class="form-control" name="gcs" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Keadaan Umum</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="keadaan_umum" value="Baik">
							            <span class="css-control-indicator"></span> Baik
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="keadaan_umum" value="Cukup">
							            <span class="css-control-indicator"></span> Cukup
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="keadaan_umum" value="Buruk">
							            <span class="css-control-indicator"></span> Buruk
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h4 class="pt-15">Tanda Tanda Vital</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tensi</label>
							    <input type="text" class="form-control" name="tensi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Suhu</label>
							    <input type="text" class="form-control" name="suhu" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>EWS / PEWS / IMEWS</label>
							    <input type="text" class="form-control" name="ews" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>RR</label>
							    <input type="text" class="form-control" name="rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>DJJ</label>
							    <input type="text" class="form-control" name="djj" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>CVP</label>
							    <input type="text" class="form-control" name="cvp" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>N</label>
							    <input type="text" class="form-control" name="n" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>SpO2</label>
							    <input type="text" class="form-control" name="spo2" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV Lain lain</label>
							    <input type="text" class="form-control" name="ttv_lain_lain" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Identifikasi Pasien</h4>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Gelang Identifikasi Pasien</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="gelang_identifikasi_pasien" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="gelang_identifikasi_pasien" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Persetujuan MRS / Tindakan / Operasi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="persetujuan_mrs_operasi" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="persetujuan_mrs_operasi" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Lembar Observasi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="lembar_observasi" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="lembar_observasi" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Konsul dr Spesialis</label>
							    <input type="text" class="form-control" name="konsul_dr_spesialis" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Pasang Infus</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pasang_infus" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pasang_infus" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Laboratorium</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_dl">
							            <span class="css-control-indicator"></span> DL
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_gda">
							            <span class="css-control-indicator"></span> GDA
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_bjp">
							            <span class="css-control-indicator"></span> BJP
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_elektrolit">
							            <span class="css-control-indicator"></span> Elektrolit
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_kk">
							            <span class="css-control-indicator"></span> KK
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="laboratorium_bga">
							            <span class="css-control-indicator"></span> BGA
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Lab Lainnya</label>
							    <input type="text" class="form-control" name="lab_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">ECG Posisi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="ecg_posisi" value="Kiri">
							            <span class="css-control-indicator"></span> Kiri
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="ecg_posisi" value="Kanan">
							            <span class="css-control-indicator"></span> Kanan
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">ECG Jenis</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="ecg_jenis" value="6">
							            <span class="css-control-indicator"></span> 6
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="ecg_jenis" value="9">
							            <span class="css-control-indicator"></span> 9
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="ecg_jenis" value="12">
							            <span class="css-control-indicator"></span> 12
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Radiologi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="radiologi_throax">
							            <span class="css-control-indicator"></span> Throax
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="radiologi_ct_scan">
							            <span class="css-control-indicator"></span> CT Scan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="radiologi_mri">
							            <span class="css-control-indicator"></span> MRI
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="radiologi_usg">
							            <span class="css-control-indicator"></span> USG
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Radiologi Lainnya</label>
							    <input type="text" class="form-control" name="radiologi_lainnya" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kateter Ukuran</label>
							    <input type="text" class="form-control" name="kateter_ukuran" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kateter Fiksasi</label>
							    <input type="text" class="form-control" name="kateter_fiksasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kateter UP</label>
							    <input type="text" class="form-control" name="kateter_up" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diet Oral</label>
							    <input type="text" class="form-control" name="diet_oral" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diet Enteral</label>
							    <input type="text" class="form-control" name="diet_enteral" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Diet NGT Residu</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="diet_ngt_residu" value="plus">
							            <span class="css-control-indicator"></span> plus
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="diet_ngt_residu" value="minus">
							            <span class="css-control-indicator"></span> minus
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diet NGT Residu Volume</label>
							    <input type="text" class="form-control" name="diet_ngt_residu_volume" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diet NGT Residu Warna</label>
							    <input type="text" class="form-control" name="diet_ngt_residu_warna" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diet Parenteral</label>
							    <input type="text" class="form-control" name="diet_parenteral" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rawat Luka - Luas Luka</label>
							    <input type="text" class="form-control" name="rawat_luka_luas_luka" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rawat Luka - Jumlah Luka</label>
							    <input type="text" class="form-control" name="rawat_luka_jumlah_luka" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Drainage</label>
							    <input type="text" class="form-control" name="drainage" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jahit Luka - Jenis Benang</label>
							    <input type="text" class="form-control" name="jahit_luka_jenis_benang" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jahit Luka - Jumlah</label>
							    <input type="text" class="form-control" name="jahit_luka_jumlah" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Obat Obatan Oral</label><br>
							    <select style="width: 100%" class="js-select2 form-control" name="obat_obatan_oral[]" multiple id="obat_obatan_oral">
							    	@foreach($obat as $item)
							    	<option value="{{$item}}">{{$item}}</option>
							    	@endforeach
							    </select>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Obat Obatan Parenteral</label><br>
							    <select style="width: 100%" class="js-select2 form-control" name="obat_obatan_parenteral[]" multiple id="obat_obatan_parenteral">
							    	@foreach($obat as $item)
							    	<option value="{{$item}}">{{$item}}</option>
							    	@endforeach
							    </select>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Oksigen Jenis</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="oksigen_jenis_nasale">
							            <span class="css-control-indicator"></span> Nasale
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="oksigen_jenis_masker">
							            <span class="css-control-indicator"></span> Masker
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="oksigen_jenis_jacson_race">
							            <span class="css-control-indicator"></span> Jacson Race
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Oksigen Ukuran</label>
							    <input type="text" class="form-control" name="oksigen_ukuran" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Derajat Transfer</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="derajat_transfer" value="0">
							            <span class="css-control-indicator"></span> 0
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="derajat_transfer" value="1">
							            <span class="css-control-indicator"></span> 1
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="derajat_transfer" value="2">
							            <span class="css-control-indicator"></span> 2
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="derajat_transfer" value="3">
							            <span class="css-control-indicator"></span> 3
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Pendamping Transfer</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="pendamping_transfer_pemandu">
							            <span class="css-control-indicator"></span> Pemandu
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="pendamping_transfer_perawat">
							            <span class="css-control-indicator"></span> Perawat
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="pendamping_transfer_dokter">
							            <span class="css-control-indicator"></span> Dokter
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="pendamping_transfer_dokter_spesialis">
							            <span class="css-control-indicator"></span> Dokter Spesialis
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Metode Transfer</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="metode_transfer" value="Kursi Roda">
							            <span class="css-control-indicator"></span> Kursi Roda
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="metode_transfer" value="Brankar">
							            <span class="css-control-indicator"></span> Brankar
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="metode_transfer" value="Tempat Tidur">
							            <span class="css-control-indicator"></span> Tempat Tidur
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="metode_transfer" value="Ambulan">
							            <span class="css-control-indicator"></span> Ambulan
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Perawat pasien lanjutan yang masih dilanjutkan</label>
							    <input type="text" class="form-control" name="perawat_pasien_lanjutan_yang_masih_dilanjutkan" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Monitoring Selama Transfer</h3>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Tingkat Kesadaran Selama Transfer</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran_selama_transfer" value="Composmentis">
							            <span class="css-control-indicator"></span> Composmentis
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran_selama_transfer" value="Somnolent">
							            <span class="css-control-indicator"></span> Somnolent
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran_selama_transfer" value="Apatis">
							            <span class="css-control-indicator"></span> Apatis
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran_selama_transfer" value="Stupor">
							            <span class="css-control-indicator"></span> Stupor
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="tingkat_kesadaran_selama_transfer" value="Coma">
							            <span class="css-control-indicator"></span> Coma
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GCS Selama Transfer</label>
							    <input type="text" class="form-control" name="gcs_selama_transfer" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kejadian Klinis Selama Transfer</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kejadian_klinis_selama_transfer" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kejadian_klinis_selama_transfer" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Barang Pasien</label>
							    <textarea class="form-control" name="barang_pasien" > </textarea>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Keluarga Nama</label>
							    <input type="text" class="form-control" name="keluarga_nama" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Keluarga No HP</label>
							    <input type="text" class="form-control" name="keluarga_no_hp" >
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
