<div class="modal fade" id="modalUndanganGrup" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-header">
                    <h5 class="block-title text-uppercase">Undangan Grup</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-body-light py-20">
                        <ul class="nav-users pull-all nav-users-big pt-0">
                            <li>
                                <a id="link" class="link-effect pl-20" href="">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="img-avatar-sm" src="{{asset('assets/img/poli/001-brain.png')}}" alt="">
                                        </div>
                                        <div class="col-md-10 pl-0">
                                            <h5 class="mb-0 text-uppercase"><span id="nama"></span></h5>
                                            <br>
                                            <span class="font-w400 text-muted">Diundang oleh : </span><span class="font-w500 text-muted" id="creator-name">Balanar</span>
                                            <br>
                                            <span id="creator-date" class="text-muted"> 2 jam yang lalu </span>
                                        </div>                                        
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-lg-7" style="visibility: hidden;">
                                <span class="font-w400 text-muted">Diundang oleh : </span><span class="font-w500" id="creator-name">Balanar</span>
                                <br>
                                <span id="creator-date"> 2 jam yang lalu </span>
                            </div>
                            <div class="col-lg-5 pl-50">

                                <form method="POST" id="undanganGrupForm">
                                    {{csrf_field()}}
                                    <button id="buttonTolakUndanganGrup" class="btn btn-outline-danger" type="button">Tolak </button>
                                    <button id="buttonTerimaUndanganGrup" class="btn btn-primary" type="button">Terima </button>
                                    <input type="hidden" name="id" value="" id="inputIDUndangan">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>