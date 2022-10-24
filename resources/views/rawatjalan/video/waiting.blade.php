<!doctype html>
<html lang="en" class="no-focus">
<head>
    @include('layouts.components2.header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Video </title>
    <style type="text/css">
        body, html {
            background-color: gray;
            height: 100%;
        }
    </style>
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
</head>
<body>
    @include('layouts.components2.footer')
    @include('layouts.components2.js')
    <script type="text/javascript">
        $( document ).ready(function() {
            swal({
                title: "Terhubung",
                html: 'Menunggu Konfirmasi Dokter',
                type: 'info',
                confirmButtonClass: 'btn btn-warning',
                cancelButtonClass: 'btn btn-primary',
                showCancelButton: true,
                confirmButtonText: 'Ok',
                allowOutsideClick: false,
                cancelButtonText: 'Kembali',
                reverseButtons: true
            }).then((result) => {
                if(result.value) {
                }
                else{
                    //url tempat untuk disconnect
                    window.location.replace("{{url('rawatjalan/disconnect')}}/"+id); 
                }
            });
        });
        var id = '{{ $id }}';
        var BASE_URL = "{{url('')}}/";
        var source;
        $(window).on('unload', function() { 
            var formData = new FormData();
            var token = $('meta[name="csrf-token"]').attr('content');
            formData.append('transaksi_id',id);
            formData.append('_token', token);
            formData.append('from', "waiting" );
            var beaconUrl = BASE_URL  + 'api/rawatjalan/video/puboff';
            navigator.sendBeacon(beaconUrl, formData);
        });
        if(typeof(EventSource) !== "undefined") {
            var source_notif = new EventSource(BASE_URL  +"api/rawatjalan/video/waiting/" +id);
            source_notif.onmessage = function(event) {
                var data = JSON.parse(event.data)
                console.log(data);
                if(data){
                    if(data['is_connected'] == 1){
                        swal({
                            title: "Dokter Menerima Video Call",
                            html: 'Mulai Video Call Sekarang?',
                            type: 'info',
                            cancelButtonClass: 'btn btn-warning',
                            confirmButtonClass: 'btn btn-primary',
                            showCancelButton: true,
                            cancelButtonText: 'Tidak',
                            allowOutsideClick: false,
                            confirmButtonText: 'Ya',
                            reverseButtons: true
                        }).then((result) => {
                            if(result.value) {
                                alert("Menuju Ke video");
                                window.location.replace("{{url('rawatjalan/videopub')}}/"+id);
                            }
                            else{
                                var formData = new FormData();
                                formData.append('transaksi_id',data["id"]);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                        type:'POST',
                                        url: BASE_URL  +"api/rawatjalan/video/disconnect",
                                        contentType: false,
                                        processData: false,
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data:formData,
                                        success:function(data){
                                            alert("Anda tidak jadi join");
                                           }
                                        }); 
                            }
                        });
                    }
                    else if (data['is_declined'] == 1){
                        swal({
                                            type: 'error',
                                            title: 'Ditolak',
                                            html: 'Ditolak oleh moderator',
                                            allowOutsideClick: false,
                                            timer: 20000
                            }).then((result) => {
                                window.close();
                            });
                    }
                }
            };
        } else {
            alert("Sorry, your browser does not support server-sent events...");
        }   
    </script>
</body>
</html>