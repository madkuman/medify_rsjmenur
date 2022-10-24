@extends('laundry.layouts.main2')

@section('title')
Laundry - Medify
@endsection

@section('content')

<div class="container">
    <div class="row row-deck">
        <div class="col-sm-12">
            <div class="block rounded main-content">
                <div class="block-header row pb-0 mb-0 mt-0">
                    <div class="col"><h3 class="mb-0">Penyerahan Barang Cuci</h3></div>
                    <div class="w-100"></div>
                    <div class="col"><h6 class="mt-2">Daftarkan barang yang anda serahkan</h5></div>
                </div>
                <div class="col-6 mb-0 mt-2 ml-2">
                    <label for="selectGrup">Grup</label>
                </div>
                <div class="block-header py-0">
                    <select class="form-control js-select2 col-4" data-size="5" id="selectGrup">
                        @for ($i=0; $i < $permintaan['grup']->jumlah; $i++)
                            <option value="{{$permintaan['grup'][$i]->id}}">{{$permintaan['grup'][$i]->name}}</option>
                        @endfor
                    </select>
                </div>
                <hr>
                <div class="block-content pt-0" style="padding-right:50px;">
                    <div class="table-full-width">
                        <div class="block-content">
                            <table class="table table-vcenter table-stripped">
                                <thead>
                                    <tr class="header">
                                      <th width="5%">#</th>
                                      <th width="15%">NAMA BARANG</th>
                                      <th width="18%">JUMLAH DISERAHKAN</th>
                                      <th width="22%">KET</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="addPermintaan">
                                        @foreach ($permintaan['barang'] as $pa)
                                        <tr>
                                            <td>{{$pa->nomor}}</td>
                                            <td>{{$pa->nama}}</td>
                                            <td><input class="form-control" type="number" id="barang{{$loop->index}}" placeholder="Jumlah" min="0" step="1" oninput="validity.valid||(value='');"/><input class="form-control" type="hidden" id="tipebarang{{$loop->index}}" value="{{$pa->id}}"/></td>
                                            <td><input class="form-control" type="text" id="ket{{$loop->index}}" placeholder="Keterangan" min="0" step="1" oninput="validity.valid||(value='');"/></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="block-content">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-secondary" style="padding:0px 40px;" type="button" id="buttonCancel">Batal</button>
                                        <button class="btn btn-primary ml-2" style="padding:0px 40px;" type="button" id="buttonSubmit">Simpan</button>
                                        <button class="btn btn-alt-primary ml-2" style="display: none; padding:0px 40px;" type="button"  id="buttonLoading">
                                        <i class="fa fa-asterisk fa-spin"></i> Memuat
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

        $('#buttonCancel').click(console.log($("#selectGrup").val()));
        $('#buttonSubmit').off('click').on('click',function() {

            $('#buttonSubmit').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            barang = [];
            ket = [];

            var group = $("#selectGrup").val();
            var jumlah = {{$permintaan['barang']->jumlah}};
            for (var i = 0; i < jumlah; i++) {
                barang[i] = [];
                barang[i][0] = $("#tipebarang"+i).val();
                barang[i][1] = $("#barang"+i).val();
                ket[i] = $("#ket"+i).val();
            }

            var formData = new FormData();
            for (var i = 0; i < jumlah; i++) {
                var gg = barang[i][1];
                if(gg)
                {
                    formData.append('barang'+'['+i+'][0]', barang[i][0]);
                    formData.append('barang'+'['+i+'][1]', gg);
                    formData.append('ket'+'['+i+']', ket[i]);
                }
            }
            formData.append('grup', group);
            formData.append('jumlah', jumlah);

            for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/add",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });
</script>
@endsection
