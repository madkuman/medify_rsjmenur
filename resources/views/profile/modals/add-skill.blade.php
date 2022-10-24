<div class="modal fade" id="add-skill" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-5 mb-0">
                        Skill
                    </h4>
                    <form method="POST" id="skill-form" class="col-md-12" action="{{route('create.skill')}}">
                        {{csrf_field()}}
                        <h6 class="font-size-s font-w400 mt-5 mb-0">Masukkan beberapa skill yang anda miliki</h6>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="form-text text-muted">Tekan TAB setiap anda memasukkan satu skill</div>
                        <input type="text" name="skill" id="tags" class="form-control">
                        <button type="submit" id="submitgroup" class="btn btn-xs btn-primary float-right mt-5">
                            Simpan
                        </button>
                        <button type="button" id="submitgroup" class="btn btn-xs btn-default float-right mr-5 mt-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>