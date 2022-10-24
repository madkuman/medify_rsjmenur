<form action="{{url()->current()}}/create" method="POST">
	{{csrf_field()}}
	<div class="col-12">
		@yield('table-tag')
	        <thead>
	            <tr>
	                <th style="width: 25%;">Materi Edukasi</th>
	                <th style="width: 10%;">Tanggal</th>
	                <th class="text-center" style="width: 7%;">Durasi (menit)</th>
	                <th class="text-center" style="width: 10%;">Metode</th>
	                <th class="text-center" style="width: 15%;">Evaluasi</th>
	                <th class="text-center" style="width: 15%;">Sasaran</th>
	                <th class="text-center" style="width: 15%;">Alat Edukasi</th>
	                <th class="text-right" style="width: 3%;"></th>
	            </tr>
	        </thead>
	        <tbody>
	        	@yield('tr')
	        </tbody>
	    </table>
    	@yield('add-button')
    	<hr>
	</div>
    <div class="col-12">
        <table class="table table-borderless table-vcenter">
            <tbody>
                <tr>
                    <td>
                    	<div class="form-group">
	                        <label for="penjelasan_pasien">Penjelasan pasien tentang pemberian edukasi:</label>
	                        <textarea class="form-control" rows="4" id="penjelasan_pasien" name="penjelasan_pasien"></textarea>
	                    </div>
                    </td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td>
                    	<div class="form-group">
	                        <label for="rekomendasi">Rekomendasi (tanggal/jam):</label>
	                        <input class="form-control" type="text" autocomplete="off" id="rekomendasi" name="rekomendasi">
	                    </div>
                    </td>
                    <td width="30%"></td>
                </tr>
            </tbody>
        </table>
    </div>
	<div class="modal-footer">
		<div class="form-group">
			@yield('jenis-form')
			<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
		</div>
	</div>
</form>