<?php

namespace App\Jobs;

use App\Models\ScratchCardSerial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScratchCardSerialJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $serial;

    /**
     * Create a new job instance.
     */
    public function __construct($serial)
    {
        $this->serial = $serial;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        for ($i = $this->serial['f_serial']; $i <= $this->serial['l_serial']; $i++)
        {
            $val = explode(' ', $i);
            ScratchCardSerial::create(['serial' => $val[0]]);
        }
    }
}
