@extends('layouts.main2')
@section('title')
Buat Form - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Buat Form</h3>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Tipe Form</label>
                            <select class="js-select2 form-control select-type" name="type">
                                <option value="" disabled selected>Pilih</option>
                                <option value="parameter-number">Parameter Angka</option>
                                <option value="parameter-number-greatherthan">Parameter Angka Lebih Dari</option>
                                <option value="parameter-number-lessthan">Parameter Angka Kurang Dari</option>
                                <option value="parameter-text">Parameter Teks</option>
                                <option value="paragraph">Paragraf</option>
                                <option value="text">Teks Pendek</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row parameter-container" style="display: none">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Parameter</label>
                            <input class="form-control" type="text" name="parameter" >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group parameter-item">
                            <label>Kode <small>(Tidak diwajibkan untuk diisi)</small></label>
                            <input class="form-control" type="text" name="slug">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group parameter-item">
                            <label>Satuan</label>
                            <input class="form-control" type="text" name="satuan" >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group parameter-item">
                            <label>Metode</label>
                            <input class="form-control" type="text" name="metode" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-3">
                            <button class="btn btn-primary btn-submit" disabled>Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('labpk.components.footer')

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.select-type').change(function(){
            value = $(this).val();
            
            $('.parameter-container').show();
            $('.btn-submit').prop("disabled", false);
            if(value == 'parameter-text' || value == 'parameter-number' || value =='parameter-number-greatherthan' || value =='parameter-number-lessthan' )
            {
                $('.parameter-item').show();
            }
            else
            {
                $('.parameter-item').hide();
            }
        })
    })
</script>
@endsection