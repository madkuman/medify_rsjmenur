<table>
	<tr>
		<td>ID</td>
		<td>TA</td>
		<td>NRP</td>
		<td>Nama</td>
		<td>TglLahir</td>
		<td>Umur</td>
		<td>Kdkat</td>
		<td>Kdkorps</td>
		<td>Jur</td>
		<td>JK</td>
		<td>Kdsatker</td>
		<td>Kdpelaksana</td>
		<td>Kdtingkat</td>
		<td>TglUrikes</td>
		<td>TinggiBadan</td>
		<td>BeratBadan</td>
		<td>TekananDarah</td>
		<td>Jantung</td>
		<td>ParuParu</td>
		<td>Perut</td>
		<td>Hati</td>
		<td>Limpa</td>
		<td>AnggotaGerak</td>
		<td>AudioMetriKanan</td>
		<td>AudioMetriKiri</td>
		<td>VisusKanan</td>
		<td>VisusKiri</td>
		<td>Prespiopia</td>
		<td>ButaWarna</td>
		<td>LainMata</td>
		<td>PemeriksaanGigi</td>
		<td>PemeriksaanBedah</td>
		<td>PemeriksaanSyaraf</td>
		<td>PemeriksaanKeswa</td>
		<td>GolDarah</td>
		<td>Led</td>
		<td>Hemoglobin</td>
		<td>Leukosit</td>
		<td>Eritrosit</td>
		<td>HitungJenis</td>
		<td>Hematrokit</td>
		<td>GulaDarahPuasa</td>
		<td>GulaDarah2Jampp</td>
		<td>Kolesterol</td>
		<td>HDL</td>
		<td>LDL</td>
		<td>Trigliserida</td>
		<td>SGOT</td>
		<td>SGPT</td>
		<td>Alkali</td>
		<td>ProteinTotal</td>
		<td>Albumin</td>
		<td>Globulin</td>
		<td>Kreatinin</td>
		<td>Ureum</td>
		<td>AsamUrat</td>
		<td>Trombosit</td>
		<td>BilirubinTotal</td>
		<td>BilirubinDirek</td>
		<td>BilirubinIndirek</td>
		<td>HBSAG</td>
		<td>AntiHIV</td>
		<td>BeratJenis</td>
		<td>PH</td>
		<td>Warna</td>
		<td>Ketone</td>
		<td>Nitrine</td>
		<td>Protein</td>
		<td>Reduksi</td>
		<td>Bilirubin</td>
		<td>Urobilinogen</td>
		<td>EritrositLPB</td>
		<td>LeukositLPB</td>
		<td>Kristal</td>
		<td>Silindir</td>
		<td>Epitel</td>
		<td>Morphin</td>
		<td>Amphetamin</td>
		<td>Mariyuana</td>
		<td>Ekg</td>
		<td>Treadmill</td>
		<td>Rontgen</td>
		<td>USG</td>
		<td>Vdril</td>
		<td>Hbeag</td>
		<td>Telinga</td>
		<td>Hidung</td>
		<td>Tenggorokan</td>
		<td>Obsgyn</td>
		<td>Papsmear</td>
		<td>MST</td>
		<td>KdKategori</td>
		<td>IMT</td>
		<td>Falcipanummalaria</td>
		<td>Vivaxmalaria</td>
		<td>GDS</td>
		<td>AntiHCV</td>
		<td>HbAiC</td>
		<td>Ugizi</td>
		<td>Noreg</td>
		<td>U</td>
		<td>A</td>
		<td>B</td>
		<td>D</td>
		<td>L</td>
		<td>G</td>
		<td>J</td>
		<td>GD</td>
		<td>Stakes</td>
		<td>Ket</td>
		<td>Ket2</td>
		<td>Ket3</td>
		<td>Ket4</td>
		<td>Ket5</td>
		<td>Ket6</td>
		<td>Ket7</td>
		<td>Ket8</td>
		<td>Saran</td>
		<td>Kdpers</td>
	</tr>
	@foreach($transaksi as $trans)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{substr($trans->created_at, 0, 4)}}</td>
		<td>{{$trans->tni_nrp}}</td>
		<td>{{$trans->name}}</td>
		<td>{{date("d/m/Y", strtotime($trans->date_of_birth))}}</td>
		<td>{{$trans->pasien_detail->age}}</td>
		<td>--</td>
		<td>--</td>
		<td>--</td>
		<td>{{$trans->gender == 1 ? "L" : "P"}}</td>
		<td>--</td>
		<td>--</td>
		<td>--</td>
		<td>{{date("d-m-Y", strtotime($trans->ordered_at))}}</td>
		<td>{{$trans->kasus->identitas->tinggi_badan}}</td>
		<td>{{$trans->kasus->identitas->berat_badan}}</td>
		<td>{{$trans->kasus->identitas->tekanan_darah_tensi}}</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->jantung == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->dada_paru == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->perut == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->hati == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->limpa == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0 and $trans->kasus->fisikUrikkes[0]->kaki == 1) Normal @else Tidak Normal @endif</td>
		<td>@if(count($trans->kasus->telingaUrikkes)>0){{$trans->kasus->telingaUrikkes[0]->gendang_kanan}} @endif</td>
		<td>@if(count($trans->kasus->telingaUrikkes)>0){{$trans->kasus->telingaUrikkes[0]->gendang_kiri}} @endif</td>
		<td>@if(count($trans->kasus->mataUrikkes)>0){{$trans->kasus->mataUrikkes[0]->visus_od}}@endif</td>
		<td>@if(count($trans->kasus->mataUrikkes)>0){{$trans->kasus->mataUrikkes[0]->visus_os}}@endif</td>
		<td>@if(count($trans->kasus->mataUrikkes)>0){{$trans->kasus->mataUrikkes[0]->add}}@endif</td>
		<td>@if(count($trans->kasus->mataUrikkes)>0){{$trans->kasus->mataUrikkes[0]->membedakan_warna}}@endif</td>
		<td>@if(count($trans->kasus->mataUrikkes)>0){{$trans->kasus->mataUrikkes[0]->pemeriksaan_perimetris}}@endif</td>
		<td>@if(count($trans->kasus->gigiUrikkes)>0){{$trans->kasus->gigiUrikkes[0]->kelainan_gigi}} @endif</td>
		<td>--</td>
		<td>--</td>
		<td>--</td>
		<td>{{$trans->kasus->identitas->golongan_darah}}</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->led}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->hemoglobin}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->leukosit}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->eritrosit}} @endif</td>
		<td>--</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->hematokrit}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->glukosa_puasa}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->glukosa_2_jam_pp}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->kolesterol_total}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->hdl}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->ldl}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->triglyceride}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->sgot}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->sgpt}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->alkali_fosfatase}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->protein_total}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->albumin}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->globulin}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->kreatinin}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->ureum_bun}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->asam_urat}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->trombosit}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->bilirubin_total}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->bilirubin_direk}} @endif</td>
		<td>@if(count($trans->kasus->darahUrikkes)>0){{$trans->kasus->darahUrikkes[0]->bilirubin_indirek}} @endif</td>
		<td>@if(count($trans->kasus->immuUrikkes)>0){{$trans->kasus->immuUrikkes[0]->hbs_ag}}@endif</td>
		<td>@if(count($trans->kasus->immuUrikkes)>0){{$trans->kasus->immuUrikkes[0]->anti_hiv}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->berat_jenis}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->ph}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->warna}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->keton}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->nitrit}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->protein}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->reduksi}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->bilirubin}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->urobilinogen}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->eritrosit}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->leukosit}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->kristal}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->cylinder}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->epitel}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->morphin}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->amphetamine}}@endif</td>
		<td>@if(count($trans->kasus->urineUrikkes)>0){{$trans->kasus->urineUrikkes[0]->ganja}}@endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->ecg}} @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->treadmill}} @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->ro_thorax}} @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->mamae}} @endif, @if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->abdomen}} @endif</td>
		<td>@if(count($trans->kasus->immuUrikkes)>0){{$trans->kasus->immuUrikkes[0]->vdrl}}@endif</td>
		<td> -- </td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->telinga}} @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->hidung}} @endif</td>
		<td>@if(count($trans->kasus->fisikUrikkes)>0){{$trans->kasus->fisikUrikkes[0]->tenggorokan}} @endif</td>
		<td> -- </td>
		<td>@if(count($trans->kasus->papsmearUrikkes)>0){{$trans->kasus->papsmearUrikkes[0]->pap_smear}}@endif</td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td>@if(count($trans->kasus->immuUrikkes)>0){{$trans->kasus->immuUrikkes[0]->anti_hcv}}@endif</td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->u}}@endif</td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->a}}@endif</td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->b}}@endif</td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->d}}@endif</td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->l}}@endif</td>
				<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->g}}@endif</td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->j}}@endif</td>
		<td> -- </td>
				<td>@if(count($trans->kasus->resumeUrikkes)>0){{$trans->kasus->resumeUrikkes[0]->stakes}}@endif</td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>
		<td> -- </td>		
		<td> -- </td>
		<td> -- </td>
		<td>@if(count($trans->kasus->resumeUrikkes)>0){{strip_tags($trans->kasus->resumeUrikkes[0]->saran)}}@endif</td>
		<td> -- </td>
	</tr>
	@endforeach
</table>