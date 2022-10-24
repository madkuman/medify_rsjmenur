@foreach ($resume as $key => $value)
<div class="modal fade" id="modal-edit-resume{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
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
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/resume/edit" method="post" id="form_create">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="id" placeholder="" value="{{$value->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="block-content">
                                <label class="col-12" for="">Status Kesehatan</label>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>U</td>
                                                <td>A</td>
                                                <td>B</td>
                                                <td>D</td>
                                                <td>L</td>
                                                <td>G</td>
                                                <td>J</td>
                                                <td>Stakes</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="u" value="{{$value->u}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="a" value="{{$value->a}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="b" value="{{$value->b}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="d" value="{{$value->d}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="l" value="{{$value->l}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="g" value="{{$value->g}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="j" value="{{$value->j}}">
                                                </td>
                                                <td>
                                                    <select class="form-control stakes-select" name="stakes">
                                                        <option selected=""></option>
                                                        <option value="I" {{$value->stakes == 'I' ? 'selected' : ''}}>I</option>
                                                        <option value="II" {{$value->stakes == 'II' ? 'selected' : ''}}>II</option>
                                                        <option value="IIIP" {{($value->stakes == 'IIIP') ? 'selected' : ''}}>IIIP</option>
                                                        <option value="IIP" {{$value->stakes == 'IIP' ? 'selected' : ''}}>IIP</option>
                                                        <option value="III" {{$value->stakes == 'III' ? 'selected' : ''}}>III</option>
                                                        <option value="IV" {{$value->stakes == 'IV' ? 'selected' : ''}}>IV</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <label class="col-12" for="">Pemeriksaan Jiwa / MMPI</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="jiwa" class="form-control form-control-lg">{{$value->jiwa}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Resume</label>
                                <div class="col-12">
                                    <textarea type="text" rows="4" name="resume" class="form-control form-control-lg">{{$value->resume}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Saran</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="saran" class="form-control form-control-lg">{{$value->saran}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Kualifikasi</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="kualifikasi" class="form-control form-control-lg">{{$value->kualifikasi}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Catatan Hasil Lab</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="catatan_lab" class="form-control form-control-lg" style="resize: none;">{{$value->catatan_lab}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
