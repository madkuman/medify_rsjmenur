<div class="modal fade" id="delete-pendidikan{{$pend->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content" style="background-color: #fafafa">
                    <form class="js-validation-be-contact" action="{{route('delete.pendidikan')}}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="pend_id" value="{{$pend->id}}">
                        <h5 class="font-w400">
                            Apakah anda yakin akan menghapus informasi ini?
                        </h5>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-100 float-right">Batal
                                </button>
                                <button type="submit" class="btn-alt btn-hero btn-danger min-width-100 float-right">
                                    <i class="fa fa-check mr-5"></i> Hapus
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>