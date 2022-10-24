<?php

use App\Models\Hospital\MasterLaporan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'nama' => 'DKK 34 Laporan Bulanan Diare',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-34-laporan-bulanan-diare',
        ];
        $data[] = [
            'nama' => 'DKK @ 7. Laporan Bulanan Katarak',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-7-laporan-bulanan-katarak',
        ];
        $data[] = [
            'nama' => 'DKK 33. Laporan Bulanan ISPA',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-33-laporan-bulanan-ispa',
        ];
        $data[] = [
            'nama' => 'DKK - 19. Laporan Bulanan Kematian RS',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-19-laporan-bulanan-kematian-rs',
        ];
        $data[] = [
            'nama' => 'DKK - 22. Laporan Bulanan STP Rawat Jalan',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-22-laporan-bulanan-stp-rawat-jalan',
        ];
        $data[] = [
            'nama' => 'DKK - 23. Laporan Bulanan STP Rawat Inap',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-23-laporan-bulanan-stp-rawat-inap',
        ];
        $data[] = [
            'nama' => 'DKK - 18. Laporan Bulanan Pelayanan Geriatri',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-18-laporan-bulanan-pelayanan-geriatri',
        ];
        $data[] = [
            'nama' => 'DKK - 5. Laporan Bulanan Kunjungan Rawat Jalan Penderita Baru & Lama P2PTM & Keswa',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa',
        ];
        $data[] = [
            'nama' => 'DKK - 11. Laporan Bulanan Persalinan',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-11-laporan-bulanan-persalinan',
        ];
        $data[] = [
            'nama' => 'DKK - 15. Laporan Bulanan Lahir Mati',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-15-laporan-bulanan-lahir-mati',
        ];
        $data[] = [
            'nama' => 'DKK - 10. Laporan Bulanan Kematian Ibu',
            'tags' => 'DKK',
            'departemen_id' => 14,
            'url' => 'pasien/laporan-v2/page/dkk-10-laporan-bulanan-kematian-ibu',
        ];

        
        foreach($data as $item){
            if(MasterLaporan::where('nama',$item['nama'])->count() != 0) continue;
            DB::connection('mysql')->table('master_laporan')->insert($item);
        }
    }
}
