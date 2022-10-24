<?php

namespace App\Http\Middleware;

use Closure;
use File;
use Auth;

class RequestTimeLogger
{
    private $startTime;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);
        return $next($request);
    }
    public function terminate($request, $response)
    {
        if ( env('TIME_LOGGER', true) ) {
            $endTime = microtime(true);
            $filename = 'timelogger_' . date('d-m-y') . '.log';
            
            //LARAVEL
            // if(!File::exists(storage_path('logs' . DIRECTORY_SEPARATOR . $filename)))   //Cek udh ada file belom
            //     File::append( storage_path('logs' . DIRECTORY_SEPARATOR . $filename), "Time;Duration;IP Address;URL;Method;");

            //PHP NATIVE
            if(!file_exists(storage_path('logs' . DIRECTORY_SEPARATOR . $filename)))   //Cek udh ada file belom                         
                file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), "Time;Duration;IP Address;URL;Method;User;Input".PHP_EOL , FILE_APPEND | LOCK_EX);

            $dataToLog  = date("F j, Y, g:i a") . ";";
            $dataToLog .= number_format($endTime - LARAVEL_START, 3) . ";";
            $dataToLog .= $request->ip() . ";";
            $dataToLog .= $request->fullUrl() . ";";
            $dataToLog .= $request->method() . ";";
            if(Auth::user())
                $dataToLog .= Auth::user()->name . ";";
            else
                $dataToLog .= "Guest;";
            $dataToLog .= json_encode($request->all());

            file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog.PHP_EOL , FILE_APPEND | LOCK_EX);      //PHP NATIVE
            // File::append( storage_path('logs' . DIRECTORY_SEPARATOR . $filename), PHP_EOL.$dataToLog);           //LARAVEL
     }
 }

}
