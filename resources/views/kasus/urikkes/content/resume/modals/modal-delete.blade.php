@foreach ($resume as $key => $value)
  <div class="modal fade" id="modal-delete-resume{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
      <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="block rounded block-transparent mb-0">
                  <div class="block-header">
                      <h3 class="block-title">Edit Evaluasi {{$key+1}}</h3>
                      <div class="block-options">
                          <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                              <i class="si si-close"></i>
                          </button>
                      </div>
                  </div>
                  <div class="block-content">
                      <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/resume/delete" method="post" id="form_create">
                          {{ csrf_field() }}
                          <div class="">
                              <div class="">
                                  <input type="hidden" class="form-control form-control-lg" id="" name="id" placeholder="" value="{{$value->id}}">
                              </div>
                          </div>
                          <button type="submit" class="btn-alt btn-hero btn-danger min-width-175 float-center">
                              <i class="fa fa-send mr-5"></i> Delete Evaluasi {{$key+1}}
                          </button>
                          <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-175 float-center">Batal
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endforeach
