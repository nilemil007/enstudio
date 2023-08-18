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

    public $fields;

    /**
     * Create a new job instance.
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        for ($i = $this->fields['f_serial']; $i <= $this->fields['l_serial']; $i++)
        {
            $scSerial = explode(' ', $i);

            ScratchCardSerial::create([
                'dd_house_id'   => $this->fields['dd_house_id'],
                'product_code'  => $this->fields['product_code'],
                'group'         => $this->fields['group'],
                'serial'        => $scSerial[0],
            ]);
        }
    }
}
