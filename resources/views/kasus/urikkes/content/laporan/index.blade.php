<div class="content pt-0">
	<form class="js-validation-be-contact col-12" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/laporan/print" method="post" id="form_laporan">
		{{ csrf_field() }}
		<input type="hidden" class="form-control form-control-lg" id="" name="id" placeholder="" value="{{$kasus->pasien_id}}">
		<div class="form-group row">
			<div class="col-6">
				<label>Tanggal Pemeriksaan</label>
				<input type="text" name="waktu_pemeriksaan" class="form-control js-datepicker" placeholder="Tanggal Pemeriksaan Pasien" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" value="{{!is_null($transaksi) ? date('d-m-Y', strtotime($transaksi->waktu_pemeriksaan)) : date('d-m-Y')}}">
			</div>
			<div class="col-6">
				<label>Tanggal Print</label>
				<input type="text" name="waktu_print" class="form-control js-datepicker" placeholder="Tanggal Print Buku" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" value="{{!is_null($transaksi) ? date('d-m-Y', strtotime($transaksi->waktu_print)) : date('d-m-Y')}}">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-6">
				<label for="dokter_laporan">Tanda Tangan</label>
				<select  class="form-control form-control-lg js-select2" data-size="5" id="dokter_laporan" name="dokter" style="width: 100%;" placeholder="Dokter Pemeriksa">
					<option value="" disabled>Pilih Dokter</option>
					@foreach($dokter as $doc)
					<option value="{{$doc->id}}" data-sebagai="{{$doc->sebagai}}" data-keterangan="{{$doc->keterangan}}" >{{$doc->nama}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<input class="form-control form-control-lg" type="hidden" name="ket_dokter" id="dokter_ket"></input>
		<hr>
		<div class="form-group">
			<label>Daftar Parameter Narkoba</label>
			<div class="row">
				<div class="col-6">
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="narkoba_morhpin" id="narkoba_morhpin" value="1">
						<label class="custom-control-label" for="narkoba_morhpin">Morphin</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="narkoba_metamphetamine" id="narkoba_metamphetamine" value="1">
						<label class="custom-control-label" for="narkoba_metamphetamine">Metamphetamine</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="narkoba_amphetamine" id="narkoba_amphetamine" value="1">
						<label class="custom-control-label" for="narkoba_amphetamine">Amphetamine</label>
					</div> 
				</div>
				<div class="col-6">
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="narkoba_diazepam" id="narkoba_diazepam" value="1">
						<label class="custom-control-label" for="narkoba_diazepam">Diazepam</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="narkoba_ganja" id="narkoba_ganja" value="1">
						<label class="custom-control-label" for="narkoba_ganja">Ganja</label>
					</div> 
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Daftar Parameter Immunologi</label>
			<div class="row">
				<div class="col-6">
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_hbsag" id="imun_hbsag" value="1" checked>
						<label class="custom-control-label" for="imun_hbsag">HBs Ag</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_antihiv" id="imun_antihiv" value="1" checked>
						<label class="custom-control-label" for="imun_antihiv">Anti HIV</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_antihcv" id="imun_antihcv" value="1" checked>
						<label class="custom-control-label" for="imun_antihcv">Anti HCV</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_ictmalaria" id="imun_ictmalaria" value="1" checked>
						<label class="custom-control-label" for="imun_ictmalaria">ICT Malaria</label>
					</div> 
				</div>
				<div class="col-6">
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_vdrl" id="imun_vdrl" value="1" checked>
						<label class="custom-control-label" for="imun_vdrl">VDRL</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_coomb" id="imun_coomb" value="1" checked>
						<label class="custom-control-label" for="imun_coomb">Coomb Test</label>
					</div> 
					<div class="custom-control custom-checkbox mb-5 col-6">
						<input class="custom-control-input" type="checkbox" name="imun_hbeag" id="imun_hbeag" value="1" checked>
						<label class="custom-control-label" for="imun_hbeag">HB eAG</label>
					</div> 
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group row justify-content-center">
			@if(count($evaluasi) == 0)
			<div class="col-12 text-center  mb-10">
				<h6 class="text-danger"><i class="fa fa-exclamation-circle fa-danger"></i> Data Fisik Harus Diisi Terlebih Dahulu </h6>
			</div>
			<div class="col-12 row justify-content-center">
				<button class="btn btn-primary print mx-10" type="submit" value="dinas"  disabled="">Pasien Dinas</button>
				<button class="btn btn-primary print mx-10" type="submit" value="umum"  disabled="">Pasien Umum</button>
				<button class="btn btn-primary print mx-10" type="submit" value="rsal"  disabled=""> Hasil Lab</button>
				<button class="btn btn-primary print mx-10" type="submit" value="fisik"  disabled=""> Pemeriksaan Fisik</button>
				<button class="btn btn-primary print mx-10" type="submit" value="napza"  disabled=""> Pemeriksaan Napza</button>
			</div>
			<div class="col-12 row justify-content-center mt-10">
				<button class="btn btn-primary print mx-10" type="submit" value="sk_keswa"  disabled=""> SK Keswa</button>
				<button class="btn btn-primary print mx-10" type="submit" value="sk_dokter"  disabled=""> SK Dokter</button>
			</div>
			@else
			<div class="col-12 row justify-content-center">
				<!--
				<div>
					<a class="btn btn-primary print dropdown-toggle" id="dinas-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">Pasien Dinas </a>
					<div class="dropdown-menu" aria-labelledby="dinas-dropdown">
						<button class="btn btn-primary print dropdown-item" type="submit" onclick="changeValueJenisPasien('dinas1')">Bagian 1</button>
						<button class="btn btn-primary print dropdown-item" type="submit" onclick="changeValueJenisPasien('dinas2')">Bagian 2</button>
					</div>
				</div>

				<div>
					<a class="btn btn-primary print dropdown-toggle" id="umum-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">Pasien Umum </a>
					<div class="dropdown-menu" aria-labelledby="umum-dropdown">
						<button class="btn btn-primary print dropdown-item" type="submit" onclick="changeValueJenisPasien('umum1')">Bagian 1-2</button>
						<button class="btn btn-primary print dropdown-item" type="submit" onclick="changeValueJenisPasien('umum2')">Bagian 3-4</button>
					</div>
				</div>-->
				<button class="btn btn-primary mx-10" type="button" onclick="showDinasButton()">Buku Dinas</button>
				<button class="btn btn-primary mx-10" type="button" onclick="showUmumButton()">Buku Umum</button>

				<button class="btn btn-primary mx-10 print" type="submit"  onclick="changeValueJenisPasien('rsal')">Hasil Lab</button>
				<button class="btn btn-primary mx-10 print" type="button" id="laporan-fisik"  onclick="changeValueJenisPasien('fisik')"> Pemeriksaan Fisik</button>
				<input type="hidden" name="laborat" id="laborat_input" disabled>
				<input type="hidden" name="kesimpulan" id="kesimpulan_input" disabled>
				<input type="hidden" name="saran" id="saran_input" disabled>
				<input type="hidden" name="jari_jari" id="jari_jari_input" disabled> 
				<button class="btn btn-primary mx-10 print" type="button" id="laporan-napza" onclick="changeValueJenisPasien('napza')"> Pemeriksaan Napza</button>
				<input type="hidden" name="nama_ttd" id="nama_ttd_input" disabled>
				<input type="hidden" name="sipds_ttd" id="sipds_ttd_input" disabled>
				<input type="hidden" name="jabatan_ttd" id="jabatan_ttd_input" disabled>
				<input type="hidden" name="instansi_ttd" id="instansi_ttd_input" disabled>
				<input type="hidden" name="keterangan_ttd" id="keterangan_ttd_input" disabled>
				<input type="hidden" name="nama_peminta" id="nama_peminta_input" disabled>
				<input type="hidden" name="sipds_peminta" id="sipds_peminta_input" disabled>
				<input type="hidden" name="jabatan_peminta" id="jabatan_peminta_input" disabled>
				<input type="hidden" name="instansi_peminta" id="instansi_peminta_input" disabled>
				<input type="hidden" name="perihal" id="perihal_input" disabled>
				<input type="hidden" name="tgl_fisik" id="tgl_fisik_input" disabled>
				<input type="hidden" name="tgl_psikiatrik" id="tgl_psikiatrik_input" disabled>
				<input type="hidden" name="tgl_tambahan" id="tgl_tambahan_input" disabled>
				<input type="hidden" name="keperluan" id="keperluan_input" disabled>
				<input type="hidden" name="nomor_surat" id="nomor_surat_input" disabled>
				<input type="hidden" name="tanggal_surat" id="tanggal_surat_input" disabled>
				<!-- <input type="hidden" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan_input" disabled> -->
				<input type="hidden" name="jam_fisik" id="jam_fisik_input" disabled>
				<input type="hidden" name="jam_psikiatrik" id="jam_psikiatrik_input" disabled>
				<input type="hidden" name="jam_tambahan" id="jam_tambahan_input" disabled>
				<input type="hidden" name="dokter2" id="dokter2_input" disabled>
				<input type="hidden" name="jenis_pasien" id="jenis_pasien">
			</div>

			<div class="col-12 row justify-content-center mt-10">
				<button id="laporan-sk-keswa" class="btn btn-primary mx-10" type="button" onclick="changeValueJenisPasien('sk_keswa')">SK Keswa</button>

				<button id="laporan-sk-dokter" class="btn btn-primary mx-10" type="button" onclick="changeValueJenisPasien('sk_dokter')">SK Dokter</button>
			</div>

			@endif


			<div id="buku_dinas_container" class="col-12 pt-20" style="display: none">
				<div class="form-group row">
					<label class="col-12">Buku Dinas</label>
					<div class="col-12">
						<div class="custom-control custom-radio mb-5">
							<input class="custom-control-input" type="radio" name="buku_dinas_bagian" id="dinas-radio1" value="dinas1">
							<label class="custom-control-label" for="dinas-radio1">Bagian 1</label>
						</div>
						<div class="custom-control custom-radio mb-5">
							<input class="custom-control-input" type="radio" name="buku_dinas_bagian" id="dinas-radio2" value="dinas2">
							<label class="custom-control-label" for="dinas-radio2">Bagian 2</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="button" onclick="submitWindow()">Cetak</button>
				</div>
			</div>

			<div id="buku_umum_container" class="col-12 pt-20" style="display: none">
				<div class="form-group row">
					<label class="col-12">Buku Umum</label>
					<div class="col-12">
						<div class="custom-control custom-radio mb-5">
							<input class="custom-control-input" type="radio" name="buku_umum_bagian" id="umum-radio1" value="umum1">
							<label class="custom-control-label" for="umum-radio1">Bagian 1</label>
						</div>
						<div class="custom-control custom-radio mb-5">
							<input class="custom-control-input" type="radio" name="buku_umum_bagian" id="umum-radio2" value="umum2">
							<label class="custom-control-label" for="umum-radio2">Bagian 2</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="button" onclick="submitWindow()">Cetak</button>
				</div>
			</div>

		</div>
	</form>
</div>
</div>