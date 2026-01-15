<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}

			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">

               <!-- header -->
					<div class="block-header ">
						<h3 class="block-title">Panss Remisi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>

               <!-- content -->
               <div class="block-content row">
                  <div class="form-group col-md-4 col-sm-12">
                     <label>Tanggal Pemeriksaan</label>
                     <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
                  </div>
               </div>

					<div class="block-content row">
                  <div class="col-md-6">
							<h5>Positive and Negative Syndromes Scale</h5>
                     <div class="form-group row" style="margin-top: 70px">
								<label class="col-12">P I  : WAHAM</label>
							</div>
                     <div class="form-group row pt-3">
								<label class="col-12">P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION)</label>
							</div>
                     <div class="form-group row pt-3">
								<label class="col-12">P 3 : PERILAKU HALUSINASI</label>
							</div>
                     <div class="form-group row pt-3">
								<label class="col-12">N I : AFEK TUMPUL</label>
							</div>
                     <div class="form-group row pt-2">
								<label class="col-12">N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS</label>
							</div>
                     <div class="form-group row">
								<label class="col-12">N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN</label>
							</div>
                     <div class="form-group row pt-3">
								<label class="col-12">G 5 : MEKANISME DAN SIKAP TUBUH</label>
							</div>
                     <div class="form-group row pt-1">
								<label class="col-12">G 9 : ISI PIKIRAN YANG TIDAK  BIASA</label>
							</div>
                  </div>

                  
                  {{-- <div class="col-md-4">
							<h5>Tanggal Pemeriksaan</h5>
                     <p>MASUK <span style="padding-left: 110px">KELUAR</span></p>

                     <!-- P I  : WAHAM -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p1_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p1_keluar">
                        </div>
							</div>

                     <!-- P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION) -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p2_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p2_keluar">
                        </div>
							</div>

                     <!-- P 3 : PERILAKU HALUSINASI -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p3_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="p3_keluar">
                        </div>
							</div>

                     <!-- N I : AFEK TUMPUL -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n1_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n1_keluar">
                        </div>
							</div>

                     <!-- N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n4_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n4_keluar">
                        </div>
							</div>

                     <!-- N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n6_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="n6_keluar">
                        </div>
							</div>

                     <!-- G 5 : MEKANISME DAN SIKAP TUBUH -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="g5_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="g5_keluar">
                        </div>
							</div>

                     <!-- G 9 : ISI PIKIRAN YANG TIDAK BIASA -->
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="g9_masuk">
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="date" name="g9_keluar">
                        </div>
							</div>
                  </div> --}}


                  <div class="col-md-6">
                     <h5>Score</h5>
                     <p>Isian skala 1 - 7</p>

                     <!-- P I  : WAHAM -->
                     <div class="form-group row">
                        <select name="p1_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>

                     <!-- P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION) -->
                     <div class="form-group row">
                        <select name="p2_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>

                     <!-- P 3 : PERILAKU HALUSINASI -->
                     <div class="form-group row">
                        <select name="p3_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>

                     <!-- N I : AFEK TUMPUL -->
                     <div class="form-group row">
                        <select name="n1_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>
                     
                     <!-- N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS -->
                     <div class="form-group row">
                        <select name="n4_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>
                     
                     <!-- N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN -->
                     <div class="form-group row">
                        <select name="n6_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>
                     
                     <!-- G 5 : MEKANISME DAN SIKAP TUBUH -->
                     <div class="form-group row">
                        <select name="g5_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>

                     <!-- G 9 : ISI PIKIRAN YANG TIDAK BIASA -->
                     <div class="form-group row">
                        <select name="g9_score" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
							</div>
                  </div>
                  
					</div>

				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->

		</form>
	</div><!-- /.modal -->
</div>