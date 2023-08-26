<?php

namespace App\Http\Controllers;

use App\Models\Activation\CoreActivation;
use App\Models\KpiTarget;
use App\Models\Retailer;
use App\Models\Rso;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
    public function ga(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rsos = Rso::with(['coreActivation' => function($query){
            $query->whereIn('product_code',['MMST','MMSTS']);
        },'kpiTarget'])->groupBy('itop_number')->where('status', 1)->get();

        $sumOfTotalActivation = CoreActivation::getTotalActivatonByHouse(['MYMVAI01','MYMVAI02','MYMVAI03']);
        $sumOfTotalTarget = KpiTarget::getTotalTargetByHouse(['MYMVAI01','MYMVAI02','MYMVAI03']);

        return view('modules.report.activation.ga', compact('rsos','sumOfTotalActivation','sumOfTotalTarget'));
    }
}
