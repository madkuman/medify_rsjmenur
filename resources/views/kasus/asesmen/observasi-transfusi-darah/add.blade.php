<div class="modal" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}

			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">

                <!-- header -->
					<div class="block-header ">
						<h3 class="block-title">Observasi Transfusi Darah</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>

               <div class="block-content row">
                  <!-- isian perawat -->
                  <div class="col-md-12">
                     <h5>Diisi oleh perawat</h5>
                     <div class="form-group row">
                        <div class="col-md-4">
                           <label for="jenis_komponen_darah">Jenis Komponen Darah</label>
                           <input class="form-control" type="text" name="jenis_komponen_darah" id="jenis_komponen_darah">
                        </div>
                        <div class="col-md-2">
                           <label for="no_kantong_darah">No Kantong Darah</label>
                           <input class="form-control" type="text" name="no_kantong_darah" id="no_kantong_darah">
                        </div>
                        <div class="col-md-2">
                           <label for="golongan_darah">Golongan Darah</label>
                           <input class="form-control" type="text" name="golongan_darah" id="golongan_darah">
                        </div>
                        <div class="col-md-4">
                           <label for="nama_pasien_keluarga">Nama Pasien / Keluarga Pasien</label>
                           <input class="form-control" type="text" name="nama_pasien_keluarga" id="nama_pasien_keluarga">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">
                           <label for="hubungan">Hubungan Dengan Pasien </label>
                           <input class="form-control" type="text" name="hubungan" id="hubungan">
                        </div>
                     </div>
                  </div>
                  <!-- end isian perawat -->


                  <!-- obat-obat yang diberikan -->
                  <div class="col-md-12 mt-3">
                     <h5>Obat-obatan yang diberikan sebelum atau selama transfusi</h5>
                     <div class="form-group row">
                        <div class="col-md-4">
                           <label for="nama_obat_1">Nama Obat</label>
                           <select class="js-select2 form-control" name="nama_obat_1" id="nama_obat_1" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           <label for="dosis_obat_1">Dosis Obat</label>
                           <input class="form-control" type="text" name="dosis_obat_1" id="dosis_obat_1">
                        </div>
                        <div class="col-md-2">
                           <label for="rute_pemberian_1">Rute Pemberian</label>
                           <input class="form-control" type="text" name="rute_pemberian_1" id="rute_pemberian_1">
                        </div>
                        <div class="col-md-2">
                           <label for="waktu_pemberian_1">Waktu Pemberian</label>
                           <input class="form-control" type="text" name="waktu_pemberian_1" id="waktu_pemberian_1">
                        </div>
                        <div class="col-md-2">
                           <label for="nama_perawat_1">Nama Perawat</label>
                           <select class="js-select2 form-control" name="nama_perawat_1" id="nama_perawat_1" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">
                           {{-- <label for="nama_obat_2">Nama Obat</label> --}}
                           <select class="js-select2 form-control" name="nama_obat_2" id="nama_obat_2" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="dosis_obat_2">Dosis Obat</label> --}}
                           <input class="form-control" type="text" name="dosis_obat_2" id="dosis_obat_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="rute_pemberian_2">Rute Pemberian</label> --}}
                           <input class="form-control" type="text" name="rute_pemberian_2" id="rute_pemberian_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="waktu_pemberian_2">Waktu Pemberian</label> --}}
                           <input class="form-control" type="text" name="waktu_pemberian_2" id="waktu_pemberian_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_2">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_2" id="nama_perawat_2" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">
                           {{-- <label for="nama_obat_3">Nama Obat</label> --}}
                           <select class="js-select2 form-control" name="nama_obat_3" id="nama_obat_3" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="dosis_obat_3">Dosis Obat</label> --}}
                           <input class="form-control" type="text" name="dosis_obat_3" id="dosis_obat_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="rute_pemberian_3">Rute Pemberian</label> --}}
                           <input class="form-control" type="text" name="rute_pemberian_3" id="rute_pemberian_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="waktu_pemberian_3">Waktu Pemberian</label> --}}
                           <input class="form-control" type="text" name="waktu_pemberian_3" id="waktu_pemberian_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_3">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_3" id="nama_perawat_3" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- end obat-obat yang diberikan -->


                  <!-- Observasi Transfusi -->
                  <div class="col-md-12 mt-3">
                     <h5>Observasi Transfusi</h5>
                     <div class="form-group row">
                        <div class="col-md-12">
                           <label>Observasi</label>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-1">
                           <label for="tgl_1">Tanggal</label>
                           <input class="form-control" type="date" name="tgl_1" id="tgl_1">
                        </div>
                        <div class="col-md-1">
                           <label for="jam_1">Jam</label>
                           <input class="form-control time" type="text" name="jam_1" id="jam_1">
                        </div>
                        <div class="col-md-1">
                           <label for="reaksi_1">Reaksi Transfusi</label>
                           <input class="form-control" type="text" name="reaksi_1" id="reaksi_1">
                        </div>
                        <div class="col-md-2">
                           <label for="keluhan_1">Keluhan/GCS</label>
                           <input class="form-control" type="text" name="keluhan_1" id="keluhan_1">
                        </div>
                        <div class="col-md-1">
                           <label for="td_1">TD</label>
                           <input class="form-control" type="text" name="td_1" id="td_1">
                        </div>
                        <div class="col-md-1">
                           <label for="n_1">N</label>
                           <input class="form-control" type="text" name="n_1" id="n_1">
                        </div>
                        <div class="col-md-1">
                           <label for="rr_1">RR</label>
                           <input class="form-control" type="text" name="rr_1" id="rr_1">
                        </div>
                        <div class="col-md-1">
                           <label for="s_1">S</label>
                           <input class="form-control" type="text" name="s_1" id="s_1">
                        </div>
                        <div class="col-md-1">
                           <label for="lainnya_1">Lainnya</label>
                           <input class="form-control" type="text" name="lainnya_1" id="lainnya_1">
                        </div>
                        <div class="col-md-2">
                           <label for="nama_perawat_transfusi_1">Nama Perawat</label>
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_1" id="nama_perawat_transfusi_1" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_2">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_2" id="tgl_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_2">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_2" id="jam_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_2">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_2" id="reaksi_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_2">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_2" id="keluhan_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_2">TD</label> --}}
                           <input class="form-control" type="text" name="td_2" id="td_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_2">N</label> --}}
                           <input class="form-control" type="text" name="n_2" id="n_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_2">RR</label> --}}
                           <input class="form-control" type="text" name="rr_2" id="rr_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_2">S</label> --}}
                           <input class="form-control" type="text" name="s_2" id="s_2">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_2">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_2" id="lainnya_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_2">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_2" id="nama_perawat_transfusi_2" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_3">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_3" id="tgl_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_3">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_3" id="jam_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_3">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_3" id="reaksi_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_3">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_3" id="keluhan_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_3">TD</label> --}}
                           <input class="form-control" type="text" name="td_3" id="td_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_3">N</label> --}}
                           <input class="form-control" type="text" name="n_3" id="n_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_3">RR</label> --}}
                           <input class="form-control" type="text" name="rr_3" id="rr_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_3">S</label> --}}
                           <input class="form-control" type="text" name="s_3" id="s_3">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_3">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_3" id="lainnya_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_3">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_3" id="nama_perawat_transfusi_3" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_4">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_4" id="tgl_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_4">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_4" id="jam_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_4">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_4" id="reaksi_4">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_4">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_4" id="keluhan_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_4">TD</label> --}}
                           <input class="form-control" type="text" name="td_4" id="td_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_4">N</label> --}}
                           <input class="form-control" type="text" name="n_4" id="n_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_4">RR</label> --}}
                           <input class="form-control" type="text" name="rr_4" id="rr_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_4">S</label> --}}
                           <input class="form-control" type="text" name="s_4" id="s_4">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_4">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_4" id="lainnya_4">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_4">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_4" id="nama_perawat_transfusi_4" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_5">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_5" id="tgl_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_5">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_5" id="jam_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_5">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_5" id="reaksi_5">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_5">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_5" id="keluhan_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_5">TD</label> --}}
                           <input class="form-control" type="text" name="td_5" id="td_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_5">N</label> --}}
                           <input class="form-control" type="text" name="n_5" id="n_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_5">RR</label> --}}
                           <input class="form-control" type="text" name="rr_5" id="rr_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_5">S</label> --}}
                           <input class="form-control" type="text" name="s_5" id="s_5">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_5">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_5" id="lainnya_5">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_5">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_5" id="nama_perawat_transfusi_5" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_6">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_6" id="tgl_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_6">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_6" id="jam_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_6">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_6" id="reaksi_6">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_6">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_6" id="keluhan_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_6">TD</label> --}}
                           <input class="form-control" type="text" name="td_6" id="td_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_6">N</label> --}}
                           <input class="form-control" type="text" name="n_6" id="n_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_6">RR</label> --}}
                           <input class="form-control" type="text" name="rr_6" id="rr_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_6">S</label> --}}
                           <input class="form-control" type="text" name="s_6" id="s_6">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_6">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_6" id="lainnya_6">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_6">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_6" id="nama_perawat_transfusi_6" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_7">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_7" id="tgl_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_7">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_7" id="jam_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_7">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_7" id="reaksi_7">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_7">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_7" id="keluhan_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_7">TD</label> --}}
                           <input class="form-control" type="text" name="td_7" id="td_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_7">N</label> --}}
                           <input class="form-control" type="text" name="n_7" id="n_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_7">RR</label> --}}
                           <input class="form-control" type="text" name="rr_7" id="rr_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_7">S</label> --}}
                           <input class="form-control" type="text" name="s_7" id="s_7">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_7">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_7" id="lainnya_7">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_7">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_7" id="nama_perawat_transfusi_7" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-1">
                           {{-- <label for="tgl_8">Tanggal</label> --}}
                           <input class="form-control" type="date" name="tgl_8" id="tgl_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="jam_8">Jam</label> --}}
                           <input class="form-control time" type="text" name="jam_8" id="jam_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="reaksi_8">Reaksi Transfusi</label> --}}
                           <input class="form-control" type="text" name="reaksi_8" id="reaksi_8">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="keluhan_8">Keluhan/GCS</label> --}}
                           <input class="form-control" type="text" name="keluhan_8" id="keluhan_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="td_8">TD</label> --}}
                           <input class="form-control" type="text" name="td_8" id="td_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="n_8">N</label> --}}
                           <input class="form-control" type="text" name="n_8" id="n_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="rr_8">RR</label> --}}
                           <input class="form-control" type="text" name="rr_8" id="rr_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="s_8">S</label> --}}
                           <input class="form-control" type="text" name="s_8" id="s_8">
                        </div>
                        <div class="col-md-1">
                           {{-- <label for="lainnya_8">Lainnya</label> --}}
                           <input class="form-control" type="text" name="lainnya_8" id="lainnya_8">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_8">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_8" id="nama_perawat_transfusi_8" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                  </div>
                  <!-- end Observasi Transfusi -->


                  <!-- Obat-obatan yang diberikan setelah transfusi -->
                  <div class="col-md-12 mt-3">
                     <h5>Obat-obatan yang diberikan sebelum atau selama transfusi</h5>
                     <div class="form-group row">
                        <div class="col-md-4">
                           <label for="nama_obat_transfusi_1">Nama Obat</label>
                           <select class="js-select2 form-control" name="nama_obat_transfusi_1" id="nama_obat_transfusi_1" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           <label for="dosis_obat_transfusi_1">Dosis Obat</label>
                           <input class="form-control" type="text" name="dosis_obat_transfusi_1" id="dosis_obat_transfusi_1">
                        </div>
                        <div class="col-md-2">
                           <label for="rute_pemberian_transfusi_1">Rute Pemberian</label>
                           <input class="form-control" type="text" name="rute_pemberian_transfusi_1" id="rute_pemberian_transfusi_1">
                        </div>
                        <div class="col-md-2">
                           <label for="waktu_pemberian_transfusi_1">Waktu Pemberian</label>
                           <input class="form-control" type="text" name="waktu_pemberian_transfusi_1" id="waktu_pemberian_transfusi_1">
                        </div>
                        <div class="col-md-2">
                           <label for="nama_perawat_transfusi_1">Nama Perawat</label>
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_1" id="nama_perawat_transfusi_1" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">
                           {{-- <label for="nama_obat_transfusi_2">Nama Obat</label> --}}
                           <select class="js-select2 form-control" name="nama_obat_transfusi_2" id="nama_obat_transfusi_2" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="dosis_obat_transfusi_2">Dosis Obat</label> --}}
                           <input class="form-control" type="text" name="dosis_obat_transfusi_2" id="dosis_obat_transfusi_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="rute_pemberian_transfusi_2">Rute Pemberian</label> --}}
                           <input class="form-control" type="text" name="rute_pemberian_transfusi_2" id="rute_pemberian_transfusi_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="waktu_pemberian_transfusi_2">Waktu Pemberian</label> --}}
                           <input class="form-control" type="text" name="waktu_pemberian_transfusi_2" id="waktu_pemberian_transfusi_2">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_2">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_2" id="nama_perawat_transfusi_2" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">
                           {{-- <label for="nama_obat_transfusi_3">Nama Obat</label> --}}
                           <select class="js-select2 form-control" name="nama_obat_transfusi_3" id="nama_obat_transfusi_3" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($item_template as $item)
                                 <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="dosis_obat_transfusi_3">Dosis Obat</label> --}}
                           <input class="form-control" type="text" name="dosis_obat_transfusi_3" id="dosis_obat_transfusi_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="rute_pemberian_transfusi_3">Rute Pemberian</label> --}}
                           <input class="form-control" type="text" name="rute_pemberian_transfusi_3" id="rute_pemberian_transfusi_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="waktu_pemberian_transfusi_3">Waktu Pemberian</label> --}}
                           <input class="form-control" type="text" name="waktu_pemberian_transfusi_3" id="waktu_pemberian_transfusi_3">
                        </div>
                        <div class="col-md-2">
                           {{-- <label for="nama_perawat_transfusi_3">Nama Perawat</label> --}}
                           <select class="js-select2 form-control" name="nama_perawat_transfusi_3" id="nama_perawat_transfusi_3" style="width: 100%">
                              <option value="" selected disabled></option>
                              @foreach ($perawat as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- end Obat-obatan yang diberikan setelah transfusi -->

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