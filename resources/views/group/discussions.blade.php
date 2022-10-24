@extends('layouts.main2')

@section('title')
Grup {{$group->name}}
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <!-- Group Banner -->
    @include('group.component.banner')
    <!-- End of Group Banner -->
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                @include('group.component.sidebar-left')
                <!-- End of Sidebar -->
            </div>
            <div class="col-md-9">
                <div class="block block-rounded block-transparent">
                    <div class="row">
                        <div class="col-md-9">
                            <form method="POST" class="block block-content block-link-shadow mb-0">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-1 mb-10">
                                        @if(!empty(Auth::user()->avatar_ori))
                                        <img class="img-avatar-sm" src="{{asset(Auth::user()->avatar_ori)}}" alt="">
                                        @else
                                        <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-11 mb-10">
                                        <div class="form-group">
                                            <textarea class="form-control" name="post" rows="1" placeholder="Tuliskan sesuatu..."></textarea>
                                        </div>
                                        @can('read member')
                                        <div class="form-group" id="postButton">
                                            <button type="submit" class="btn btn-primary float-right">Post!</button>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </form>
                            @forelse($posts as $index => $post)
                            <form method="POST" class="block block-content block-link-shadow mt-5 mb-0" action="{{url()->current()}}/edit">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-1">
                                        @if(!empty($post->creator->avatar_ori))
                                        <img class="img-avatar-sm" src="{{asset($post->creator->avatar_ori)}}" alt="">
                                        @else
                                        <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <span class="font-w600 font-size-s text-black">{{$post->creator->name}}</span>
                                        <span class="font-w400 font-size-xs text-muted">
                                            @if(!empty($post->creator->profesi))
                                            {{$post->creator->profesi_detail->title}}
                                            @endif
                                            <br>
                                            {{$post->created_at->diffForHumans()}}
                                            @if($updated[$index])
                                            , edited {{$post->updated_at->diffForHumans()}}
                                            @endif
                                        </span>
                                    </div>
                                    @if($post->creator->id == Auth::user()->id)
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 float-right" onclick="deletePost({{$post->id}})" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 float-right" onclick="editPost({{$post->id}})" data-toggle="tooltip" data-placement="top" title="Sunting">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="col-md-12 pt-20">
                                        <p id="p-{{$post->id}}" style="white-space: pre-line">{{$post->post}}</p>
                                        <textarea id="post-{{$post->id}}" class="form-control" name="post" rows="1" style="display: none;">{{$post->post}}</textarea>
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <button id="submit-{{$post->id}}" type="submit" class="btn btn-block btn-primary col-md-2 my-5 float-right" style="display: none;">Simpan</button>
                                        <button id="cancel-{{$post->id}}" type="button" class="btn btn-block btn-default col-md-2 my-5 mr-5 float-right" onclick="cancelEdit({{$post->id}})" style="display: none;">Batal</button>
                                    </div>
                                </div>
                            </form>
                            @empty
                            <div class="block block-content block-link-shadow mt-5 mb-0 text-center">
                                <h4 class="text-muted">Belum ada post diskusi pada grup ini</h4>
                            </div>
                            @endforelse
                        </div>
                        <div class="block block-transparent col-md-3 px-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
    {{csrf_field()}}
    <input type="hidden" id="inputDeletePostID" name="post_id">
</form>

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    $('#postButton').hide();
    $('.btn-block').click(function(){
        $(this).data('clicked', true);
    });

    $('textarea.form-control').focus(function () {
        $(this).animate({ height: "7.6em" }, "normal");
        $('#postButton').slideDown();
    }).blur(function () {
        if(!$.trim($(this).val())){
            $(this).animate({ height: "3.8em" }, "normal");
            $('#postButton').slideUp();
        }
    });

    function editPost(id)
    {
        var postId = '#p-'+id;
        var textareaId = '#post-'+id;
        var submitId = '#submit-'+id;
        var cancelId = '#cancel-'+id;
        console.log(submitId);
        $(postId).hide();
        $(textareaId).show();
        $(textareaId).focus();
        $(submitId).show();
        $(cancelId).show();
    }
    function cancelEdit(id)
    {
        var postId = '#p-'+id;
        var textareaId = '#post-'+id;
        var submitId = '#submit-'+id;
        var cancelId = '#cancel-'+id;
        console.log(submitId);
        $(postId).show();
        $(textareaId).hide();
        $(textareaId).blur();
        $(submitId).hide();
        $(cancelId).hide();
    }

    function deletePost(id)
    {
        swal({
            title: 'Hapus Post?',
            text: "Anda akan menghapus post dari grup ini. Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#inputDeletePostID').val(id);
                $('#formDelete').submit();
            }
        })
    }
</script>
@endsection
