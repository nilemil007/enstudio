<?php

namespace App\Exports;

use App\Models\Activation\HouseCodeActivation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class HouseCodeActivationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return HouseCodeActivation::all();
    }
}
