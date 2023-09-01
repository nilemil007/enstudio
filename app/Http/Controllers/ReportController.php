<?php

namespace App\Http\Controllers;

use App\Http\Traits\Settings;
use App\Models\Rso;
use App\Models\DdHouse;
use App\Models\Setting;
use App\Models\Retailer;
use App\Models\KpiTarget;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Activation\CoreActivation;

class ReportController extends Controller
{
    use Settings;

    // Core Activation Summary
    public function coreActivationSummary(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $retailerId = CoreActivation::whereNotNull('retailer_id')->pluck('retailer_id');
        $retailerCode = Retailer::select('id','code')->groupBy('code')
            ->where('sim_seller','Y')
            ->whereIn('id', $retailerId)
            ->paginate(10);
        return view('modules.report.activation.summary', compact('retailerCode'));
    }

    // GA Target vs Achievement
    public function ga(Request $request): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
    {

//        $sumOfTotalActivation = CoreActivation::getTotalActivationByHouse();
        $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse();
        $firstDayofCurrentMonth = Carbon::now()->startOfMonth();
        $lastDayofCurrentMonth = Carbon::now();
        $restOfDay = Carbon::now()->daysInMonth - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);
        $spRestOfDay = $this->getSettings()->shera_partner_day - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);
        $tableData = '';

        if($request->ajax())
        {
            $house = DdHouse::firstWhere('id', $request->input('id'))->id;
            $totalActivation = CoreActivation::getTotalActivationByHouse( $house );
            $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse();

            $rsos = Rso::with(['coreActivation' => function($query) use ($request){
                $drc = !empty($this->getSettings()->drc_code) && !empty($this->getSettings()->exclude_from_rso_act) ? Setting::getDrcCode() : [];
                $query->whereIn('product_code', $this->getSettings()->product_code)
                    ->whereNotIn('retailer_id', $drc)
                    ->where('dd_house_id', $request->input('id'));
            },'kpiTarget'])->groupBy('itop_number')->where('dd_house_id', $request->id)->where('status', 1)->get();

            foreach($rsos as $sl => $rso)
            {
                $tableData.= '<tr>'.
                    '<td>'. ++$sl .'</td>'.
                    '<td>'. $rso->ddHouse->code .'</td>'. // DD Code
                    '<td>'. $rso->itop_number .'</td>'.
                    // Monthly Target vs Achievement
                    '<td>'. round(($rso->kpiTarget->ga ?? 0)) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() ?? 0) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() / ($rso->kpiTarget->ga ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() .'</td>'.
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.
                    // Shera Partner Target vs Achievement
                    // Target [Shera Partner]
                    '<td>'. round(($rso->kpiTarget->ga ?? 0) * $this->getSettings()->shera_partner_percentage / 100) .'</td>'.
                    // Achievement [Shera Partner]
                    '<td>'. ($rso->coreActivation->count() ?? 0) .'</td>'.
                    // Achievement % [Shera Partner]
                    '<td>'. round(($rso->coreActivation->count() ?? 0) / round(($rso->kpiTarget->ga * $this->getSettings()->shera_partner_percentage / 100)) * 100) . '%' .'</td>'.
                    // Remaining [Shera Partner]
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) * $this->getSettings()->shera_partner_percentage / 100 ?? 0) - $rso->coreActivation->count()) .'</td>'.
                    // Daily Required [Shera Partner]
                    '<td>'. round(round((($rso->kpiTarget->ga ?? 0) * $this->getSettings()->shera_partner_percentage / 100 ?? 0) - $rso->coreActivation->count()) / $spRestOfDay) .'</td>'.
                    '</tr>';
            }

//            $tableData.= '<tr style="font-weight: bold">'.
//                // Monthly Target vs Achievement
//                // Grand Total
//                '<td colspan="3">Grand Total</td>'.
//                // GA Target
//                '<td>'. round($sumOfTotalTarget ?? 0) .'</td>'.
//                // Achievement
//                '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.
//                // Achievement %
//                '<td>'. round($sumOfTotalActivation / ($sumOfTotalTarget ?? 0) * 100) . '%' .'</td>'.
//                // Remaining
//                '<td>'. round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation .'</td>'.
//                // Daily Required
//                '<td>'. round((($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
//                // Shera Partner Target vs Achievement
//                // GA Target [Shera Partner]
//                '<td>'. round($sumOfTotalActivation * 30 / 100) .'</td>'.
//                // Achievement [Shera Partner]
//                '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.
//                // Achievement % [Shera Partner]
//                '<td>'. round(($sumOfTotalActivation ?? 0) / (($sumOfTotalTarget ?? 0) * 30 / 100) * 100) . '%' .'</td>'.
//                // Remaining [Shera Partner]
//                '<td>'. round((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) .'</td>'.
//                // Daily Required [Shera Partner]
//                '<td>'. round(((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
//                '</tr>';

            return response()->json(['data' => $tableData]);
        }

        return view('modules.report.activation.ga', [
            'ddHouses'  => DdHouse::get(),
            'setting'   => $this->getSettings(),
        ]);
    }
}
