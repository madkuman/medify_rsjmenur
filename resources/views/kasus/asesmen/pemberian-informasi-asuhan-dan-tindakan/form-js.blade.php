@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn-submit').prop('disabled', false);
            $('#btn-submit').html('Simpan')
        });
        $('#btn-submit').on('click', function() {
            $(this).prop('disabled', true);
            $(this).css({
                cursor: "not-allowed"
            });
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Simpan')
            $('#form-post').submit()
        });
    </script>
    <script type="text/javascript">
        // TTD Terapis Gigi dan Mulut I
        $('#selectTtdTerapisGigiDanMulut1').select2({
            ajax: {
                url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user',
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                delay: 250,
                processResults: function(data, params) {
                    var res = JSON.parse(data);
                    var results = [];
                    if (res.code == 200) {
                        results = res.data.data;
                    }
                    return {
                        results: $.map(results, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                                ttd: obj.ttd
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            $('#terapis_gigi_dan_mulut_1').val(selectedOption.text)
            $('#ttd_terapis_gigi_dan_mulut_1').val(selectedOption.ttd)
        });

        // TTD Terapis Gigi dan Mulut II
        $('#selectTtdTerapisGigiDanMulut2').select2({
            ajax: {
                url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user',
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                delay: 250,
                processResults: function(data, params) {
                    var res = JSON.parse(data);
                    var results = [];
                    if (res.code == 200) {
                        results = res.data.data;
                    }
                    return {
                        results: $.map(results, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                                ttd: obj.ttd
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            $('#terapis_gigi_dan_mulut_2').val(selectedOption.text)
            $('#ttd_terapis_gigi_dan_mulut_2').val(selectedOption.ttd)
        });
    </script>
@endsection
