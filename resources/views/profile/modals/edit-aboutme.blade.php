<div class="modal fade" id="edit-about-me" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-5 mb-0">
                        Tentang Saya
                    </h4>
                    <div class="col-md-7 mb-0">
                        <a class="link-effect float-right font-size-s" href="{{url('settings/account')}}">
                            <span class="fa fa-wrench"></span> Pengaturan Akun
                        </a>
                    </div>
                    <form method="POST" id="aboutme-form" class="col-md-12" action="{{route('edit.aboutme')}}">
                        {{csrf_field()}}
                        <h6 class="font-size-s font-w400 mt-5">Masukkan info mengenai diri anda</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <textarea rows="4" class="form-control mb-5" name="aboutme" form="aboutme-form">{{$user->about_me}}</textarea>
                        <button type="submit" id="submitgroup" class="btn btn-xs btn-primary float-right">
                            Simpan
                        </button>
                        <button type="button" id="submitgroup" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>