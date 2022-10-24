<?php

namespace App\Http\Controllers\Admin\PengaturanFitur\Features\ThirdParty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class InitController extends Controller
{
    public function sirs_v3()
    {
		if (config('medify.third-party.sirs_v3.on')) {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/features/2022-02/sirs-v3/',
            ]);
    
            sleep(1);
        }
    }
}
