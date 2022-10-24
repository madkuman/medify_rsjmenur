@extends('layouts.main2')

@section('title')
Baru - Rencana Asuhan Keperawatan
@endsection

@section('content')

@include('layouts.components2.navbar')
<!-- Main Container -->
<main id="main-container">
    <div class="content pb-100">
        @include('keperawatan.components.navbar')
        <h4>Buat Rencana Asuhan Keperawatan Baru</h4>
        <form action="{{url()->current()}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="created_by" value="{{Auth::user()->name}}">
            <div class="block">
                <div class="block-content">
                    @include('keperawatan.create-components.basic')
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    @include('keperawatan.create-components.diagnosa')
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    @include('keperawatan.create-components.tujuan')
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    @include('keperawatan.create-components.intervensi')
                </div>
            </div>
            <button class="btn btn-primary btn-hero pull-right">Simpan</button>
        </form>
    </div>
</main>

@endsection

@section('js')
<script type="text/javascript">  
    $(document).on('keyup', '.opsi', function() {
        var element = $(this).parent().parent().parent();
        var container = $(this).parent().parent().parent().parent();
        var name = $(this).attr("name");
        var kelas = $(this).attr("class");
        console.log('change')
        if(element.is(':last-child') == true)
        {
            content     =   '<div class="row justify-content-center item-wrapper">'
            content     +=      '<div class="col-md-10">'
            content     +=          '<div class="form-group">'
            content     +=              '<input type="text" class="'+kelas+'" name="'+name+'" placeholder="Deskripsikan Opsi Pilihan">'
            content     +=           '</div>'
            content     +=       '</div>'
            content     +=       '<div class="col-md-2">'
            content     +=            '<div class="form-group">'
            content     +=                   ' <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">'
            content     +=                       '<i class="fa fa-trash"></i>'
            content     +=                    '</button>'
            content     +=             '</div>'
            content     +=          '</div>'
            content     +=      '</div>'

            container.append(content);
        }
    });


    $(document).on('click', '.btnRemove', function() {
        var element = $(this).parent().parent().parent();
        if(element.is(':last-child') == true)
        {
            var input = element.find("input.form-control")
            input.val("");
        }
        else
        {
            element.remove();
        }

    });

    $('#durasi_tujuan').change(function()
    {
        var value = $(this).is(":checked")
        if(value) $('#sub_tujuan_container').show();
        else $('#sub_tujuan_container').hide();
    });
</script>


@endsection
