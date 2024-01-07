<?php

namespace App\Exports;

use App\Models\Activation\HouseCodeActivation;
use App\Models\Retailer;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class RetailersExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $ddHouseId = DB::table('dd_house_user')->where('user_id', Auth::id())->pluck('dd_house_id');

        return view('exports.retailers', [
            'retailers' => Retailer::whereIn('dd_house_id', $ddHouseId)->get()
        ]);
    }
}
