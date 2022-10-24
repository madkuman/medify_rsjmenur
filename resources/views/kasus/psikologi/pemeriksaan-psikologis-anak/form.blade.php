<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Tes</label>
			    <input type="text" class="form-control" name="tujuan_tes" >
			</div>
			
			<div class="col-12">
				<h5 class="pt-15">Observasi</h5>
			</div>


			<div class="col-12">
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<th width="15%" class="text-center">Aspek Observasi</th>
			    		<th width="27%" class="text-center">Gambaran Individu (Skor Rendah)</th>
			    		<th width="5%" class="text-center">SR</th>
			    		<th width="7%" class="text-center">R</th>
			    		<th width="7%" class="text-center">S</th>
			    		<th width="7%" class="text-center">T</th>
			    		<th width="5%" class="text-center">ST</th>
			    		<th width="27%" class="text-center">Gambaran Individu (Skor Tinggi)</th>
					</tr>
			    	<tr>
			    		<td align="center" rowspan="4">Sikap terhadap tester dan situasi tes</td>
			    		<td align="center">Tidak mau bekerja sama</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerja_sama" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerja_sama" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerja_sama" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerja_sama" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerja_sama" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Bisa bekerja sama</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Pasif</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_pasif_aktif" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_pasif_aktif" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_pasif_aktif" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_pasif_aktif" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_pasif_aktif" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Aktif</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Tegang</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_tegang_tenang" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_tegang_tenang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_tegang_tenang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_tegang_tenang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_tegang_tenang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Tenang</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Sulit Menjawab</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_menjawab" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_menjawab" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_menjawab" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_menjawab" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="tester_menjawab" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Mudah Menjawab</td>
			    	</tr>

			    	<tr>
			    		<td align="center" rowspan="2">Sikap terhadap diri sendiri</td>
			    		<td align="center">Ragu-ragu</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_keyakinan" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_keyakinan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_keyakinan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_keyakinan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_keyakinan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Yakin</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Menerima</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_penerimaan" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_penerimaan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_penerimaan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_penerimaan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="sikap_penerimaan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Kritis</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="4">Cara Kerja</td>
			    		<td align="center">Lambat</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Cepat</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Ceroboh</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecekatan_kerja" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecekatan_kerja" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecekatan_kerja" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecekatan_kerja" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecekatan_kerja" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Hati-hati</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Berpikir lambat</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pikiran_kerja" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pikiran_kerja" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pikiran_kerja" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pikiran_kerja" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pikiran_kerja" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Berpikir Cepat</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Sembarangan</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerapian_kerja" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerapian_kerja" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerapian_kerja" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerapian_kerja" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kerapian_kerja" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Rapi</td>
			    	</tr>

                    <tr>
			    		<td align="center">Perilaku</td>
			    		<td align="center">Hiperaktif</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perilaku" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perilaku" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perilaku" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perilaku" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perilaku" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Tenang</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="3">Reaksi terhadap kegagalan</td>
			    		<td align="center">Tidak Tahu</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengetahuan_kegagalan" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengetahuan_kegagalan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengetahuan_kegagalan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengetahuan_kegagalan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengetahuan_kegagalan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Mengetahui</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kurang Usaha</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="usaha" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="usaha" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="usaha" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="usaha" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="usaha" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Bekerja Keras</td>
			    	</tr>

                    <tr>
			    		<td align="center">Gelisah</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kegagalan" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kegagalan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kegagalan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kegagalan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kegagalan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Tenang</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="2">Reaksi dan cara bicara</td>
			    		<td align="center">Janggal</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="ketenangan_bicara" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="ketenangan_bicara" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="ketenangan_bicara" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="ketenangan_bicara" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="ketenangan_bicara" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Tenang</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kurang bergairah</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_bicara" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_bicara" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_bicara" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_bicara" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_bicara" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Semakin Giat</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="3">Bahasa dan cara bicara</td>
			    		<td align="center">Kurang baik</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_bicara" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_bicara" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_bicara" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_bicara" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_bicara" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Cara bicara baik</td>
			    	</tr>

                    <tr>
			    		<td align="center">Tidak jelas / tidak dapat dimengerti</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kejelasan_jawaban" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kejelasan_jawaban" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kejelasan_jawaban" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kejelasan_jawaban" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kejelasan_jawaban" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Jawaban jelas</td>
			    	</tr>

                    <tr>
			    		<td align="center">Hanya bicara bila ditanya</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecakapan_bicara" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecakapan_bicara" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecakapan_bicara" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecakapan_bicara" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecakapan_bicara" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Spontan</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="3">Visual Motorik</td>
			    		<td align="center">Rekasi Lambat</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_reaksi" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_reaksi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_reaksi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_reaksi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecepatan_reaksi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Reaksi cepat</td>
			    	</tr>

                    <tr>
			    		<td align="center">Coba-coba</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_kehati_hatian" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_kehati_hatian" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_kehati_hatian" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_kehati_hatian" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_kehati_hatian" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Hati-hati sistematis</td>
			    	</tr>

                    <tr>
			    		<td align="center">Gerakan janggal</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_gerakan" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_gerakan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_gerakan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_gerakan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="reaksi_gerakan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Gerakan baik</td>
			    	</tr>

                    <tr>
			    		<td align="center">Motorik</td>
			    		<td align="center">Kordinasi kurang baik</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="keadaan_koordinasi_motorik" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="keadaan_koordinasi_motorik" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="keadaan_koordinasi_motorik" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="keadaan_koordinasi_motorik" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="keadaan_koordinasi_motorik" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Koordinasi baik</td>
			    	</tr>
				</table>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

            <div class="form-group col-md-3 col-sm-12">
			    <label>Kategori</label>
			    <input type="text" class="form-control" name="kategori" >
			</div>

            <div class="col-12">
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<th width="15%" class="text-center" colspan="2">Aspek Psikologis</th>
			    		<th width="27%" class="text-center">Gambaran Individu (Skor Rendah)</th>
			    		<th width="5%" class="text-center">SR</th>
			    		<th width="7%" class="text-center">R</th>
			    		<th width="7%" class="text-center">S</th>
			    		<th width="7%" class="text-center">T</th>
			    		<th width="5%" class="text-center">ST</th>
			    		<th width="27%" class="text-center">Gambaran Individu (Skor Tinggi)</th>
					</tr>
			    	<tr>
			    		<td align="center" rowspan="4">Kemampuan Intelektual</td>
			    		<td align="center">Kecerdasan Umum</td>
                        <td align="center">Potensi kecerdasan secara umum kurang</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Potensi kecerdasan secara umum memadai</td>
			    	</tr>
                    
                    <tr>
			    		<td align="center">Pengamatan ruang</td>
                        <td align="center">Kurang teliti dalam menyelesaikan tugas</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengamatan_ruang" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengamatan_ruang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengamatan_ruang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengamatan_ruang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengamatan_ruang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Teliti dalam menyelesaikan suatu tugas</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kemampuan Analisa</td>
                        <td align="center">Kurang mampu berpikir menyeluruh dalam menghadapi persoalan</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_analisa" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_analisa" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_analisa" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_analisa" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_analisa" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Kemampuan berpikir menyeluruh, menangkap, dan membentuk sesuatu</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kemampuan berpikir Analogi</td>
                        <td align="center">Kurang mampu menalar masalah dan mengambil kesimpulan atas suatu persoalan</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berpikir_analogi" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berpikir_analogi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berpikir_analogi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berpikir_analogi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berpikir_analogi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Mampu menalar masalah dan mengambil kesimpulan atas suatu persoalan</td>
			    	</tr>

                    <tr>
			    		<td align="center" rowspan="4">Kecerdasan Emosi</td>
			    		<td align="center">Emosi</td>
                        <td align="center">Emosional, mudah tersinggung, dan lebih dipengaruhi perasaan.</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="emosi" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="emosi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="emosi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="emosi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="emosi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Kemampuan mengendalikan emosi dengan baik dan tidak mudah reaktif terhadap situasi lingkungan</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kemampuan Sosial</td>
                        <td align="center">Kurang memperhatikan tuntunan-tuntunan sosial.</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_sosial" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_sosial" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_sosial" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_sosial" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_sosial" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Peka atau tanggap terhadap perasaan dan kebutuhan orang lain di lingkungan sosial</td>
			    	</tr>

                    <tr>
			    		<td align="center">Kemampuan Adaptasi</td>
                        <td align="center">Kaku, kurang luwes, membutuhkan waktu lama untuk menyesuaikan diri.</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Mampu menyesuaikan diri dengan perubahan situasi</td>
			    	</tr>

                    <tr>
			    		<td align="center">Motivasi Berprestasi</td>
                        <td align="center">Mudah puas, kurang memiliki dorongan yang kuat untuk mencapai hasil atu prestasi yang lebih dari sekedarnya.</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="motivasi_prestasi" value="SR">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="motivasi_prestasi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="motivasi_prestasi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="motivasi_prestasi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="motivasi_prestasi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Memiliki dorongan untuk melakukan pekerjaan secara maksimal serta berusaha untuk mencapai hasil atau prestasi sebaik mungkin</td>
			    	</tr>
				</table>
			</div>
    		
			<div class="form-group col-md-7 col-sm-12">
			    <label>Kesimpulan</label>
			    <textarea class="form-control" name="kesimpulan" id="kesimpulan" rows="5"> </textarea>
			</div>

            <div class="form-group col-md-7 col-sm-12">
			    <label>Saran</label>
			    <textarea class="form-control" name="saran" id="saran" rows="5"> </textarea>
			</div>
			
			<div class="form-group col-md-7 col-sm-12">
			    <label>Catatan</label>
			    <textarea class="form-control" name="catatan" id="catatan" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>