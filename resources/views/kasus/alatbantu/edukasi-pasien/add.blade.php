<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-left: 17px">
	<div class="modal-dialog" style="min-width: 100%">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form Edukasi Pasien</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<div class="block rounded p-0">
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary full-only" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#admisi" id="nav-admisi">Admisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#keperawatan" id="nav-keperawatan">Keperawatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#manage-nyeri" id="nav-manage-nyeri">Manajemen Nyeri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#dpjp" id="nav-dpjp">Dokter Spesialis/DPJP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#diet" id="nav-diet">Diet dan Nutrisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#psikologi" id="nav-psikologi">Psikologi/Rehabmed</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#farmasi" id="nav-farmasi">Farmasi</a>
                                </li>
                            </ul>

                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary mobile-flex row mx-0" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#admisi" id="nav-admisi">Admisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#keperawatan" id="nav-keperawatan">Keperawatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#manage-nyeri" id="nav-manage-nyeri">Manajemen Nyeri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#dpjp" id="nav-dpjp">Dokter Spesialis/DPJP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#diet" id="nav-diet">Diet dan Nutrisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#psikologi" id="nav-psikologi">Psikologi/Rehabmed</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#farmasi" id="nav-farmasi">Farmasi</a>
                                </li>
                            </ul>
                            
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left row" id="admisi" role="tabpanel">
                                	@include('kasus.alatbantu.edukasi-pasien.form.admisi')
                                </div>
                                <div class="tab-pane fade fade-left row" id="keperawatan" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.keperawatan')
                                </div>
                                <div class="tab-pane fade fade-left row" id="manage-nyeri" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.manage-nyeri')
                                </div>
                                <div class="tab-pane fade fade-left row" id="dpjp" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.dpjp')
                                </div>
                                <div class="tab-pane fade fade-left row" id="diet" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.diet')
                                </div>
                                <div class="tab-pane fade fade-left row" id="psikologi" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.psikologi')
                                </div>
                                <div class="tab-pane fade fade-left row" id="farmasi" role="tabpanel">
                                    @include('kasus.alatbantu.edukasi-pasien.form.farmasi')
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>