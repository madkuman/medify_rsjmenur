<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Alasan Pengiriman</label>
			    <input type="text" class="form-control" name="alasan_pengiriman" >
			</div>

	    	<div class="col-12">
	    		<h5>A. Sikap terhadap tester dan situasi tes</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>1.</td>
						<td>Bisa bekerja sama</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bisa_bekerja_sama" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bisa_bekerja_sama" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bisa_bekerja_sama" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bisa_bekerja_sama" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bisa_bekerja_sama" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Tidak mau bekerja sama</td>
					</tr>

					<tr>
						<td>2.</td>
						<td>Aktif</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="aktif" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="aktif" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="aktif" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="aktif" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="aktif" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Pasif</td>
					</tr>

					<tr>
						<td>3.</td>
						<td>Tenang</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="sikap_tenang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="sikap_tenang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="sikap_tenang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="sikap_tenang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="sikap_tenang" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Tegang</td>
					</tr>

					<tr>
						<td>4.</td>
						<td>Mudah menjawab</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Sulit Menjawab</td>
					</tr>
				</table>
			</div>

			<div class="col-12">
	    		<h5>B. Sikap terhadap diri sendiri</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>5.</td>
						<td>Yakin</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="yakin" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="yakin" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="yakin" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="yakin" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="yakin" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Ragu-ragu</td>
					</tr>

					<tr>
						<td>6.</td>
						<td>Kritis</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="kritis" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="kritis" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="kritis" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="kritis" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="kritis" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Menerima</td>
					</tr>
				</table>
			</div>
	    	
			<div class="col-12">
	    		<h5>C. Cara kerja</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>7.</td>
						<td>Cepat</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cepat" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cepat" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cepat" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cepat" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cepat" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Lambat</td>
					</tr>

					<tr>
						<td>8.</td>
						<td>Hati-hati</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="hati_hati" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="hati_hati" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="hati_hati" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="hati_hati" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="hati_hati" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Ceroboh</td>
					</tr>

					<tr>
						<td>9.</td>
						<td>Berpikir cepat</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="berpikir_cepat" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="berpikir_cepat" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="berpikir_cepat" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="berpikir_cepat" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="berpikir_cepat" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Berpikir lambat</td>
					</tr>

					<tr>
						<td>4.</td>
						<td>Rapi</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="rapi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="rapi" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="rapi" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="rapi" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mudah_menjawab" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Sembarangan</td>
					</tr>
				</table>
			</div>

			<div class="col-12">
	    		<h5>D. Perilaku</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>11.</td>
						<td>Tenang</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="perilaku_tenang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="perilaku_tenang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="perilaku_tenang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="perilaku_tenang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="perilaku_tenang" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Hiperaktif</td>
					</tr>
				</table>
			</div>
			
			<div class="col-12">
	    		<h5>E. Reaksi terhadap kegagalan</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>12.</td>
						<td>Mengetahui</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mengetahui" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mengetahui" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mengetahui" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mengetahui" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="mengetahui" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Tidak tahu</td>
					</tr>

					<tr>
						<td>13.</td>
						<td>Bekerja keras</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bekerja_keras" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bekerja_keras" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bekerja_keras" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bekerja_keras" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="bekerja_keras" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Kurang usaha</td>
					</tr>

					<tr>
						<td>14.</td>
						<td>Tenang</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_gagal_tenang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_gagal_tenang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_gagal_tenang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_gagal_tenang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_gagal_tenang" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Gelisah</td>
					</tr>
				</table>
			</div>

			<div class="col-12">
	    		<h5>F. Reaksi dan cara bicara</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>15.</td>
						<td>Tenang</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_tenang" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_tenang" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_tenang" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_tenang" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_tenang" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Janggal</td>
					</tr>

					<tr>
						<td>16.</td>
						<td>Semakin giat</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="semakin_giat" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="semakin_giat" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="semakin_giat" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="semakin_giat" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="semakin_giat" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Kurang bergairah</td>
					</tr>
				</table>
			</div>
			
			<div class="col-12">
	    		<h5>G. Bahasa dan cara bicara</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>17.</td>
						<td>Cara bicara baik</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cara_bicara_baik" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cara_bicara_baik" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cara_bicara_baik" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cara_bicara_baik" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="cara_bicara_baik" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Kurang baik</td>
					</tr>

					<tr>
						<td>18.</td>
						<td>Jawaban jelas</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="jawaban_jelas" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="jawaban_jelas" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="jawaban_jelas" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="jawaban_jelas" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="jawaban_jelas" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Tidak jelas/tidak dapat dimengerti</td>
					</tr>

					<tr>
						<td>19.</td>
						<td>Spontan</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="spontan" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="spontan" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="spontan" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="spontan" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="spontan" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Hanya bicara jika ditanya</td>
					</tr>
				</table>
			</div>
			
			<div class="col-12">
	    		<h5>H. Visual motorik</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>20.</td>
						<td>Reaksi Cepat</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_cepat" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_cepat" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_cepat" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_cepat" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="reaksi_cepat" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Reaksi Lambat</td>
					</tr>

					<tr>
						<td>21.</td>
						<td>Hati-hati dan sistematis</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="coba_coba" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="coba_coba" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="coba_coba" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="coba_coba" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="coba_coba" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Coba-coba</td>
					</tr>

					<tr>
						<td>22.</td>
						<td>Gerakan Baik</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="gerakan_baik" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="gerakan_baik" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="gerakan_baik" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="gerakan_baik" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="gerakan_baik" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Gerakan Janggal</td>
					</tr>
				</table>
			</div>

			<div class="col-12">
	    		<h5>I. Motorik</h5>
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<td>23.</td>
						<td>Koordinasi baik</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="koordinasi_baik" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="koordinasi_baik" value="T">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="koordinasi_baik" value="S">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="koordinasi_baik" value="R">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center" class="p-0">
							<label class="css-control css-control-primary css-radio w-100 p-20">
					            <input type="radio" class="css-control-input" name="koordinasi_baik" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td>Koordinasi kurang baik</td>
					</tr>
				</table>
			</div>
			
			<div class="col-12">
				<h5 class="pt-15">Hasil Tes</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Intelegensi Umum</label>
			    <input type="text" class="form-control" name="intelegensi_umum" >
			</div>


			<div class="col-12">
				<table class="table table-bordered table-vcenter table-responsive">
					<tr>
						<th width="15%" rowspan="2" class="text-center">Aspek Psikologis</th>
			    		<th width="27%" rowspan="2" class="text-center">Gambaran keadaan anak jika memperoleh skor / nilai tinggi</th>
			    		<th width="5%" class="text-center">TS</th>
			    		<th width="7%" colspan="2" class="text-center">T</th>
			    		<th width="7%" colspan="2" class="text-center">S</th>
			    		<th width="7%" colspan="2" class="text-center">R</th>
			    		<th width="5%" class="text-center">RS</th>
			    		<th width="27%" rowspan="2" class="text-center">Gambaran keadaan anak jika memperoleh skor / nilai rendah</th>
					</tr>
					<tr>
			    		<th class="text-center">8</th>
			    		<th class="text-center">7</th>
			    		<th class="text-center">6</th>
			    		<th class="text-center">5</th>
			    		<th class="text-center">4</th>
			    		<th class="text-center">3</th>
			    		<th class="text-center">2</th>
			    		<th class="text-center">1</th>
			    	</tr>
			    	<tr>
			    		<td align="center">Pengertian Umum</td>
			    		<td align="center">Telah memahami dan mengerti hal-hal/kejadian di lingkungan sekitarnya. Mampu memahami fungsi suatu benda dan bisa mencari pemecahan masalah yang tepat</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pengertian_umum" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Belum dapat memahami hal/kejadian di lingkungan sekitarnya, dan belum dapat memberikan pemecahan masalah yang tepat.</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Kemampuan Visual-Motor</td>
			    		<td align="center">Mampu mengkoordinasikan penglihatan dan gerakan tangan dengan baik</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_visual_motor" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Belum dapat mengkoordinasikan penglihatan dan gerakan tangan dengan baik</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Kemampuan Berhitung</td>
			    		<td align="center">Sudah memiliki konsep mengenai angka dan hitungan dengan benar</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_berhitung" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Belum memiliki konsep mengenai angka dan hitungan</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Kemampuan mengingat dan Berkonsentrasi</td>
			    		<td align="center">Mampu memusatkan perhatian pada satu hal secara menetap dan lama</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kemampuan_mengingat_dan_berkonsentrasi" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Belum dapat memusatkan perhatian pada satu hal secara menetap dan lama</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Perbendaharaan Kata</td>
			    		<td align="center">Memiliki banyak perbendaharaan kata dan mampu memaparkan dengan baik.</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="perbendaharaan_kata" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Perbendaharaan kata relatif sedikit dan belum mampu untuk memaparkan dengan baik pada orang lain</td>
			    	</tr>

			    	<tr>
			    		<td align="center">Pemahaman dan penalaran</td>
			    		<td align="center">Mudah memahami suatu persoalan dan bisa menggunakan daya nalar / logika berpikir untuk membuat keputusan</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="TS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="T1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="T2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="S1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="S2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="R1">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="R2">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">
			    			<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="pemahaman_dan_penalaran" value="RS">
					            <span class="css-control-indicator"></span>
					        </label>
			    		</td>
			    		<td align="center">Cenderung membutuhkan waktu lama untuk memahami suatu persoalan dan sering mengalami kesulitan dalam menggunakan logika berpikir</td>
			    	</tr>
				</table>
			</div>
    		
			<div class="form-group col-md-7 col-sm-12">
			    <label>Ringkasan dan saran</label>
			    <textarea class="form-control" name="ringkasan_dan_saran" rows="5"> </textarea>
			</div>
			
			<div class="form-group col-md-7 col-sm-12">
			    <label>Catatan</label>
			    <textarea class="form-control" name="catatan" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>