<div class="row py-20 px-5 text-center">
    <button type="button" class="btn btn-sm btn-circle btn-alt-secondary position-absolute open-toggle d-none" style="top:20px;left:20px">
        <i class="fa fa-chevron-right"></i>
    </button>
    <div class="col-12">
        <h2 class="font-w700 my-10 text-light">Layar Transaksi Farmasi</h2>
        <h5 class="font-w400 mb-5 text-light">{{session('farmasi')->nama}} - {{$screen->nama}}</h5>
    </div>
    <div class="col-6 col-task">
        {{-- <h5 class="font-w400 mb-5 text-light"><span class="screen-type badge">Jenis Screen : Dikerjakan</span></h5> --}}
        <div class="block block-rounded block-bordered block-transparent">
            <div class="block-content bg-gray-lighter mt-20 pt-10">
                <table class="table table-bordered table-striped table-vcenter" style="width:100%" id="task_table">
                    <thead>
                        <tr>
                            <th width="30%" class="text-center">No Antrian</th>
                            <th width="20%" class="text-center">No RM</th>
                            <th width="25%" class="text-center">Estimasi Selesai</th>
                            <th width="25%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @for ($i = 0; $i < 15; $i++)
                            <tr>
                                <td>{{$i}}</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                            </tr>
                        @endfor --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-6 col-rm py-20">
        <div class="animated fadeIn">
            <div class="block block-rounded block-bordered block-transparent">
                <div class="block block-themed text-center no-border">
                    <div class="block-content block-content-full block-content-sm bg-primary">
                        <div class="text-white mb-5 font-30" style="font-weight: 600">Antrian Sekarang</div>
                    </div>
                    <div class="block-content text-center">
                        <div class="form-group">
                            <label style="font-weight: 500; font-size: 20pt"><b>No Antrian</b></label><br>
                            <h3 id="no-antrian" class="no_antrian_box">-</h3>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 500; font-size: 20pt"><b>Loket</b></label><br>
                            <h3 id="loket" class="loket_box">-</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="player"></audio>
</div>