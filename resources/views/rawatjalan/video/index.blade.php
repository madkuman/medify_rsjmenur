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

        #videos {
            position: relative;
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        #subscriber {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        #publisher {
            position: absolute;
            width: 150px;
            height: 200px;
            bottom: 10px;
            left: 10px;
            z-index: 100;
            border: 3px solid white;
            border-radius: 3px;
        }
    </style>
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
</head>
<body>
    @if($role=='mod')
    <div><button type="button" class="btn btn-success" onclick="stop()">disconnect</button></div>
    @endif
    <div id="videos">
        <div id="subscriber"></div>
        <div id="publisher"></div>
    </div>
    @include('layouts.components2.footer')
    @include('layouts.components2.js')
    <script type="text/javascript">
        var token = '{{ $opentok_token }}';
        var session_key = '{{ $session_token }}';
        var api_key = '{{ config('app.opentok_api_key') }}';
        var role = '{{ $role }}';
        var id = '{{ $id }}';
        var BASE_URL = "{{url('')}}/";
        var connectionId="";
        var connectedWith="";
        var publisher;
        var source;
        var durasi;
        function handleError(error) {
            if (error) {
            alert(error.message);
            }
        }

        var session = OT.initSession(api_key, session_key);
        var connectionCount = 0;
        
        session.on({
            streamCreated: function (event) {
              session.subscribe(event.stream, 'subscriber', {
                  insertMode: 'append',
                  width: '100%',
                  height: '100%'
              }, handleError);
            },
            connectionCreated: function (event) {
              connectionCount++;
              console.log(event);
              console.log(connectionCount + ' connections.');
              connectionId=event.connection.connectionId;
              console.log(connectionId);
              console.log(connectionCount)
              if(role=="mod"){
                if(connectionCount == 2){
                  connectedWith = connectionId;
                }
                // if(connectionCount > 2){
                //   session.forceDisconnect(connectionId); 
                //   connectionId="";
                // }
              }
            },
            connectionDestroyed: function (event) {
              connectionCount--;
              console.log(connectionCount + ' connections.');
            },
            sessionDisconnected: function sessionDisconnectHandler(event) {
              // The event is defined by the SessionDisconnectEvent class
              console.log('Disconnected from the session.');
              if (event.reason == 'networkDisconnected') {
                alert('Your network connection terminated.')
              }
              else if (event.reason == 'forceDisconnected') {
                swal({
                                    type: 'error',
                                    title: 'Forced Disconnected',
                                    html: 'Diputuskan oleh moderator',
                                    allowOutsideClick: false,
                                    timer: 20000
                    }).then((result) => {
                        window.close();
                    });
              }
            }
          });
        publisher = OT.initPublisher('publisher', {
            insertMode: 'append',
            width: '150px',
            height: '200px'
        }, handleError);

        session.connect(token, function(error) {
            if (error) {
                handleError(error);
            }
            else{
              session.publish(publisher,handleError);
            } 
        });
        function stop() {
            var formData = new FormData();
            formData.append('transaksi_id',id);
            formData.append('durasi_tersedia',durasi);
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
                       }
                    });
            session.forceDisconnect(connectedWith); 
            connectedWith="";
            alert("anda memutuskan koneksi");
        }
        $(window).on('unload', function() { 
            if(role == "mod"){
                var formData = new FormData();
                var token = $('meta[name="csrf-token"]').attr('content');
                formData.append('transaksi_id',id);
                formData.append('_token', token);
                formData.append('durasi_tersedia',durasi);
                var beaconUrl = BASE_URL  + 'api/rawatjalan/video/off';
                navigator.sendBeacon(beaconUrl, formData);
            }
            else if(role=="pub"){
                var formData = new FormData();
                var token = $('meta[name="csrf-token"]').attr('content');
                formData.append('transaksi_id',id);
                formData.append('_token', token);
                formData.append('from', "pub" );
                formData.append('durasi_tersedia',durasi);
                var beaconUrl = BASE_URL  + 'api/rawatjalan/video/puboff';
                navigator.sendBeacon(beaconUrl, formData);
            } 
        });
        if(role=="mod"){
            if(typeof(EventSource) !== "undefined") {
                var source_notif = new EventSource(BASE_URL  +"api/rawatjalan/video/notification/" +id);

                source_notif.onmessage = function(event) {
                    var data = JSON.parse(event.data)
                    durasi = data ? data.durasi_tersedia : '';
                    if(data){
                        //var result = confirm("Terima koneksi?");
                        swal({
                            title: "Pasien Sudah Terkoneksi",
                            html: 'Mulai Video Call Sekarang?',
                            type: 'info',
                            cancelButtonClass: 'btn btn-warning',
                            confirmButtonClass: 'btn btn-primary',
                            showCancelButton: true,
                            cancelButtonText: 'Tidak',
                            confirmButtonText: 'Ya',
                            reverseButtons: true,
                            timer: 60000,
                            allowOutsideClick: false
                        }).then((result) => {
                            if(result.value) {
                                var formData = new FormData();
                                formData.append('video_id',data["id"]);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                        type:'POST',
                                        url: BASE_URL  +"api/rawatjalan/video/accepted",
                                        contentType: false,
                                        processData: false,
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data:formData,
                                        success:function(data){
                                            setInterval(function () {
                                                --durasi;
                                                if(durasi == 180)
                                                {
                                                    alert("Waktu Video Call tersisa 3 menit.");
                                                }
                                            }, 1000);
                                           }
                                        });
                            }
                            else{
                                var formData = new FormData();
                                formData.append('video_id',data["id"]);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                        type:'POST',
                                        url: BASE_URL  +"api/rawatjalan/video/declined",
                                        contentType: false,
                                        processData: false,
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data:formData,
                                        success:function(data){
                                            alert("Anda menolak koneksi");
                                           }
                                        });
                            }
                        });
                    }
                };
            } else {
                alert("Sorry, your browser does not support server-sent events...");
            }
        }    
    </script>
</body>
</html>