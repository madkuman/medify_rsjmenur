@if(Session::get('success')!=null)
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> {!! Session::get('success') !!}
    </div>
@endif

@if(Session::get('danger')!=null)
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {!! Session::get('danger') !!}
    </div>
@endif