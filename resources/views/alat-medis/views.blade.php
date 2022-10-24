@extends('alat-medis.layouts.main')


@section('title')
    Alat Medis
@endsection


@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Alat Medis</h3>
        </div>
        <div class="block-content" align="center">
            <i class="fa fa-4x fa-spinner fa-spin text-info" id="loading" style="display: none"></i>
            <div class="card-deck text-break" style="display: flex; flex-wrap: wrap;">
                @foreach($items as $item)
                    <div class="card bg-light  mb-3 mr-3 col-lg-4" style="max-width: 18rem;">
                        <div class="card-header mt-2">
                            <h5 class="card-title ">{{$item->name}}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" id="{{$item->id}}"><i class="fa fa-briefcase-medical"></i>  {{$item->tersedia}}/{{$item->total}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $( document ).ready(function() {
            setTimeout(function(){ checkItem(); }, 60000);
        });

        function checkItem(argument) {
            $.ajax({
                type:'GET',
                url : '{{url("/alat-medis/viewsJson")}}',
                beforeSend: function () {
                    $('.card-deck').html( '' );
                    $("#loading").show();
                },
                success:function(data){  
                    $("#loading").hide();
                    var items = data.items;
                    items.forEach(function (item, index) {
                        $('.card-deck').append( 
                        '<div class="card bg-light  mb-3 mr-3 col-lg-4" style="max-width: 18rem;">'+
                            '<div class="card-header mt-2">'+
                                '<h5 class="card-title" >'+item.name+'</h5>'+
                            '</div>'+
                            '<div class="card-body">'+
                                '<p class="card-text" id="'+item.id+'"><i class="fa fa-briefcase-medical"></i> '+item.tersedia+'/'+item.total+'</p>'+
                            '</div>'+
                        '</div>' );
                    });
                }
            });

            setTimeout(function(){ checkItem(); }, 60000);            
        }

    </script>
@endsection