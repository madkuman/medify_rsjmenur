<?php

namespace App\Http\Controllers\KamarOperasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\PergantianJadwal;
use App\Models\Kasus\ICD10;
use DB;
use Auth;

class EditController extends Controller
{
    public function pindah(Request $request)
    {
        $transaksi_id = $request->input('transaksi_id');
    }

    public function requestGantiJadwal(Request $request)
    {
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();

        try {
            $id = $request->input('id');
            $ganti = new PergantianJadwal;
            $ganti->operasi_id = $id;
            $ganti->user_id = auth()->user()->id;
            $ganti->keterangan = $request->input('keterangan');
            $ganti->save();

            $operasi = Transaksi::find($id);
            $operasi->status = 2;
            $operasi->save();
            $connection->commit();

            $status = 1;
            $message = 'Berhasil mengirim permintaan pergantian jadwal!';
            $title = 'Berhasil!';

            return redirect('kamaroperasi/pelaksanaan/'.$id.'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!';

            return redirect('kamaroperasi/pelaksanaan/'.$id.'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }

    }

    public function editDokter(Request $request)
    {
        $transaksi = Transaksi::find($request->input('id'));
        $transaksi->doctor_id = $request->input('dokter');
        $transaksi->save();

        $status = 1;
        $message = 'Pergantian Dokter Berhasil!';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/pelaksanaan/'.$request->input('id').'#pengaturan')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function editJudul(Request $request)
    {
        $transaksi = Transaksi::find($request->input('id'));
        $transaksi->judul = $request->input('judul');
        $transaksi->save();

        $status = 1;
        $message = 'Pergantian Judul Berhasil!';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/pelaksanaan/'.$request->input('id').'#pengaturan')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function editOperasiJoin(Request $request)
    {
        $current_child = Transaksi::where('parent_id', $request->input('parent_id'))->pluck('id');
        $remaining_child = array();
        $judul_child = $request->input('judul_child');
        $dokter_child = $request->input('dokter_child');

        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();

        try{
            foreach ($request->input('id') as $key => $value) {
                if ($value != 0) {
                    $transaksi = Transaksi::findOrFail($value);
                    array_push($remaining_child, $value);
                } else {
                    $transaksi = new Transaksi;
                    $transaksi->parent_id = $request->input('parent_id');
                    $transaksi->status = 0;
                    $transaksi->dijadwalkan_oleh = Auth::user()->id;
                }
                $transaksi->judul = $judul_child[$key];
                $transaksi->doctor_id = $dokter_child[$key];
                $transaksi->save();
            }
            foreach ($current_child as $key => $value) {
                if (in_array($value, $remaining_child)) {
                    continue;
                } else {
                    $transaksi = Transaksi::findOrFail($value);
                    $transaksi->alasan_batal = "Operasi join dibatalkan";
                    $transaksi->deleted_by = Auth::user()->id;
                    $transaksi->save();
                    $transaksi->delete();
                }
            }
            $connection->commit();

            $status = 1;
            $message = 'Berhasil melakukan pengaturan operasi join!';
            $title = 'Berhasil!';

            return redirect('kamaroperasi/pelaksanaan/'.$request->input('parent_id').'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!';

            return redirect('kamaroperasi/pelaksanaan/'.$request->input('parent_id').'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }
    }

    public function editDetail(Request $request)
    {
        $id = $request->input('id');
        $tanggal = Carbon::createFromFormat('d-m-Y', $request->input('tanggal'))->format('Y-m-d') ;
        $ruangan = $request->input('ruangan');
        $ronde = $request->input('ronde');
        $dokter = $request->input('dokter');
        //dd($request->all());

        $transaksi = Transaksi::find($id);
        $transaksi->doctor_id = $dokter;
        $transaksi->ruangan_id = $ruangan;
        $transaksi->jadwal_operasi = $tanggal;
        $transaksi->nomor_ronde = $ronde;
        $transaksi->save();

        $status = 1;
        $message = 'Pengaturan Ulang Berhasil!';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/pelaksanaan/'.$id)
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function batalOperasi(Request $request)
    {
        //dd($request);
        $transaksi = Transaksi::find($request->id);
        $transaksi->alasan_batal = $request->alasan_batal;
        $transaksi->deleted_by = Auth::user()->id;
        $transaksi->save();
        $transaksi->delete();

        $status = 1;
        $message = 'Permintaan Berhasil Dihapus!';
        $title = 'Berhasil!';

        return redirect('kamaroperasi/jadwal')
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function gantiDiagnosis(Request $request)
    {
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();
        try {
            $id = $request->input('id');
            $transaksi = Transaksi::find($id);
            $transaksi->diagnosis_id = $request->input('id-diagnosis');
            $transaksi->diagnosis = ICD10::find($request->input('id-diagnosis'))->code_icd.' - '.ICD10::find($request->input('id-diagnosis'))->long_desc;
            $transaksi->save();

            $status = 1;
            $message = 'Berhasil mengganti diagnosis!';
            $title = 'Berhasil!';
            $connection->commit();
            return redirect('kamaroperasi/pelaksanaan/'.$id.'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!';
            dd($e->getMessage());
            return redirect('kamaroperasi/pelaksanaan/'.$id.'#pengaturan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }

    }

}