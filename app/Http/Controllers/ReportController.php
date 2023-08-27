<?php

namespace App\Http\Controllers;

use App\Models\Activation\CoreActivation;
use App\Models\DdHouse;
use App\Models\KpiTarget;
use App\Models\Retailer;
use App\Models\Rso;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $sumOfTotalActivation = CoreActivation::getTotalActivatonByHouse(['MYMVAI01','MYMVAI02','MYMVAI03']);
        $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse(['MYMVAI01','MYMVAI02','MYMVAI03']);

        $firstDayofCurrentMonth = \Carbon\Carbon::now()->startOfMonth();
        $lastDayofCurrentMonth = \Carbon\Carbon::now();
        $restOfDay = \Carbon\Carbon::now()->daysInMonth - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);

        $query = Rso::query();
        $dd = DdHouse::query();

        $tableData = '';

        $rsos = $query->with(['coreActivation' => function($query){
            $query->whereIn('product_code',['MMST','MMSTS']);
        },'kpiTarget'])->groupBy('itop_number')->where('status', 1)->get();

        if($request->ajax())
        {
            switch($request->id)
            {
                case 'all':
                foreach($rsos as $sl => $rso)
                {
                    $tableData.= '<tr>'.
                    '<td>'. ++$sl .'</td>'.
                    '<td>'. $rso->ddHouse->code .'</td>'.
                    '<td>'. $rso->itop_number .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) .'</td>'.
                    '<td>'. $rso->coreActivation->count() .'</td>'.
                    '<td>'. round($rso->coreActivation->count() / round($rso->kpiTarget->ga ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() .'</td>'.
                    '<td>'. round((round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga * 30 / 100 ?? 0) .'</td>'.
                    '</tr>';
                }

                $tableData.= '<tr style="font-weight: bold">'.
                    '<td colspan="3">Grand Total</td>'.
                    '<td>'. round($sumOfTotalTarget ?? 0) .'</td>'.
                    '<td>'. $sumOfTotalActivation .'</td>'.
                    '<td>'. round($sumOfTotalActivation / round($sumOfTotalTarget ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation .'</td>'.
                    '<td>'. round((round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
                    '<td>'. round($sumOfTotalActivation * 30 / 100) .'</td>'.
                '</tr>';

                return response()->json(['data' => $tableData]);
                break;

                default;

                $ddCode = DdHouse::firstWhere('id', $request->id)->code;

                $sumOfTotalActivation = CoreActivation::getTotalActivatonByHouse([$ddCode]);
                $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse([$ddCode]);

                $rsos = $query->with(['coreActivation' => function($query){
                    $query->whereIn('product_code',['MMST','MMSTS']);
                },'kpiTarget'])->groupBy('itop_number')->where('dd_house_id', $request->id)->where('status', 1)->get();

                foreach($rsos as $sl => $rso)
                {
                    $tableData.= '<tr>'.
                    '<td>'. ++$sl .'</td>'.
                    '<td>'. $rso->ddHouse->code .'</td>'.
                    '<td>'. $rso->itop_number .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) .'</td>'.
                    '<td>'. $rso->coreActivation->count() .'</td>'.
                    '<td>'. round($rso->coreActivation->count() / round($rso->kpiTarget->ga ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() .'</td>'.
                    '<td>'. round((round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) .'</td>'.
                    '<td>'. round($rso->kpiTarget->ga * 30 / 100 ?? 0) .'</td>'.
                    '</tr>';
                }

                $tableData.= '<tr style="font-weight: bold">'.
                    '<td colspan="3">Grand Total</td>'.
                    '<td>'. round($sumOfTotalTarget ?? 0) .'</td>'.
                    '<td>'. $sumOfTotalActivation .'</td>'.
                    '<td>'. round($sumOfTotalActivation / round($sumOfTotalTarget ?? 0) * 100) . '%' .'</td>'.
                    '<td>'. round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation .'</td>'.
                    '<td>'. round((round($sumOfTotalTarget ?? 0) - $sumOfTotalActivation) / $restOfDay) .'</td>'.
                    '<td>'. round($sumOfTotalActivation * 30 / 100) .'</td>'.
                '</tr>';

                return response()->json(['data' => $tableData]);
            }
        }

        return view('modules.report.activation.ga', [
            'ddHouses'              => $dd->get(),
            'rsos'                  => $rsos,
            'sumOfTotalActivation'  => $sumOfTotalActivation,
            'sumOfTotalTarget'      => $sumOfTotalTarget,
            'restOfDay'             => $restOfDay,
        ]);
    }
}
