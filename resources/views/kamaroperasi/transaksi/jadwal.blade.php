@extends('layouts.main2')

@section('title')
Ruangan - Kamar Operasi - Medify
@endsection

@section('sidebarcomponent')
@include('kamaroperasi.components.sidebar')
@endsection

@section('content')
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
   <div class="mt-50 mb-30 text-center">
    <h2 class="font-w700 text-black mb-10">Penjadwalan Kamar Operasi</h2>
    <h3 class="h5 text-muted mb-0">Pilih ruangan kamar operasi</h3>
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
        <div class="col-5">
          <p class="text-black font-w400">
            <label>Keterangan</label><br>
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
      </div>
    </div>
  </div>

  <div class="row"  id="ruangSelection">
    @php $index = 0 @endphp
    @foreach($ruangan as $ruang)
    <div class="col-lg-6 col-xl-4">
      <div class="block block-fx-shadow text-center">
        <a class="d-block @if($ruang->kategori == 'Kamar Operasi') bg-success @else bg-info @endif font-w600 text-uppercase py-5" href="" onclick="ruangSelect({{$index++}})">
          <span class="text-white">{{$ruang->kategori}}</span>
        </a>
        <div class="block-content block-content-full">
          <div class="pt-20 pb-30">
            <div class="font-size-h3 font-w700">{{$ruang->name}}</div>
            <div class="font-size-sm font-w600 text-muted">{{$ruang->transaksi_today->count()}} Ronde Hari Ini</div>
          </div>
          <a class="btn btn-secondary" onclick="ruangSelect({{$ruang->id}},'{{$ruang->name}}')">
            <i class="fa fa-send mr-5"></i> Pilih
          </a>
        </div>
      </div>
    </div>
    @endforeach

  </div>

  <div id="jadwalContent" style="display: none">
    <div class="row">
      <div class="col-12">
        <div class="block block-themed">
          <div class="block-header bg-success text-center" >
            Jadwal Operasi
          </div>
          <div class="block-content py-0 px-0">
            <div class="row">
              <div class="col-3">
                <div class="content">
                  <div class="form-group row">
                    <label class="col-12">Pilih Tanggal</label>
                    <div class="col-12">
                      <div class="js-datepicker" data-week-start="1" data-today-highlight="true"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8 pt-20 pb-20">
                <h2 class="font-w500 mb-0"><span id="content-title">OK 1</span>
                  <button class="btn btn-sm btn-alt-success" onclick="showRuang()">Ganti Ruang</button></h2>
                  <hr>
                  <span id="content-date">Thursday, 22 Maret 2018</span>
                  <div class="mt-10 spinner-container">
                    <ul class="hoverable spinner-back" id="table-content">
                    </ul>
                    <div class="spinner">
                      <i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="{{url()->current()}}/dokter" id="formSubmit">
    <input type="hidden" name="ruang" id="formRuang">
    <input type="hidden" name="ronde" id="formRonde">
    <input type="hidden" name="tanggal" id="formTanggal">
    {{csrf_field()}}
  </form>
</main>

@endsection

@section('js')
<script>

  new_date = moment().format('dddd, DD MMMM YYYY');
  today = moment().format('YYYY-MM-DD');
  $('#content-date').text(new_date);
  var current_ruang = 0;
  var current_date = today;

  function loadData()
  {
    var id= current_ruang;
    var date= current_date;

    $('.spinner').fadeIn();

    $.ajax
    ({
      url: '{{url('ajax/kamaroperasi/jadwal')}}',
      method: "POST",
      data:
      {
        "_token": "{{csrf_token()}}",
        "id": id,
        "tanggal": date
      },
      datatype:"json",
      success: function(response)
      {
          console.log(response);
          var content = '';
          var count =1;
          $.each(JSON.parse(response), function(idx, elem){
            index = idx+1
            if(jQuery.isEmptyObject(elem))
            {
                content += '<li><a href="javascript:void(0)" onclick="submitJadwal('+current_ruang+','+index+','+current_date+')">'
                content += '<div class="row">'
                content += '<div class="col-1 pt-10">'
                content += '<h2 class="font-w400">'+index+'</h2>'
                content += '</div>'
                content += '<div class="col-1 px-0">'
                content += '<i class="fa fa-5x fa-plus-circle"></i>'
                content += '</div>'
                content += '<div class="col-4 pt-15">'
                content += '<h3 class="text-muted">Kosong</h3>'
                content += '</div>'
                content += '</div>'
                content += '</a>'
                content += '</li>'
            }
            else
            {
              if (elem.pasien_detail.gender == 1)
                var gender = 'Laki laki';
              else var gender = 'Perempuan';

              content += '<li class="a-fill">';
              content += '<div class="row">';
              content += '<div class="col-1 pt-10">';
              content += '<h2 class="font-w400">'+ index +'</h2>';
              content += '</div>';
              content += '<div class="col-1 px-0">';
              content += '<img class="img-avatar" src="{{asset("assets/img/faces/avatar.jpg")}}" alt="">';
              content += '</div>';
              content += '<div class="col-4">';
              content += elem.pasien_detail.name;
              content += '<div class="font-w400 font-size-xs text-muted">' + gender + ', ' + elem.pasien_detail.age + ' Tahun</div>';
              content += '</div>';
              content += '<div class="col-3 pt-15">' + elem.dokter.name + '</div>';
              content += '<div class="col-3 pt-15">';
              if (elem.status==1) {
                content+='<span class="badge badge-success">Operasi telah dilakukan</span>';
              }
              else
              {
                content+='<span class="badge badge-info">Operasi belum dilakukan</span>';
              }
              content += '</div></div>';
              content += '</li>';
            }


          });
          $('.spinner').fadeOut();
          $('#table-content').html(content);
          $('#table-content').fadeIn();
        }
      });


  }
</script>

<script>

  function submitJadwal(ruang,ronde,tanggal)
  {
      $('#formRuang').val(ruang);
      $('#formRonde').val(ronde);
      $('#formTanggal').val(current_date);
      $('#formSubmit').submit();
  }

  function showRuang()
  {
    $('#ruangSelection').fadeIn();
    $('#jadwalContent').fadeOut();
  }

  function ruangSelect(ruang_id,name)
  {
    $('#content-title').text(name);

    var date= $('#tanggal').val();
    $('#ruangSelection').fadeOut();
    current_ruang = ruang_id;
    loadData();

    $('#jadwalContent').fadeIn();
  }

  $('.js-datepicker').on('changeDate', function() {
    var formatted_date = $('.js-datepicker').datepicker('getFormattedDate');
    current_date = moment(formatted_date).format('YYYY-MM-DD');
    console.log(current_date);


    new_date = moment(formatted_date).format('dddd, DD MMMM YYYY');
    loadData();
    $('#content-date').text(new_date);
  });

</script>
@endsection
