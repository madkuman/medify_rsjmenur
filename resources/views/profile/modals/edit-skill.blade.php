<div class="modal fade" id="edit-skill{{$skill->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Edit Skill
                    </h4>
                    <form method="POST" class="col-md-12" action="{{route('edit.skill')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="skill_id" value="{{$skill->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Ubah atau hapus informasi skill yang telah ada</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="text-center my-15">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="edit-skill" name="skill" value="{{$skill->skill}}" required>
                                        <label for="edit-skill">Skill</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-skill{{$skill->id}}"  data-dismiss="modal">
                            <i class="fa fa-trash"></i> Hapus Entry
                        </button>
                        <button type="submit" name="submit" class="btn btn-xs btn-primary float-right">
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