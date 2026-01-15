<?php

namespace App\Http\Controllers\Kasus\Psikologi\SelfReportingQuestionnaire;;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->asesmen_title = 'Self Reporting Questionnaire';
        $this->asesmen_namespace = 'App\Http\Controllers\Kasus\Psikologi\SelfReportingQuestionnaire;';
        $this->asesmen_slug = 'self-reporting-questionnaire';
    }
    public function submitForm($nomor_kasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            // dd($request);
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $hasil = [];
            $input = $request->all();
            foreach ($input as $key => $val) {
                if ($key == '_token')    continue;
                if ($key == 'kasus')    continue;
                if ($key == 'id')    continue;
                if ($key == 'penerima') $hasil[$key] = $val;
                if ($key == 'sakit_kepala') $hasil[$key] = $val;
                if ($key == 'nafsu_makan') $hasil[$key] = $val;
                if ($key == 'tidur_nyenyak') $hasil[$key] = $val;
                if ($key == 'takut') $hasil[$key] = $val;
                if ($key == 'cemas_takut_khawatir') $hasil[$key] = $val;
                if ($key == 'nama_orang_mengerjakan') $hasil[$key] = $val;
                if ($key == 'gangguan_pencernaan') $hasil[$key] = $val;
                if ($key == 'berpikir_jernih') $hasil[$key] = $val;
                if ($key == 'tidak_bahagia') $hasil[$key] = $val;
                if ($key == 'sering_menangis') $hasil[$key] = $val;
                if ($key == 'menikmati_aktivitas') $hasil[$key] = $val;
                if ($key == 'mengambil_keputusan') $hasil[$key] = $val;
                if ($key == 'aktivitas_terbengkalai') $hasil[$key] = $val;
                if ($key == 'tidak_mampu_berperan') $hasil[$key] = $val;
                if ($key == 'kehilangan_minat') $hasil[$key] = $val;
                if ($key == 'tidak_berharga') $hasil[$key] = $val;
                if ($key == 'mengakhiri_hidup') $hasil[$key] = $val;
                if ($key == 'merasa_lelah') $hasil[$key] = $val;
                if ($key == 'tidak_enak_perut') $hasil[$key] = $val;
                if ($key == 'mudah_lelah') $hasil[$key] = $val;
                if ($key == 'totalScore') $hasil[$key] = $val;
                if ($key == 'category') $hasil[$key] = $val;
                if ($key == 'dokter') $hasil[$key] = $val;
                if ($key == 'ttd_dokter') $hasil[$key] = $val;
                if ($key == 'selectTtdDokter') $hasil[$key] = $val;
            }

            if ($id != null) {
                $alatBantu = AlatBantu::find($id);
                $alatBantu->updated_by = Auth::user()->id;
                $alatBantu->updated_by = Auth::user()->id;
            } else {
                $alatBantu = new AlatBantu;
                $alatBantu->created_by = Auth::user()->id;
                $alatBantu->created_by = Auth::user()->id;
            }

            $alatBantu->kasus_id = $kasus->id;
            $alatBantu->type = $this->asesmen_slug;
            $alatBantu->val = json_encode($hasil);
            $alatBantu->save();

            DB::connection('kasus')->commit();

            if ($id != null) {
                return redirect('kasus/' . $nomor_kasus . '/psikologi/' . $this->asesmen_slug . '/edit/' . $id)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Diperbaharui!');
            } else {
                return redirect('kasus/' . $nomor_kasus . '/psikologi/' . $this->asesmen_slug)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Dibuat!');
            }
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
    public function OLDsubmitForm($nomor_kasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            // dd($request);
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $hasil = [];
            $vitalsign = [];
            $input = $request->all();
            $input_image = [];
            foreach ($input as $key => $val) {
                if ($key == '_token')    continue;
                if ($key == 'kasus')    continue;
                if ($key == 'id')    continue;
                if ($key == 'image') {
                    foreach ($val as $key => $item_name) {
                        if ($request->$item_name) {
                            $input_image[$item_name] = base64ToImage(
                                $request->$item_name,
                                "uploads/psikologi/" . $this->asesmen_slug,
                                $key
                            );
                        }
                    }
                    continue;
                }
                if ($input_image[$key] ?? null) {
                    $hasil[$key] = $input_image[$key];
                } else {
                    $hasil[$key] = $val == "on" ? 'Ya' : $val;
                }
            }

            $vitalsign['tanggal_pemeriksaan'] = Carbon::now()->format('Y-m-d') . 'T' . Carbon::now()->format('H:i');
            $vitalsign = new Request($vitalsign);
            $check_vitalsign = $request->id;
            if ($check_vitalsign == null) {
                app(\App\Http\Controllers\Kasus\VitalSign\CreateController::class)->create($nomor_kasus, $vitalsign);
            }
            if ($id != null) {
                $alatBantu = AlatBantu::find($id);
                $alatBantu->updated_by = Auth::user()->id;
                $alatBantu->updated_by = Auth::user()->id;
            } else {
                $alatBantu = new AlatBantu;
                $alatBantu->created_by = Auth::user()->id;
                $alatBantu->created_by = Auth::user()->id;
            }

            $alatBantu->kasus_id = $kasus->id;
            $alatBantu->type = $this->asesmen_slug;
            $alatBantu->val = json_encode($hasil);
            $alatBantu->save();

            DB::connection('kasus')->commit();

            if ($id != null) {
                return redirect('kasus/' . $nomor_kasus . '/psikologi/' . $this->asesmen_slug . '/edit/' . $id)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Diperbaharui!');
            } else {
                return redirect('kasus/' . $nomor_kasus . '/psikologi/' . $this->asesmen_slug)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Dibuat!');
            }
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function delete(Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            $id = $request->id;

            $form = AlatBantu::find($id);
            $form->delete();

            DB::connection('kasus')->commit();

            return back()
                ->with('status', 1)
                ->with('title', 'Sukses')
                ->with('message', 'Asesmen Berhasil di Hapus');
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function searchUser(Request $request)
    {
        $parameter = $request->name ?? '';
        $user = User::select('id', 'name', 'ttd')
            ->where('name', 'like', "%" . $parameter . '%')
            ->paginate(10);

        $data['code'] = 200;
        $data['message'] = 'Success';
        $data['data'] = $user;
        return json_encode($data);
    }
    public function addTTD($nomor_kasus = null, Request $request)
	 {
		DB::connection('kasus')->beginTransaction();

		try {
			$pasien_id = $request->pasien_id;

			// upload image from canvas
			$img_base64 = $request->imgBase64;
			$img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
			$img_base64 = str_replace(' ', '+', $img_base64);
			$img_data = base64_decode($img_base64);
			$img_dir = app('App\Http\Controllers\Functions\ImageUploader')->upload($img_data, 'ttd');
			$success = file_put_contents($img_dir['file_original'], $img_data);

			if ($success) {
				$alat_bantu = AlatBantu::find($request->id);
				$decode = json_decode($alat_bantu->val);								
				$decode->img_ttd = $img_dir['file_original'];				
				$decode->nama_ttd = $request->ttd_nama;				
				$alat_bantu->val = json_encode($decode);				
				$alat_bantu->updated_by = Auth::user()->id;
				$alat_bantu->save();

				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Berhasil menandatangani form ini';

				DB::connection('kasus')->commit();
			} else {
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Gagal mengunggah tanda tangan. Silahkan hapus tanda tangan dan coba lagi.';
			}

			if (!is_null($nomor_kasus)) {
				$url = 'kasus/' . $nomor_kasus . '/psikologi/self-reporting-questionnaire';
			}else{
				$url = 'pasien/' . $pasien_id;	
			}

			$data['url'] = $url;


			return response()->json($data, 200);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal mengunggah tanda tangan : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
