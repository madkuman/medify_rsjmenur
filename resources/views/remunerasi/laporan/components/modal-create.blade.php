<div class="modal"  id="modal-create-laporan"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header ">
                    <h3 class="block-title">Buat Laporan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form id="form-cetak" method="post" action="{{url()->current()}}/create"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="block-content" id="content-dana">
                        <div class="col-md-12">
                            <label for="bulan_tahun"><h6>Pilih Waktu</h6></label>
                            <div class="form-inline">
                                <input type="text" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate date-modal" value="{{date('d-m-Y')}}">
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-info btn-simple btn-click-animate btn-submit-print" type="submit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>