<div class="modal" id="hasil_baca_{{$id}}_modal" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hasil Baca</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        {{ Form::label('template_select', 'Pilih Template')}}
                        <select class="form-control js-select2 template-select" name="template_select" style="width: 100%;" data-quill="{{$id}}">
                            <option>Gunakan Template yang anda inginkan</option>
                            @foreach($template as $t)
                                <option value="{{$t->id}}">{{$t->tarif->deskripsi}} - {{$t->title}} - {{$t->creator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('konten', 'Konten')}}
                        <div class="hasil-baca-container" id="quill_editor_{{$id}}" style="height: 700px;">
                            {!! nl2br($content) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>