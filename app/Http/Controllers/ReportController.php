<?php

namespace App\Http\Controllers;

use App\Models\Rso;
use App\Models\DdHouse;
use App\Models\Setting;
use App\Models\Retailer;
use App\Models\KpiTarget;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Activation\CoreActivation;

class ReportController extends Controller
{
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
    public function ga(Request $request)
    {
        $sumOfTotalActivation = CoreActivation::getTotalActivatonByHouse();
        $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse();

        $firstDayofCurrentMonth = \Carbon\Carbon::now()->startOfMonth();
        $lastDayofCurrentMonth = \Carbon\Carbon::now();
        $restOfDay = \Carbon\Carbon::now()->daysInMonth - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);

        $query = Rso::query();
        $dd = DdHouse::query();

        $tableData = '';

        $rsos = $query->with(['coreActivation' => function($query){

            $setting = Setting::where('user_id', Auth::id())->first();
            $retailerId = !empty($setting->drc_code) && !empty($setting->exclude_from_core_act) ? Setting::getDrc() : [];

            $query->whereIn('product_code', $setting->product_code)->whereNotIn('retailer_id', $retailerId);
        },'kpiTarget'])->groupBy('itop_number')->where('status', 1)->get();

        if($request->ajax())
        {
            switch($request->id)
            {
                case 'all':
                foreach($rsos as $sl => $rso)
                {
                    $tableData.= '<tr>'.
                    '<td>'. ++$sl .'</td>'.                                                                                                      // Serial Number
                    '<td>'. $rso->ddHouse->code .'</td>'.                                                                                        // DD Code
                    '<td>'. $rso->itop_number .'</td>'.                                                                                          // Rso Itop Number
                    '<td>'. round($rso->kpiTarget->ga ?? 0) .'</td>'.                                                                       // GA Target
                    '<td>'. round($rso->coreActivation->count() ?? 0) .'</td>'.                                                             // Achievement
                    '<td>'. round(($rso->coreActivation->count() ?? 0) / ($rso->kpiTarget->ga ?? 0) * 100) . '%' .'</td>'.                  // Achievement %
                    '<td>'. round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() .'</td>'.                                       // Remaining
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.                      // Daily Required
                    '<td>'. round(($rso->kpiTarget->ga ?? 0) * 30 / 100) .'</td>'.                                                          // GA Target [Shera Partner]
                    '<td>'. round($rso->coreActivation->count() ?? 0) .'</td>'.                                                             // Achievement [Shera Partner]
                    '<td>'. round($rso->coreActivation->count() ?? 0 / (($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) * 100) . '%' .'</td>'.  // Achievement % [Shera Partner]
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) .'</td>'.                   // Remaining [Shera Partner]
                    '<td>'. round(((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.    // Daily Required [Shera Partner]
                    '</tr>';
                }

                $tableData.= '<tr style="font-weight: bold">'.
                    '<td colspan="3">Grand Total</td>'.
                    '<td>'. round($sumOfTotalTarget ?? 0) .'</td>'.
                    '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.
                    '<td>'. round(($sumOfTotalActivation ?? 0) / ($sumOfTotalTarget ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round(($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) .'</td>'.
                    '<td>'. round((($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
                    '<td>'. round(($sumOfTotalTarget ?? 0) * 30 / 100) .'</td>'.
                    '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.
                    '<td>'. round(($sumOfTotalActivation ?? 0) / (($sumOfTotalTarget ?? 0) * 30 / 100) * 100) . '%' .'</td>'.
                    '<td>'. round((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) .'</td>'.
                    '<td>'. round(((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
                '</tr>';

                return response()->json(['data' => $tableData]);
                break;

                default;

                $ddCode = DdHouse::firstWhere('id', $request->id)->code;

                $sumOfTotalActivation = CoreActivation::getTotalActivatonByHouse([$ddCode]);
                $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse([$ddCode]);

                $rsos = $query->with(['coreActivation' => function($query){

                    $setting = Setting::where('user_id', Auth::id())->first();
                    $retailerId = !empty($setting->drc_code) && !empty($setting->exclude_from_core_act) ? Setting::getDrc() : [];

                    $query->whereIn('product_code', $setting->product_code)->whereNotIn('retailer_id', $retailerId);
                },'kpiTarget'])->groupBy('itop_number')->where('dd_house_id', $request->id)->where('status', 1)->get();

                foreach($rsos as $sl => $rso)
                {
                    $tableData.= '<tr>'.
                    '<td>'. ++$sl .'</td>'.
                    '<td>'. $rso->ddHouse->code .'</td>'. // DD Code
                    '<td>'. $rso->itop_number .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() ?? 0) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() / ($rso->kpiTarget->ga ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() .'</td>'.
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.
                    '<td>'. round(($rso->kpiTarget->ga ?? 0) * 30 / 100) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() ?? 0) .'</td>'.
                    '<td>'. round($rso->coreActivation->count() ?? 0 / (($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) .'</td>'.
                    '<td>'. round(((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.
                    '</tr>';
                }

                $tableData.= '<tr style="font-weight: bold">'.
                    '<td colspan="3">Grand Total</td>'.                                                                              // Grand Total
                    '<td>'. round($sumOfTotalTarget ?? 0) .'</td>'.                                                             // GA Target
                    '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.                                                         // Achievement
                    '<td>'. round($sumOfTotalActivation / ($sumOfTotalTarget ?? 0) * 100) . '%' .'</td>'.                       // Ach %
                    '<td>'. round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation .'</td>'.                                     // Remaining
                    '<td>'. round((($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay) .'</td>'.                    // Daily Required
                    '<td>'. round($sumOfTotalActivation * 30 / 100) .'</td>'.                                                   // GA Target [Shera Partner]
                    '<td>'. round($sumOfTotalActivation ?? 0) .'</td>'.                                                         // Achievement [Shera Partner]
                    '<td>'. round(($sumOfTotalActivation ?? 0) / (($sumOfTotalTarget ?? 0) * 30 / 100) * 100) . '%' .'</td>'.   // Ach % [Shera Partner]
                    '<td>'. round((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) .'</td>'.                      // Remaining [Shera Partner]
                    '<td>'. round(((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) / $restOfDay) .'</td>'.       // Daily Required [Shera Partner]
                '</tr>';

                return response()->json(['data' => $tableData]);
            }
        }

        return view('modules.report.activation.ga', [
            'ddHouses'              => $dd->get(),
            'rsos'                  => $rsos,
            'sumOfTotalTarget'      => round($sumOfTotalTarget ?? 0),
            'sumOfTotalActivation'  => round($sumOfTotalActivation),
            'achPercent'            => round(($sumOfTotalActivation ?? 0) / ($sumOfTotalTarget ?? 0) * 100) . '%',
            'remaining'             => round(($sumOfTotalTarget ?? 0) - $sumOfTotalActivation),
            'dailyRequired'         => round((($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay),
            'spGaTarget'            => round(($sumOfTotalTarget ?? 0) * 30 / 100),
            'spAchPercent'          => round(($sumOfTotalActivation ?? 0) / (($sumOfTotalTarget ?? 0) * 30 / 100) * 100) . '%',
            'spRemaining'           => round((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation),
            'spDailyRequired'       => round(((($sumOfTotalTarget ?? 0) * 30 / 100) - $sumOfTotalActivation) / $restOfDay),
            'restOfDay'             => $restOfDay,
        ]);
    }
}
