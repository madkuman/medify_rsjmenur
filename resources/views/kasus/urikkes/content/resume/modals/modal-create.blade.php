<div class="modal fade" id="modal-create-resume" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Bacaan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/resume/create" method="post" id="form_create">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="kasus_id" placeholder="" value="{{$kasus->nomor_kasus}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="block-content">                                
                                <label class="col-12" for="">Status Kesehatan</label>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td class="text-center">U</td>
                                                <td class="text-center">A</td>
                                                <td class="text-center">B</td>
                                                <td class="text-center">D</td>
                                                <td class="text-center">L</td>
                                                <td class="text-center">G</td>
                                                <td class="text-center">J</td>
                                                <td class="text-center">Stakes</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="u">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="a">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="b">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="d">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="l">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="g">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="j">
                                                </td>
                                                <td>
                                                    <select class="form-control stakes-select" name="stakes">
                                                        <option selected=""></option>
                                                        <option value="I">I</option>
                                                        <option value="II">II</option>
                                                        <option value="IIP">IIP</option>
                                                        <option value="IIIP">IIIP</option>
                                                        <option value="III">III</option>
                                                        <option value="IV">IV</option>
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
                                    <textarea type="text" rows="2" name="jiwa" class="form-control form-control-lg"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Resume</label>
                                <div class="col-12">
                                    <textarea type="text" rows="4" name="resume" class="form-control form-control-lg">
@if(isset($gigi->last()->dmf))


G:DMF : {{$gigi->last()->dmf}}
@endif</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Saran</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="saran" class="form-control form-control-lg"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Kualifikasi</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="kualifikasi" class="form-control form-control-lg"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="">Catatan Hasil Lab</label>
                                <div class="col-12">
                                    <textarea type="text" rows="2" name="catatan_lab" style="resize: none;" class="form-control form-control-lg"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                        <i class="fa fa-send mr-5"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
