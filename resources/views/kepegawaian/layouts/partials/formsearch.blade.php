<!-- Filter form -->
<div class="block rounded main-content transaction-index col-12 ">
  <div class="block-header">
    <h3 class="block-title"><i class="fa fa-search fa-6" aria-hidden="true"></i> Filter</h3>
  </div>
  <div class="block-content">
  <form id="form_search" action="{{route('export-file')}}" autocomplete="off">
    <div class="row">
      <div class="col-3">
        <div class="form-group">
          <label for="inputName">Nama</label>
        <input type="text" class="form-control" id="filter_name" name="filter_name"> 
        </div>
        <div class="form-group">
          <label for="inputNRP">NRP</label>
          <input class="form-control" id="filter_nrp" name="filter_nrp"> 
        </div>
        
        
      </div>
      <div class="col-3">
        <div class="form-group">
          <label>Usia</label>
          <div class="input-group">
            <input type="text" class="form-control" id="filter_min_age" name="filter_min_age" placeholder="Min">
            <div class="input-group-prepend input-group-append">
              <span class="input-group-text font-w600">Sampai</span>
            </div>
            <input type="text" class="form-control" id="filter_max_age" name="filter_max_age" placeholder="Max">
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <select class="form-control js-select2" name="filter_gender" id="filter_gender">
            <option selected value="">Semua</option>
            <option value="L">Laki - Laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="employeeStatus">Jenis Pegawai</label>
          <select class="form-control js-example-basic-multiple js-select2" name="filter_jenis_pegawai[]" id="filter_jenis_pegawai" multiple="multiple">
            @foreach ($form_data['jenis_pegawai'] as $jenis_pegawai)
              <option value="{{$jenis_pegawai->id}}">{{$jenis_pegawai->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Agama</label>
          <select class="form-control js-example-basic-multiple js-select2" name="filter_agama[]" id="filter_agama" multiple="multiple">
            @foreach($form_data['agama'] as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
          </select> 
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="employeeStatus">Status Pegawai</label>
          <select class="form-control js-example-basic-multiple js-select2" name="filter_status_pegawai[]" id="filter_status_pegawai" multiple="multiple">
            @foreach ($form_data['status_pegawai'] as $item)
              <option value="{{$item->id}}">{{$item->status}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" class="form-control" name="filter_alamat" id="filter_alamat"> 
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-3">

        <div class="form-group">
          <label for="employeeDepartment">Jabatan</label>
          <select class="js-select2 js-example-basic-multiple form-control" id="filter_jabatan" name="filter_jabatan[]" multiple="multiple">
            @foreach($form_data['jabatan'] as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
          </select> 
        </div>
        <div class="form-group">
          <label>Pangkat</label>
          <select class="js-select2 js-example-basic-multiple form-control" id="filter_pangkat" name="filter_pangkat[]" multiple="multiple">
            @foreach($form_data['pangkat'] as $pk)
              <option value="{{$pk->id}}">{{$pk->nama}}</option>
            @endforeach
          </select> 
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label>Departemen</label>
          <select class="js-select2 js-example-basic-multiple form-control" id="filter_departemen" name="filter_departemen[]" multiple="multiple">
            @foreach($form_data['departemen'] as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
          </select> 
        </div>
        <div class="form-group">
          <label>Golongan Darah</label>
          <select class="js-select2 js-example-basic-multiple form-control" id="filter_golongan_darah" name="filter_golongan_darah[]" multiple="multiple">
            @foreach($form_data['blood_type'] as $item)
              <option value="{{$item}}">{{$item}}</option>
            @endforeach
          </select> 
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label>Kualifikasi</label>

          <select class="js-select2 js-example-basic-multiple form-control" id="filter_kualifikasi" name="filter_kualifikasi[]" multiple="multiple">
            @foreach($form_data['kualifikasi'] as $kualifikasi)
              <option value="{{$kualifikasi->id}}">{{$kualifikasi->nama}}</option>
            @endforeach
          </select> 
        </div>
        <div class="form-group">
          <label>Pendidikan Umum Akhir</label>
          <select class="js-select2 js-example-basic-multiple form-control" id="filter_pendidikan" name="filter_pendidikan[]" multiple="multiple">
            @foreach ($form_data['pendidikan'] as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label>Tanggal Masuk</label>
          <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            <input type="text" class="form-control" id="filter_tmt_masuk_awal" name="filter_tmt_masuk_awal" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="" autocomplete="off">
            <div class="input-group-prepend input-group-append">
              <span class="input-group-text font-w600">to</span>
            </div>
            <input type="text" class="form-control" id="filter_tmt_masuk_akhir" name="filter_tmt_masuk_akhir" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="" autocomplete="off">
          </div>

        </div>
        <div class="form-group">
          <label>Tanggal Keluar</label>
          <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            <input type="text" class="form-control" id="filter_tmt_keluar_awal" name="filter_tmt_keluar_awal" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="" autocomplete="off">
            <div class="input-group-prepend input-group-append">
              <span class="input-group-text font-w600">to</span>
            </div>
            <input type="text" class="form-control" id="filter_tmt_keluar_akhir" name="filter_tmt_keluar_akhir" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="" autocomplete="off">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6 mt-15">
        <a href="javascript:void(0)" type="button" class="btn btn-primary btn-block mb-10" id="btn_filter">Filter</a>
      </div>
      <div class="col-6 mt-15">
        <button class="btn btn-success btn-block mb-10" id="btn_export_pegawai">
            <i class="fa fa-spin fa-spinner fa-1x d-none" id="loading"></i>
          Export Data Pegawai
        </button>
      </div>
    </div>
    </form>
  </div>
</div>

@push('footer-script')
<script>
  (function($){
    $(function(){
      let $form = $('form#mainform'),
      cityId = null,
      is_search = ($form.attr('is_search') == 1),
      ignite_select2 = function(){}
      ;
      
      ignite_select2 = function(){
        let mapItems = {
          department: {
            fn: formatDepartment,
            mt: 'getMdepartments'
          },
          position: {
            fn: formatPosition,
            mt: 'getMpositions'
          },
          city: {
            fn: formatCity,
            mt: 'getCities'
          },
          district: {
            fn: formatDistrcit,
            mt: 'getDistricts'
          }
        };

        $form.find('.select2-ajax').each(function(){
          let $me = $(this),
          item_rpp = 10,
          s2 = $me.data('s2'),
          MI = ('undefined' != typeof mapItems[s2] ? mapItems[s2] : null),
          value = null
          ;

          if(!MI)
            return true;

          // Select2 has been rendered
          if($me.data('select2'))
            return true;

          if(is_search) {
            value = $me.data('search');

            if('undefined' != typeof value && value)
              $me.append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
          }

          $me
          .select2({
            ajax: {
              url: AJAX_URL+'?act=ajax&mt='+MI.mt,
              dataType: 'json',
              delay: 250,
              data: function(params) {
                let data_ = {};

                data_ = {
                  q: params.term,
                  rpp: item_rpp,
                  id: cityId,
                  page: params.page||1
                };

                return data_;
              },
              processResults: function(data, params) {
                let dataparams = (data.params ? data.params : {}),
                total_item = data.total||0
                ;

                params.page = dataparams.page||1;

                return {
                  results: (data.items && data.items.length ? data.items : []),
                  pagination: {
                    more: (params.page * item_rpp) < total_item
                  }
                };
              },
              cache: !1
            },
            escapeMarkup: function(markup) { return markup; },
            minimumInputLength: 0,
            templateResult: MI.fn,
            templateSelection: formatRepoSelection
          })
          .on('change.select2', function(e){
            if(s2 == 'city')
              cityId = $me.val();
          });

          if(s2 == 'city')
            cityId = $me.val();
        });

        function formatDepartment(item) {
          if(item.loading) return item.text;

          let markup = ""
          +"<div class='select2-result-department clearfix'>"
          +"<div class='select2-result-department__full'>" + item.name + "</div>"
          +"</div>"
          ;

          return markup;
        }

        function formatPosition(item) {
          if(item.loading) return item.text;

          let markup = ""
          +"<div class='select2-result-position clearfix'>"
          +"<div class='select2-result-position__full'>" + item.name + "</div>"
          +"</div>"
          ;

          return markup;
        }

        function formatDistrcit(item) {
          if(item.loading) return item.text;

          let markup = ""
          +"<div class='select2-result-district clearfix'>"
          +"<div class='select2-result-district__full'>" + item.name + "</div>"
          +"</div>"
          ;

          return markup;
        }

        function formatCity(item) {
          if(item.loading) return item.text;

          let markup = ""
          +"<div class='select2-result-city clearfix'>"
          +"<div class='select2-result-city__full'>" + item.name + "</div>"
          +"</div>"
          ;

          return markup;
        }

        function formatRepoSelection(item) {
          return item.name || item.text;
        }
      };

      ignite_select2();
    });
})(window.$||window.jQuery||jQuery);
</script>
@endpush