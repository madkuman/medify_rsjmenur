<div class="block border">
    <div class="block-header">
        <h5 class="block-title">Keluar Kasus</h5>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>
    <div class="block-content pb-10">
        Anda akan keluar dari kasus. Anda dapat masuk kembali ke dalam kasus jika diundang oleh salah satu kolaborator didalamnya.
        @if(session('my_role_'.$kasus->nomor_kasus))
        @if(session('my_role_'.$kasus->nomor_kasus)->admin != 1)

        <div class="row">

            <div class="col-12">
                <form action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keluar-kasus" method="POST" id="keluarKasusForm">
                    {{csrf_field()}}
                    <button type="button" onclick="confirmKeluarKasus()" id="keluarKasusButton" class="btn-alt btn-hero btn-primary min-width-100 float-right">
                        <i class="fa fa-send mr-5"></i> Keluar Kasus
                    </button>
                </form>
            </div>
        </div>
        @else
        <br>
        <span class="text-danger"> Saat ini Anda merupakan DPJP, jadikan kolaborator lain sebagai DPJP agar anda bisa keluar kasus.</span>
        @endif
        @endif
    </div>
</div>