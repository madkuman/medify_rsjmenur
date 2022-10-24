<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Edit - <strong>{{$user->name}}</strong>
			</h3>
		</div>
		<div class="block-content">
			<form method="POST" action="{{url('admin')}}/user-control/{{$user->id}}/edit">
				{{csrf_field()}}
				@if($allow_admin)
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Admin</label>
							<select class="form-control" name="admin">
								<option value="0" @if($user->admin) selected @endif>User</option>
								<option value="1" @if($user->admin) selected @endif>Admin</option>
							</select>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Id Pegawai</label>
							<select class="js-select2 form-control" id="kepegawaian" name="employee">
	                            @if(!empty($synced_acc))
	                            <option value="{{$synced_acc->id}}" selected>{{$synced_acc->name}} ({{$synced_acc->nrp}})</option>
	                            @else
	                            <option value="">Pilih Nama...</option>
	                            @endif
	                            @foreach($pegawai as $item)
	                            <option value="{{$item->id}}">{{$item->name}} ({{$item->nrp}})</option>
	                            @endforeach
	                        </select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control form-control-lg" value="{{$user->email}}" required>
							@if ($errors->has('email'))
	                        <span class="badge badge-danger">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                        @endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Profesi</label>
							<select class="js-select2 form-control" id="profesi" name="profession">
								@foreach($profesi as $id => $title)
								<option value="{{ $id }}" @if($user->profesi == $id) selected @endif>{{ $title }}</option>
								@endforeach
		                    </select>
						</div>
					</div>
				</div>
				<div id="div-spesialis" class="row" style="display: none;">
					<div class="col-6">
						<div class="form-group">
							<label>Speciality</label>
							<select class="js-select2 form-control" id="spesialis" name="specialty" data-placeholder="" style="width: 100%;">
		                        @foreach($specialty as $id => $title)
		                        <option value="{{ $id }}" @if($user->specialty == $id) selected @endif>{{ $title }}</option>
		                        @endforeach
		                    </select>
						</div>
					</div>
				</div>
                <div id="div-subspesialis" class="row" style="display: none;">
					<div class="col-6">
						<div class="form-group">
							<label>Sub Speciality</label>
							<select class="js-select2 form-control" id="subspesialis" name="subspecialty" style="width: 100%;">
		                        <option value="">Tanpa Subspesialis</option>
		                        @if(!empty($subspecialty))
		                        @foreach($subspecialty as $item)
		                        <option value="{{ $item->id }}"  @if($user->subspecialty == $item->id) selected @endif >{{ $item->name }}</option>
		                        @endforeach
		                        @endif
		                    </select>
						</div>
					</div>
				</div>
                <div id="div-dokter" class="row" style="display: none;">
					<div class="col-6">
						<div class="form-group">
							<label>Koneksikan dengan Dokter</label>
							<select class="js-select2 form-control" id="dokter" name="dokter_id" style="width: 100%;">
		                        <option value="" selected>Pilih Dokter</option>
		                        @foreach($dokter as $item)
		                        <option value="{{ $item->id }}"  @if($user->dokter_id == $item->id) selected @endif >{{ $item->name }}</option>
		                        @endforeach
		                    </select>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-6">
						<hr>
						<div class="form-group text-right">
							@if(isset($origin))
							<input type="hidden" name="origin" value="{{$origin}}">
							@endif
							<button class="btn btn-alt btn-primary btn-hero m-0" type="submit" id="button_submit">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>