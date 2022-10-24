@extends('layouts.main2')

@section('title')
Tambah Permintaan - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
            <div class="block-header">
              <h3 class="block-title">Tambah Permintaan Operasi</h3>
            </div>
            <div class="block-content">
              <div class="row">
                <div class="col-6">
                  <form action="" method="post" id="pendaftaran_form">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-12 form-group">
                        <label>Pasien</label>
                        <select class="js-select2 form-control" name="pasien" id="pasien_dropdown" data-placeholder="Pilih Pasien" required>
                        </select>
                      </div>
                    </div>
                    <div class="block block-bordered" style="max-height: 300px">
                      <div class="block-content px-5 py-5">
                        <div class="table-full-width spinner-container" id="pasien_placeholder">
                          <div class="spinner-back" style="min-height: 0px">
                            <div class="row">
                              <div class="col-3 text-center">
                                <div class="vertical-align-center" style="padding-top: 15%">
                                  <img class="img-avatar" src="{{url('')}}/assets/img/placeholder.jpg alt="">
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="py-2">
                                  <table class="tr1 table table-borderless">
                                    <tbody class="spinner-back-placeholder" style="min-height: 0px">
                                      <tr>
                                        <td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="spinner" style="padding-top: 10px;">
                              <i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
                            </div>
                          </div>
                        </div>
                        <table class="table table-borderless" id="main_userdetail" style="display: none;">
                          <tbody>
                            <tr>
                              <td>
                                <div class="row">
                                  <div class="col-3 text-center">
                                    <div class="vertical-align-center">
                                      <img class="img-avatar" id="thumb_pasien"src="{{url('')}}/assets/img/placeholder.jpg alt="">
                                    </div>
                                  </div>
                                  <div class="col-9">
                                    <span id="no_rm">00-10-22-34-14</span> <br>
                                    <strong style="font-size: 13pt;" id="nama_pasien">Nama Pasien</strong> <br>
                                    <span id="jk_umur">Laki laki, 22 tahun</span>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 form-group">
                        <label>Diagnosis</label>
                        <select class="js-select2 form-control" name="diagnosis_id" id="diagnosis_dropdown" data-placeholder="Cari Diagnosis" required>
                        </select>
												<input type="hidden" name="diagnosis" id="diagnosis">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 form-group text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</main>
	@endsection

  @section('js')
    <script>
			$("#pendaftaran_form").on('submit', function(){
					var selected = $("#diagnosis_dropdown").select2('data')[0].text;
					$("#diagnosis").val(selected);
			});

      $("#main_userdetail").hide();
      $(".spinner").hide();
      Codebase.helpers(['select2']);

      $("#pasien_dropdown").select2({
        ajax : {
          url: '{{ url('ajax/kamaroperasi/search_pasien') }}',
          delay: 250,
          dataType: 'json',
          data: function (params) {
            var query = {
              search: params.term,
            }
            return query;
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
        }
      });

      $("#pasien_dropdown").change(function(){
        $("#main_userdetail").hide();
        $("#pasien_placeholder").show();
				$(".spinner").show();
				$.ajax({
					url: '{{ url('ajax/kamaroperasi/get_pasien_summary') }}',
          dataType: 'json',
          data: {
            id: $(this).val(),
          },
          success: function(data){
            $("#pasien_placeholder").hide();
            $("#no_rm").html(data.id);
            $("#nama_pasien").html(data.name);
						if(data.gender == 1) gender = 'Laki laki';
						else gender = 'Perempuan';
            $("#jk_umur").html(gender+', '+data.age+' tahun');
						$("#thumb_pasien").attr('src', '{{ url('/') }}/'+data.photo_thumb);
						$(".spinner").hide();
            $("#main_userdetail").show();
          }
				});
      });

			$("#diagnosis_dropdown").select2({
        ajax : {
          url: '{{ url('ajax/kamaroperasi/search_diagnosis') }}',
          delay: 250,
          dataType: 'json',
          data: function (params) {
            var query = {
              search: params.term,
            }
            return query;
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
        }
      });
    </script>
  @endsection
