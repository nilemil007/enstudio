<?php

namespace App\Http\Controllers;

use App\Http\Traits\Settings;
use App\Models\Rso;
use App\Models\DdHouse;
use App\Models\Setting;
use App\Models\Retailer;
use App\Models\KpiTarget;
use App\Models\Supervisor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Activation\CoreActivation;
use Illuminate\Support\Facades\Response;

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

    public function getRso($id): JsonResponse
    {
        return Response::json(['rso' => Rso::where('dd_house_id',$id)->where('status', 1)->get()]);
    }

    public function getSupervisorAndUser($id): JsonResponse
    {
        return Response::json([
            'supervisor' => Supervisor::where('dd_house_id',$id)->where('status', 1)->get(),
            'user' => User::where('dd_house', $id)->where('role', 'rso')->where('status', 1)->get(),
        ]);
    }

    // GA Target vs Achievement
    public function ga(Request $request)
    {
        $ddHouses = DdHouse::get();
        $setting = $this->getSettings();
//        $rsos = Rso::with(['coreActivation' => function($query) use ($request){
//            $drc = !empty($this->getSettings()->drc_code) && !empty($this->getSettings()->exclude_from_rso_act) ? Setting::getDrcCode() : [];
//            $query->whereIn('product_code', $this->getSettings()->product_code)
//                ->whereNotIn('retailer_id', $drc)
//                ->where('dd_house_id', $request->input('houseId'));
//        },'kpiTarget'])->when($request->input('houseId'), function ($query, $id){
//            $query->where('dd_house_id', $id);
//        })->paginate(10);

//        $totalTarget = KpiTarget::getTotalTargetByHouse( $request->input('houseId') );
//
//        $rsos = Rso::with(['coreActivation' => function($query) use ($request){
//            $drc = !empty($this->getSettings()->drc_code) && !empty($this->getSettings()->exclude_from_rso_act) ? Setting::getDrcCode() : [];
//            $query->whereIn('product_code', $this->getSettings()->product_code)
//                ->whereNotIn('retailer_id', $drc)
//                ->where('dd_house_id', $request->input('findByHouse'));
//        },'kpiTarget'])->groupBy('itop_number')->where('dd_house_id', $request->id)->where('status', 1)->get();
//
//        return view('modules.report.activation.ga', compact('rsos', ['setting','ddHouses']));

        if($request->ajax())
        {
            dd($request->startDate.' | '.$request->endDate.' | '.$request->houseId.' | '.$request->get_rso);

            $tableData = '';
            $firstDayofCurrentMonth = Carbon::now()->startOfMonth();
            $lastDayofCurrentMonth = Carbon::now();
            $restOfDay = Carbon::now()->daysInMonth - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);
            $spRestOfDay = $this->getSettings()->shera_partner_day - $firstDayofCurrentMonth->diffInDays($lastDayofCurrentMonth);

            // Total target by selected dd house.
            $totalTarget = KpiTarget::getTotalTargetByHouse( $request->input('id') );
            // Total activation by selected dd house.
            $totalActivation = CoreActivation::getTotalActivationByHouse( $request->input('id') );
            // Achievement %
            $achPercent = round($totalActivation / $totalTarget * 100) . '%';
            // Remaining
            $remaining = $totalTarget - $totalActivation;
            // Daily Required
            $dailyRequired = round($remaining / $restOfDay);
            // Shera Partner Target vs Achievement
            // GA Target [Shera Partner]
            $spTarget = round($totalTarget * $this->getSettings()->shera_partner_percentage / 100);
            // Achievement % [Shera Partner]
            $spAchPercent = round( $totalActivation / $spTarget * 100 ) . '%';
            // Remaining [Shera Partner]
            $spRemaining = $spTarget - $totalActivation;
            // Daily Required [Shera Partner]
            $spDailyRequired = round( $spRemaining / $spRestOfDay );

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
                    // DD Code
                    '<td>'. $rso->ddHouse->code .'</td>'.
                    // RSO ItopUp Number
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

            $tableData.= '<tr style="font-weight: bold">'.
                // Monthly Target vs Achievement
                // Grand Total
                '<td colspan="3">Grand Total</td>'.
                // GA Target
                '<td>'. ($totalTarget ?? 0) .'</td>'.
                // Achievement
                '<td>'. ($totalActivation ?? 0) .'</td>'.
                // Achievement %
                '<td>'. $achPercent .'</td>'.
                // Remaining
                '<td>'. $remaining .'</td>'.
                // Daily Required
                '<td>'. $dailyRequired .'</td>'.
                // Shera Partner Target vs Achievement
                // GA Target [Shera Partner]
                '<td>'. $spTarget .'</td>'.
                // Achievement [Shera Partner]
                '<td>'. ($totalActivation ?? 0) .'</td>'.
                // Achievement % [Shera Partner]
                '<td>'. $spAchPercent .'</td>'.
                // Remaining [Shera Partner]
                '<td>'. $spRemaining .'</td>'.
                // Daily Required [Shera Partner]
                '<td>'. $spDailyRequired .'</td>'.
                '</tr>';

            return response()->json(['data' => $tableData]);
        }

        return view('modules.report.activation.ga', compact('setting','ddHouses'));
    }
}
