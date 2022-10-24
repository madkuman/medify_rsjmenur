<div class="modal-lg modal fade" id="modalUndangan" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true" style="margin: auto;">
    <div class="modal-dialog modal-dialog-popout modal-lg" role="document">
        <div class="modal-content" style="padding: 4%">
            <div class="block block-transparent mb-0">
                <div class="block-header">
                    <h5 class="block-title text-uppercase">Undangan Kasus #<span id="id-undangan" </h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-body-light py-20">
                        <div class="row">
                            <div class="col-lg-2">
                                <img class="img-avatar"  id="img" src="{{asset('assets/img/avatars/avatar0.jpg')}}" alt="" ">
                            </div>
                            <div class="col-lg-10 pt-5">



                                <h5 class="mb-0" id="judulkasus">Trastian</h5>
                                <div class="font-w400 text-muted" id="nama">Trastian</div>
                                <div class="font-w400 text-muted"><span id="gender">Laki laki</span>, <span id="usia">24</span> Tahun</div>
                                <div class="font-w400 text-muted"><span id="layanan">Rawat Jalan</span> - <span id="lokasi">Rawat Jalan</span></div>
                            </div>                                        
                        </div>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-lg-7">
                                <span class="font-w400 text-muted">Diundang oleh : </span><span class="font-w500" id="creator-name">Balanar</span> | <span id="creator-date"> 2 jam yang lalu </span>
                                <br>
                                <span class="font-w400 text-muted">Pesan: </span><span class="badge badge-danger" id="message" style="white-space: normal; text-align: left; line-height: 1.6;"></span>
                                <br>  
                            </div>
                            <div class="col-lg-5">

                                <form method="POST" id="undanganForm">
                                    {{csrf_field()}}
                                    <button id="buttonTolakUndangan" class="btn btn-hero btn-outline-danger pull-right" type="button" style="margin-left: 2%">Tolak </button>
                                    <button id="buttonTerimaUndangan" class="btn btn-hero btn-primary pull-right" type="button" style="margin-left: 2%">Terima </button>
                                    <input type="hidden" name="id" value="" id="inputIDUndangan">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>