<?php

namespace App\Exports;

use App\Models\Activation\HouseCodeActivation;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HouseCodeActivationLastMonthExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();

        return view('exports.hca_last_month', [
            'houseCodeAct' => HouseCodeActivation::whereBetween('activation_date', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])->get()
        ]);
    }
}
