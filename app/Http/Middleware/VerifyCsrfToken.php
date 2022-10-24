<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'radiologi/api/*',
        'labpk/api/*',
        'pasien/api/*',
        'api/pasien/*',
        'third-party-medify-online/*',
        'mobile-bpjs/*',
        'rawatjalan/video/penunjang',
        'jkn/*'
    ];
}
