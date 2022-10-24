<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use App\User;
use App\Models\RawatJalan\Dokter;
use Auth;

class UpdateKodeDpjp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-kode-dpjp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengisi kode_dpjp pada tabel users berdasarkan dokter di rawat jalan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dokters = Dokter::all();
        $users = User::where('profesi',1)->whereNull('fake_account')->get();

        Auth::loginUsingId(1);

        foreach($users as $user)
        {
            $score = 0;
            $dokter_dokter_match = '';
            $shortest = -1;
            $input = strtoupper($user->name);
            $input = str_replace(" ", "", $input);

            foreach ($dokters as $dokter) {

                $word = strtoupper($dokter->name);
                $word = str_replace(" ", "", $word);
                $lev = levenshtein($input, $word);

                if ($lev == 0) {

                    $closest = $word;
                    $shortest = 0;
                    $dokter_id = $dokter->id;

                    break;
                }

                if ($lev <= $shortest || $shortest < 0) {
                    $closest  = $word;
                    $dokter_id = $dokter->id;
                    $shortest = $lev;
                }
            }

            if($shortest < 17)
            {
                $user = User::find($user->id);
                $user->dokter_id = $dokter_id;
                $user->save();
            }



        }
    }
}
