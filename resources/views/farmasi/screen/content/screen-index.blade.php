<div class="row py-20 px-5 text-center" style="background-color:#2F4F4F;">
    <button type="button" class="btn btn-sm btn-circle btn-alt-secondary position-absolute open-toggle d-none" style="top:20px;left:20px">
        <i class="fa fa-chevron-right"></i>
    </button>
    <div class="col-12">
        <h2 class="font-w700 my-10 text-white" >Layar Transaksi Farmasi</h2>
        <h5 class="font-w400 mb-5" style="color:gray;">{{session('farmasi')->nama}} - {{$screen->nama}}</h5>
    </div>
    <div class="col-12">
        <div class="row" style="background-color:#4682B4">
            <div class="col-md-6">
                <h1 class="text-white"> BPJS</h1>
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="block block-themed text-center no-border">
                        <div class="block-content block-content-full block-content-sm bg-primary">
                            <div class="text-white mb-5 font-30" style="font-weight: 600">Antrian Sekarang - NON RACIKAN</div>
                        </div>
                        <div class="block-content text-center">
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>No Antrian</b></label><br>
                                <h3 id="no-antrian-bpjs-non" class="no_antrian_box">-</h3>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>Loket</b></label><br>
                                <h3 id="loket-bpjs-non" class="loket_box">-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="text-white">UMUM</h1>
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="block block-themed text-center no-border">
                        <div class="block-content block-content-full block-content-sm bg-primary">
                            <div class="text-white mb-5 font-30" style="font-weight: 600">Antrian Sekarang - NON RACIKAN</div>
                        </div>
                        <div class="block-content text-center">
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>No Antrian</b></label><br>
                                <h3 id="no-antrian-umum-non" class="no_antrian_box">-</h3>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>Loket</b></label><br>
                                <h3 id="loket-umum-non" class="loket_box">-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="block block-themed text-center no-border">
                        <div class="block-content block-content-full block-content-sm bg-primary">
                            <div class="text-white mb-5 font-30" style="font-weight: 600">Antrian Sekarang - RACIKAN</div>
                        </div>
                        <div class="block-content text-center">
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>No Antrian</b></label><br>
                                <h3 id="no-antrian-bpjs" class="no_antrian_box">-</h3>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>Loket</b></label><br>
                                <h3 id="loket-bpjs" class="loket_box">-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="block block-themed text-center no-border">
                        <div class="block-content block-content-full block-content-sm bg-primary">
                            <div class="text-white mb-5 font-30" style="font-weight: 600">Antrian Sekarang - RACIKAN</div>
                        </div>
                        <div class="block-content text-center">
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>No Antrian</b></label><br>
                                <h3 id="no-antrian-umum" class="no_antrian_box">-</h3>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: 500; font-size: 15pt"><b>Loket</b></label><br>
                                <h3 id="loket-umum" class="loket_box">-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="bg-gray-lighter">
                        <div class="bg-gray-lighter">
                        <table class="table table-bordered table-striped table-vcenter table-sm" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="30%" class="text-center">No Antrian</th>
                                    <th width="20%" class="text-center">No RM</th>
                                    <th width="25%" class="text-center">Estimasi Selesai</th>
                                    <th width="25%" class="text-center">Status</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                        <div class="bg-gray-lighter" style="max-height:127px;overflow:hidden;overflow-y:scroll;" id="block_bpjs">
                            <table class="table table-bordered table-striped table-vcenter table-sm" style="width:100%;" id="task_table_bpjs">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded block-bordered block-transparent">
                    <div class="bg-gray-lighter">
                    <div class="bg-gray-lighter">
                    <table class="table table-bordered table-striped table-vcenter table-sm" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="30%" class="text-center">No Antrian</th>
                                <th width="20%" class="text-center">No RM</th>
                                <th width="25%" class="text-center">Estimasi Selesai</th>
                                <th width="25%" class="text-center">Status</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                    <div class="bg-gray-lighter" style="max-height:127px;overflow:hidden;overflow-y:scroll;" id="block_umum">
                        <table class="table table-bordered table-striped table-vcenter table-sm" style="width:100%;" id="task_table_umum">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="player"></audio>
</div>