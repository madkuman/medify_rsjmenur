<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RujukBalik;
use Carbon\Carbon;
use stdClass;
use Yajra\DataTables\DataTables;

class ReadController extends Controller
{
    public function getData(Request $request)
    {
        $start = Carbon::createFromFormat('m/d/Y', $request->date_start)->startOfDay();
        $end = Carbon::createFromFormat('m/d/Y', $request->date_end)->endOfDay();

        if($request->source == "bpjs"){
            $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\ReadController::class)->getSRBbyTanggal($request);
            $content_data = json_decode($content);
            
            $query = collect();
            foreach($content_data->response->prb->list as $srb){
                $data = new stdClass;
                $data->no_sep = $srb->noSEP;
                $data->no_kartu = $srb->peserta->noKartu;
                $data->no_surat_rujuk_balik = $srb->noSRB;
                $data->kode_program_prb = $srb->programPRB->kode;
                $data->program_prb = $srb->programPRB->nama;
                $data->kode_dpjp = $srb->DPJP->kode;
                $data->dpjp = $srb->DPJP->nama;
                $data->alamat_peserta = $srb->peserta->alamat;
                $data->nama_peserta = $srb->peserta->nama;
                $data->email_peserta = $srb->peserta->email;
                $data->keterangan = $srb->keterangan;
                $data->saran = $srb->saran;
                $data->tanggal_surat_rujuk_balik = $srb->tglSRB;
                $data->status_vclaim = 1;

                $query->push($data);
            }
            

        }else{
            $query = RujukBalik::with('pasien')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('tanggal_surat_rujuk_balik', [$start, $end]);
                $query->orWhereNull('tanggal_surat_rujuk_balik');
            });
        }

            

        return DataTables::of($query)
            ->addColumn('tanggal_surat_rujuk_balik_format', function ($row) {
                if ($row->tanggal_surat_rujuk_balik == null) return "";
                return indonesian_date($row->tanggal_surat_rujuk_balik);
            })
            ->addIndexColumn()->escapeColumns([])
            ->make(true);
    }

    public function getDetail(Request $request)
    {
        if ($request->noSrb) {
            $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\ReadController::class)->getSRBbyNomor(request()->merge([
                'no_srb' => $request->noSrb,
            ]));
            return $content;
        } else {
            $data = RujukBalik::with('pasien', 'detail')
                ->where('id', $request->id)
                ->first();

            $obat['obat'] = [];
            foreach ($data->detail as $item) {
                $obat[] = [
                    'jmlObat' => $item->jumlah,
                    'kdObat' => $item->kode_obat,
                    'nmObat' => $item->nama_obat,
                    'signa1' => $item->signa1,
                    'signa2' => $item->signa2,
                ];
            }

            return response()->json([
                'metaData' => [
                    'code' => 200,
                    'message' => "Berhasil",
                ],
                'response' => [
                    'data' => $data,
                    'prb' => [
                        'DPJP' => [
                            'kode' => $data->kode_dpjp,
                            'nama' => $data->dpjp,
                        ],
                        'noSEP' => $data->no_sep,
                        'noSRB' => $data->no_surat_rujuk_balik,
                        'keterangan' => $data->keterangan,
                        'saran' => $data->saran,
                        'tglSRB' => $data->tanggal_surat_rujuk_balik,
                        'obat' => $obat,
                        'peserta' => [
                            'nama' => $data->nama_peserta,
                            'alamat' => $data->alamat_peserta,
                            'noKartu' => $data->no_kartu,
                            'email' => $data->dpjp,
                        ],
                        'programPRB' => [
                            'kode' => $data->kode_program_prb,
                            'nama' => $data->program_prb,
                        ],
                    ]
                ],
            ]);
        }
    }

    public function single($id, $eager = [])
    {
        return RujukBalik::with([])->where('id', $id)->first();
    }

    public function singleFromApi($noSrb)
    {
        if (strpos('srb-', $noSrb) !== false) {
            $noSrb = $noSrb;
        } else {
            $noSrb = substr($noSrb, 4, strlen($noSrb));
        }
        $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\ReadController::class)->getSRBbyNomor(request()->merge([
            'no_srb' => $noSrb,
        ]));
        return $content;
    }
}
