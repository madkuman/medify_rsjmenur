<div class="modal" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}

			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">

                <!-- header -->
					<div class="block-header ">
						<h3 class="block-title">Observasi Tindakan ECT</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>

               <!-- persiapan ect -->
               <div class="block-content row">
                  <div class="col-md-12">
                     <h5>PERSIAPAN ECT</h5>
                     <div class="form-group row">
                        <div class="col-md-2">
                           <label for="tgl_persiapan_ect">Tanggal</label>
                           <input type="date" class="form-control" name="tgl_persiapan_ect" id="tgl_persiapan_ect">
                        </div>
                        <div class="col-md-2">
                           <label for="jam_persiapan_ect">Jam</label>
                           <input type="time" class="form-control" name="jam_persiapan_ect" id="jam_persiapan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="t_persiapan_ect">T</label>
                           <input class="form-control" type="text" name="t_persiapan_ect" id="t_persiapan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="n_persiapan_ect">N</label>
                           <input class="form-control" type="text" name="n_persiapan_ect" id="n_persiapan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="s_persiapan_ect">S</label>
                           <input class="form-control" type="text" name="s_persiapan_ect" id="s_persiapan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="rr_persiapan_ect">RR</label>
                           <input class="form-control" type="text" name="rr_persiapan_ect" id="rr_persiapan_ect">
                        </div>
                        <div class="col-md-4">
                           <label for="puasa_persiapan_ect">Puasa</label>
                           <input class="form-control" type="text" name="puasa_persiapan_ect" id="puasa_persiapan_ect">
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="block-content row" style="margin-top: -35px">
                  <div class="col-md-2">
                     <label for="ptg_ru_persiapan_ect">Petugas Ruangan</label>
                     <br>
                     <select class="js-select2 form-control" name="ptg_ru_persiapan_ect" id="ptg_ru_persiapan_ect" style="width: 100%">
                        @foreach ($user as $item)
                           <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-2">
                     <label for="ptg_ect_persiapan_ect">Petugas ECT</label>
                     <br>
                     <select class="js-select2 form-control" name="ptg_ect_persiapan_ect" id="ptg_ect_persiapan_ect" style="width: 100%">
                        @foreach ($user as $item)
                           <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <!-- end persiapan ect -->

               <!-- pelaksanaan ect -->
               <div class="block-content row">
                  <div class="col-md-12">

                     <h5>PELAKSANAAN ECT</h5>
                     <div class="form-group row">
                        <div class="col-md-1">
                           <label for="t_pelaksanaan_ect">T</label>
                           <input class="form-control" type="text" name="t_pelaksanaan_ect" id="t_pelaksanaan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="n_pelaksanaan_ect">N</label>
                           <input class="form-control" type="text" name="n_pelaksanaan_ect" id="n_pelaksanaan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="s_pelaksanaan_ect">S</label>
                           <input class="form-control" type="text" name="s_pelaksanaan_ect" id="s_pelaksanaan_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="rr_pelaksanaan_ect">RR</label>
                           <input class="form-control" type="text" name="rr_pelaksanaan_ect" id="rr_pelaksanaan_ect">
                        </div>
                        <div class="col-md-2">
                           <label for="jam_pelaksanaan_ect">Jam ECT</label>
                           <input type="time" class="form-control" name="jam_pelaksanaan_ect" id="jam_pelaksanaan_ect">
                        </div>
                        <div class="col-md-2">
                           <label for="dosis_pelaksanaan_ect">Dosis</label>
                           <input class="form-control" type="text" name="dosis_pelaksanaan_ect" id="dosis_pelaksanaan_ect">
                        </div>
                        <div class="col-md-2">
                           <label for="dr_pelaksanaan_ect">Dokter</label>
                           <select class="js-select2 form-control" name="dr_pelaksanaan_ect" id="dr_pelaksanaan_ect" style="width: 100%">
                              @foreach ($dokter as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           <label for="pwt_pelaksanaan_ect">Perawat</label>
                           <select class="js-select2 form-control" name="pwt_pelaksanaan_ect" id="pwt_pelaksanaan_ect" style="width: 100%">
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                  </div>
               </div>

               <div class="block-content row" style="margin-top: -35px">
                  <div class="col-md-2">
                     <label for="jam2_pelaksanaan_ect">Jam</label>
                     <input type="time" class="form-control" name="jam2_pelaksanaan_ect" id="jam2_pelaksanaan_ect">
                  </div>
                  <div class="col-md-1">
                     <label for="kesadaran_pelaksanaan_ect">Kesadaran</label>
                     <input class="form-control" type="text" name="kesadaran_pelaksanaan_ect" id="kesadaran_pelaksanaan_ect">
                  </div>
               </div>
               <!-- end pelaksanaan ect -->

               <!-- post ect -->
               <div class="block-content row">
                  <div class="col-md-12">
                     <h5>POST ECT</h5>
                     
                     <div class="form-group row">
                        <div class="col-md-1">
                           <label for="t_post_ect">T</label>
                           <input class="form-control" type="text" name="t_post_ect" id="t_post_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="n_post_ect">N</label>
                           <input class="form-control" type="text" name="n_post_ect" id="n_post_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="s_post_ect">S</label>
                           <input class="form-control" type="text" name="s_post_ect" id="s_post_ect">
                        </div>
                        <div class="col-md-1">
                           <label for="rr_post_ect">RR</label>
                           <input class="form-control" type="text" name="rr_post_ect" id="rr_post_ect">
                        </div>
                        <div class="col-md-3">
                           <label for="ket_post_ect">Keterangan</label>
                           <input class="form-control" type="text" name="ket_post_ect" id="ket_post_ect">
                        </div>
                     </div>

                  </div>
               </div>
               <!-- end post ect -->

               <!-- serah terima -->
               <div class="block-content row">
                  <div class="col-md-12">
                     <h5>Serah Terima</h5>
                     <div class="form-group row">
                        <div class="col-md-2">
                           <label for="jam_serah_ect">Jam</label>
                           <input type="time" class="form-control" name="jam_serah_ect" id="jam_serah_ect">
                        </div>
                        <div class="col-md-2">
                           <label for="ptg_ect_serah_ect">Petugas ECT</label>
                           <select class="js-select2 form-control" name="ptg_ect_serah_ect" id="ptg_ect_serah_ect" style="width: 100%">
                              @foreach ($user as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           <label for="ptg_ruangan_serah_ect">Petugas Ruangan</label>
                           <select class="js-select2 form-control" name="ptg_ruangan_serah_ect" id="ptg_ruangan_serah_ect" style="width: 100%">
                              @foreach ($user as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                  </div>
               </div>

               <!-- end serah terima -->

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