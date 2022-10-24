@extends('layouts.main2')

@section('title')
Pemesanan - Kamar Operasi - Medify
@endsection

@section('content')
<div class="content pt-100 px-100">
    <div class="mt-50 mb-30 text-center">
        <h2 class="font-w700 text-black mb-10">Penjadwalan Operasi</h2>
        <h3 class="h5 text-muted mb-0">Pilih dokter</h3>
    </div>


  <div class="block">
    <div class="block-header block-header-default">
      <h3 class="block-title">Informasi Pasien</h3>
    </div>
    <div class="block-content">
      <div class="row m-0 mb-10">
        <div class="col-1 px-0">
          <img class="img-avatar" src="{{asset('assets/img/faces/avatar.jpg')}}" alt="">
        </div>
        <div class="col-4">
          {{$transaksi->pasien_detail->name}}
          <div class="font-w400 font-size-xs text-muted">{{$transaksi->pasien_detail->gender == 1 ? 'Laki laki' : 'Perempuan'}}, {{$transaksi->pasien_detail->age}} Tahun</div>
          <div class="font-w400 font-size-xs text-muted">
            @if($transaksi->kasus_id!=0) Kasus :
            <a href="{{url('kasus')}}/{{$transaksi->kasus->nomor_kasus}}"> {{$transaksi->kasus->judul_kasus}}
            </a>
            @else
            -
            @endif
          </div>
          <div class="font-w400 font-size-xs text-muted">
            Tanggal permintaan :
            @if ($transaksi->status == 2)
              {{ $permintaan->created_at->format('d F y, H:i') }}
            @else
              {{date('d F y, H:i', strtotime($transaksi->created_at))}}
            @endif
          </div>
        </div>
        <div class="col-3">
          <p class="text-black font-w400">
            <label>KETERANGAN</label><br>
            @if ($transaksi->status == 2)
            Penjadwalan Ulang (oleh {{ $permintaan->dokter->name }}) <br>
            Ket: {{ $permintaan->keterangan }}
            @else
              @if($transaksi->kasus_id==0)
              Pendaftaran dari kamar operasi
              @else
              Permintaan dari kasus
              @endif
            @endif
          </p>

        </div>
        <div class="col-4">
          <p class="text-black font-w400">
            <label>JADWAL OPERASI</label><br>
            {{$jadwal}}<br>
            <strong>Ruangan</strong> : {{$ruang->name}}<br>
            <strong>Ronde</strong> : {{$ronde}}
        </p>

        </div>
      </div>
    </div>
  </div>

    <div class="block main-content transaction-index"  ng-controller="PasienController">
        <div class="block-header bg-success">
            <h3 class="block-title text-white">Daftar Dokter</h3>
        </div>
        <div class="block-content">
            <div class="row mb-20">
                <div class="col-sm-12">
                    <form style="margin-top: 10px" id="pasienSearchForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Dokter" id="pasienSearch">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-full-width spinner-container" >
            <div class="spinner-back">
                <table class="table table-striped table-hover table-pointer ">
                    <tbody class="spinner-back-placeholder">
                        @for($i=0;$i<10;$i++)
                        <tr class="clickable-row">
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                        </tr>
                        @endfor
                    </tbody>
                    <tbody id="renderPasien"></tbody>



                </table>
            </div>

            <div class="spinner">
                <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
            </div>




            <div class="flex-center" style="">
                <ul id="pagination" class="pagination"></ul>
            </div>
        </div>
    </div>
</div>


  {{-- <form method="POST" action="{{url('')}}/kamaroperasi/pemesanan/{{$transaksi->id}}/konfirmasi" id="formSubmit"> --}}
  <form method="POST" action="{{url('/kamaroperasi/pemesanan/'.$transaksi->id.'/konfirmasi')}}" id="formSubmit">
    <input type="hidden" name="ruang" id="formRuang" value="{{$ruang->id}}">
    <input type="hidden" name="ronde" id="formRonde" value="{{$ronde}}">
    <input type="hidden" name="tanggal" id="formTanggal" value="{{$tanggal}}">
    <input type="hidden" name="dokter" id="formDokter">
    {{csrf_field()}}
  </form>


@endsection


@section('js')



<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    loadData();

    function loadPagination(currentPage = 1)
    {
        console.log(total_pages);

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page,keyword);
            }
        });
        firstLoadPagination = true;
    }
    function reloadPagination(currentPage)
    {
        var defaultOpts = {
            totalPages: 20
        };
        console.log('reload');
        console.log(total_pages);
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1,keyword='')
    {
        $('.spinner').fadeIn();
        $.ajax({
            url: '{{url('')}}/ajax/kamaroperasi/dokter/?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                total_pages = Math.ceil(data.total/items_show);
                var template = $('#template-pasienlist').html();
                loadMustache(template);
                var rendered = Mustache.render(template, data);
                $('.spinner').fadeOut();
                $('#renderPasien').html(rendered);
                $('.spinner-back-placeholder').hide();
                loadPagination(currentPage);
            },
            error: function() {
                alert('error');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

    $('#pasienSearchForm').submit(function( event ) {
        event.preventDefault();

        keyword = $('#pasienSearch').val();
        console.log(keyword);
        loadData(1,keyword);
    });

    function submitForm(id)
    {
        $('#formDokter').val(id);
        $('#formSubmit').submit();
    }

</script>

<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="" onclick='submitForm(@{{id}})'>
    <td><img class="img-avatar mr-10" src="{{asset('/assets/users')}}/@{{avatar}}" style="float:left"><h5 class="pt-20 font-w400"> @{{name}} </h5></td>
    </tr>
    @{{/data}}
</script>

@endsection
