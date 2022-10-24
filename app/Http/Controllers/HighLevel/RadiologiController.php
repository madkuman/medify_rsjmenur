<?php

namespace App\Http\Controllers\HighLevel;

use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Keuangan\Tarif;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Radiology\TransactionDetail;

class RadiologiController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $transaction_and_kasus = $this->getTransaksiandKasus();

        $data = [
            'pasienHarian' => self::getPasienHarian($today),
            'pasienBulanan' => self::getPasienBulanan($today),
            'tarif10Besar' => self::get10BesarTarif(),
            'distribusiAsalPasien' => self::getDistribusiAsalPasien($transaction_and_kasus),
            'distribusiJenisPasien' => self::getDistribusiJenisPasien($transaction_and_kasus)
        ];

        return view('highlevel.radiologi', $data);
    }

    public function getPasienHarian($date)
    {
        $startDate = $date->startOfWeek();
        $transactions = Transaction::where('created_at', '>=', $startDate)
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get(array(
                        DB::raw('WEEKDAY(created_at) + 1 as date'),
                        DB::raw('COUNT(*) as "pasien_count"')
                    ));

        foreach (range(1, 7) as $date) {
            $result[$date] = [
                'date' => $date,
                'pasien_count' => 0
            ];
        }

        foreach ($transactions as $transaction) {
            $result[$transaction->date] = $transaction;
        }

        return $result;
    }

    public function getPasienBulanan($date)
    {
        $startDate = $date->subMonths(11)->startOfMonth();
        $transactions = Transaction::where('created_at', '>=', $startDate)
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('COUNT(*) as "pasien_count"')
                    ));

        foreach (range(1, 12) as $month) {
            $result[$month] = [
                'month' => $month,
                'pasien_count' => 0
            ];
        }

        foreach ($transactions as $transaction) {
            $result[$transaction->month] = $transaction;
        }

        return $result;
    }

    public function get10BesarTarif()
    {
        $transactionDetails = TransactionDetail::groupBy('tarif_id')
                            ->orderBy(DB::raw('count(*)'), 'DESC')
                            ->limit(10)
                            ->get(array(
                                'tarif_id',
                                DB::raw('COUNT(*) as "transaksi_count"')
                            ));

        return $transactionDetails;
    }


    public function getDistribusiAsalPasien($transaction_and_kasus)
    {
        
        $transactions = $transaction_and_kasus['transactions'];
        $kasus = $transaction_and_kasus['kasus'];
        
        $result = array();

        foreach ($transactions as $transaction) {
            $kasus_now = $kasus->where('id', $transaction)->first();
            if (isset($kasus_now->lokasi->lokasi->departemen->nama)) {
                $department = $kasus_now->lokasi->lokasi->departemen->nama;
                $result[$department] = isset($result[$department]) ? $result[$department] + 1 : 1;
            }
        }

        return $result;
    }

    public function getDistribusiJenisPasien($transaction_and_kasus)
    {   

        $transactions = $transaction_and_kasus['transactions'];
        $kasus = $transaction_and_kasus['kasus'];
    
        foreach (range(1, 4) as $type) {
            $result[$type] = [
                'type' => $type,
                'jumlah' => 0
            ];
        }

        foreach ($transactions as $transaction) {
            $kasus_now = $kasus->where('id', $transaction)->first();

            if (isset($kasus_now->pembayaran)) {
                $type = $kasus_now->pembayaran->perusahaan->type;
                $result[$type]['jumlah']++;
            }
        }

        return $result;
    }

    public function getTransaksiandKasus()
    {
        $transactions = Transaction::pluck('kasus_id');

        $kasus = Kasus::with(['lokasi.lokasi.departemen', 'pembayaran.perusahaan'])
                      ->whereIn('id', $transactions)
                      ->get();

        $data['transactions'] = $transactions;
        $data['kasus'] = $kasus;

        return $data;
    }
}
