<?php

namespace App\Exports;

use App\Models\Activation\HouseCodeActivation;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HouseCodeActivationExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.hca', [
            'houseCodeAct' => HouseCodeActivation::whereBetween('activation_date', [Carbon::now()->firstOfMonth(), Carbon::now()])->get()
        ]);
    }
}
