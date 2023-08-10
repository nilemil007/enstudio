<?php

namespace App\Exports;

use App\Models\Activation\HouseCodeActivation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HouseCodeActivationExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.hca', [
            'houseCodeAct' => HouseCodeActivation::all()
        ]);
    }
}
