<?php

namespace App\Http\Controllers\ProcessQueue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\ProcessQueue;

class MainController extends Controller
{
    public function make($slug, $payload)
    {
        $process_queue = ProcessQueue::where('slug', $slug)->first();
        if ($process_queue == null) {
            $process_queue = new ProcessQueue;
            $process_queue->slug = $slug;
        }
        $process_queue->payload = json_encode($payload);
        $process_queue->expired_at = now()->addMinutes($this->calculateExpired($slug));
        $process_queue->save();
    }

    public function check($slug)
    {
        return ProcessQueue::where('slug', $slug)->where('expired_at', '>=', now()->toDateTimeString())->first() == null;
    }

    public function remove($slug)
    {
        ProcessQueue::where('slug', $slug)->update([
            'expired_at' => now()->subMinute()->toDateTimeString(),
        ]);
    }

    private function calculateExpired($slug)
    {
        #nilai expired dalam satuan menit
        $expired_minute = [
            'import-hfis' => 2,
        ];
        return $expired_minute[$slug] ?? 1; #default 1 menit
    }
}
