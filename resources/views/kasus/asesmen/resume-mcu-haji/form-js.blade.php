@section('js')
    <script>
        $('#selectPsikolog').select2({
            ajax: {
                url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user-psikolog',
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
                                text: obj.name
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            $('#psikolog').val(selectedOption.text)
        });
    </script>
    <script>
        // TTD Mengetahui Dokter Umum
        $('#selectDokterUmum').select2({
            ajax: {
                url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user-dokter-umum',
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
                                text: obj.name
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            $('#dokter_umum').val(selectedOption.text)
        });
    </script>
    <script>
        // TTD Mengetahui Dokter SpPD
        $('#selectDokterSppd').select2({
            ajax: {
                url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user-dokter-sppd',
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
                                text: obj.name
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            $('#dokter_sppd').val(selectedOption.text)
        });
    </script>
    <script>
        function hitungBMI() {
            var bb = parseFloat($("#bb").val()); // Ambil BB (kg)
            var tb = parseFloat($("#tb").val()); // Ambil TB (cm)

            if (bb > 0 && tb > 0) {
                var tinggiMeter = tb / 100; // Ubah cm ke meter
                var bmi = bb / (tinggiMeter * tinggiMeter); // Hitung BMI
                $("#bmi").val(bmi.toFixed(2)); // Tampilkan hasil dengan 2 desimal

                // Menentukan kategori berdasarkan nilai BMI
                var kategori_bmi = "";
                if (bmi < 18.5) {
                    kategori_bmi = "Kurus";
                } else if (bmi >= 18.5 && bmi <= 24.9) {
                    kategori_bmi = "Normal / Ideal";
                } else if (bmi >= 25 && bmi <= 29.9) {
                    kategori_bmi = "Overweight (Berat Badan Berlebih)";
                } else if (bmi >= 30 && bmi <= 34.9) {
                    kategori_bmi = "Obesitas Kelas 1";
                } else if (bmi >= 35 && bmi <= 39.9) {
                    kategori_bmi = "Obesitas Kelas 2";
                } else {
                    kategori_bmi = "Obesitas Kelas 3 (Obesitas Morbid)";
                }

                $("#kategori_bmi").val(kategori_bmi); // Tampilkan kategori_bmi BMI
            } else {
                $("#bmi, #kategori_bmi").val(""); // Kosongkan jika input tidak valid
            }
        }

        $("#bb, #tb").on("input", function() {
            hitungBMI();
        });
    </script>
    <script>
        $('.select-diagnosis').select2({
            ajax: {
                url: API_URL + '/kasus/get/list/diagnosis',
                data: function(params) {
                    return {
                        keyword: params.term,
                    };
                },
                processResults: function(data, params) {
                    var icd = JSON.parse(data).data;
                    return {
                        results: $.map(icd, function(obj) {
                            return {
                                id: obj.code_icd + " - " + obj.long_desc,
                                text: obj.code_icd + " - " + obj.long_desc
                            };
                        })
                    };
                },
                cache: true
            }
        });
    </script>
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
        // validasi Input Skala Penilaian
        function validateInputSkalaPenilaian(inputElement) {
            const inputValue = inputElement.value;

            // Menghapus karakter selain angka 0-9
            const cleanedValue = inputValue.replace(/\D/g, '');

            // Memastikan nilai tetap antara 0-9
            if (cleanedValue < 0) {
                inputElement.value = 0;
            } else if (cleanedValue > 9) {
                inputElement.value = 9;
            } else {
                inputElement.value = cleanedValue;
            }
        }
        // TTD Mengetahui Dokter
        $('#selectTtdMengetahuiDokter').select2({
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
            $('#mengetahui_dokter').val(selectedOption.text)
            $('#ttd_mengetahui_dokter').val(selectedOption.ttd)
        });

        // skala penilaian pasien
        $(document).ready(function() {
            let status_medis_skala_penilaian_pasien = $('input[name ="status_medis_skala_penilaian_pasien"]')
                .val() ?? 0
            let status_pekerjaan_dukungan_hidup_skala_penilaian_pasien = $(
                'input[name ="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien"]').val() ?? 0
            let status_penggunaan_narkotika_skala_penilaian_pasien = $(
                'input[name ="status_penggunaan_narkotika_skala_penilaian_pasien"]').val() ?? 0
            let status_legal_skala_penilaian_pasien = $('input[name ="status_legal_skala_penilaian_pasien"]')
                .val() ?? 0
            let riwayat_keluarga_sosial_skala_penilaian_pasien = $(
                'input[name ="riwayat_keluarga_sosial_skala_penilaian_pasien"]').val() ?? 0
            let status_psikiatris_skala_penilaian_pasien = $(
                'input[name ="status_psikiatris_skala_penilaian_pasien"]').val() ?? 0

            // status_medis_skala_penilaian_pasien
            $('input[name ="status_medis_skala_penilaian_pasien"]').change(function() {
                status_medis_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="status_medis_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
                    if (status_medis_skala_penilaian_pasien == i) {
                        $(`#status_medis_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                        break;
                    }
                }
            });
            // status_pekerjaan_dukungan_hidup_skala_penilaian_pasien
            $('input[name ="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien"]').change(function() {
                status_pekerjaan_dukungan_hidup_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_"]')
                        .removeClass('filled');
                    if (status_pekerjaan_dukungan_hidup_skala_penilaian_pasien == i) {
                        $(`#status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_${i}`)
                            .addClass('filled');
                        break;
                    }
                }
            });
            // status_penggunaan_narkotika_skala_penilaian_pasien
            $('input[name ="status_penggunaan_narkotika_skala_penilaian_pasien"]').change(function() {
                status_penggunaan_narkotika_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_"]').removeClass(
                        'filled');
                    if (status_penggunaan_narkotika_skala_penilaian_pasien == i) {
                        $(`#status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_${i}`).addClass(
                            'filled');
                        break;
                    }
                }
            });
            // status_legal_skala_penilaian_pasien
            $('input[name ="status_legal_skala_penilaian_pasien"]').change(function() {
                status_legal_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="status_legal_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
                    if (status_legal_skala_penilaian_pasien == i) {
                        $(`#status_legal_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                        break;
                    }
                }
            });
            // riwayat_keluarga_sosial_skala_penilaian_pasien
            $('input[name ="riwayat_keluarga_sosial_skala_penilaian_pasien"]').change(function() {
                riwayat_keluarga_sosial_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_"]').removeClass(
                        'filled');
                    if (riwayat_keluarga_sosial_skala_penilaian_pasien == i) {
                        $(`#riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_${i}`).addClass(
                            'filled');
                        break;
                    }
                }
            });
            // status_psikiatris_skala_penilaian_pasien
            $('input[name ="status_psikiatris_skala_penilaian_pasien"]').change(function() {
                status_psikiatris_skala_penilaian_pasien = $(this).val();
                for (let i = 0; i <= 9; i++) {
                    $('[id^="status_psikiatris_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
                    if (status_psikiatris_skala_penilaian_pasien == i) {
                        $(`#status_psikiatris_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                        break;
                    }
                }
            });
        })
    </script>

    {{-- <script>
        const clockRadios = document.getElementsByName("clockTestInput");
        const clockStatus = document.getElementById("clockTestStatus");

        const kataRadios = document.getElementByName("kataTestInput");
        const kataStatus = document.getElementById("kataTestStatus");

        clockRadios.forEach(radio => {
            radio.addEventListener("change", () => {
                const value = parseInt(radio.value);
                if (value === 4) {
                    clockStatus.value = "Normal";
                } else {
                    clockStatus.value = "Menurun";
                }
            });
        });

        kataRadios.forEach(radio => {
            radio.addEventListener("change", () => {
                const value = parseInt(radio.value);
                if (value === 3) {
                    kataStatus.value = "Normal";
                } else {
                    kataStatus.value = "Menurun";
                }
            });
        });
    </script> --}}


    <script>
        const clockInput = document.getElementById("clockTestInput");
        const clockStatus = document.getElementById("clockTestStatus");

        const kataInput = document.getElementById("kataTestInput");
        const kataStatus = document.getElementById("kataTestStatus");

        // Clock Drawing Test
        clockInput.addEventListener("input", function() {
            const val = parseInt(this.value);
            if (!isNaN(val)) {
                clockStatus.value = (val === 4) ? "Normal" : "Menurun";
            } else {
                clockStatus.value = "";
            }
        });

        // Sebutkan 3 Kata
        kataInput.addEventListener("input", function() {
            const val = parseInt(this.value);
            if (!isNaN(val)) {
                kataStatus.value = (val === 3) ? "Normal" : "Menurun";
            } else {
                kataStatus.value = "";
            }
        });
    </script>
@endsection
