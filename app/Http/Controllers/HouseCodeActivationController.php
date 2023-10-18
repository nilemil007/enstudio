<?php

namespace App\Http\Controllers;

use App\Exports\HouseCodeActivationExport;
use App\Exports\HouseCodeActivationLastMonthExport;
use App\Http\Requests\HCAStoreRequest;
use App\Http\Requests\HCAUpdateRequest;
use App\Models\Activation\HouseCodeActivation;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\Supervisor;
use App\Models\TradeCampaignRetailerCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HouseCodeActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        switch ( Auth::user()->role )
        {
            case ('supervisor');
                $usersId = User::where('dd_house', Auth::user()->dd_house)->pluck('id');
                $houseCodeAct = HouseCodeActivation::where('activation_date', Carbon::now()->toDateString())->whereIn('user_id', $usersId)->paginate(5);
            break;

            case ('bp'):
            case ('tmo'):
            case ('rso');
                $houseCodeAct = HouseCodeActivation::where('user_id', Auth::id())->where('activation_date', Carbon::now()->toDateString())->paginate(5);
            break;

            default;
                $houseCodeAct = HouseCodeActivation::latest()->paginate(5);
        }

        return view('modules.house_code_activation.index', compact('houseCodeAct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        switch ( Auth::user()->role )
        {
            case('supervisor');
                $poolNumber = Supervisor::firstWhere('user_id', Auth::id())->pool_number;
                $retId = TradeCampaignRetailerCode::whereNotNull('retailer_id')->pluck('retailer_id');
                $retailers = Retailer::where('supervisor', $poolNumber)->whereIn('id', $retId)->get();
                $users = User::where('dd_house', Auth::user()->dd_house)->get();
            break;

            case('rso');
                $rsoId = Rso::firstWhere('user_id', Auth::id())->id;
                $retId = TradeCampaignRetailerCode::whereNotNull('retailer_id')->pluck('retailer_id');
                $retailers = Retailer::where('rso_id', $rsoId)->whereIn('id', $retId)->get();
                $users = User::where('dd_house', Auth::user()->dd_house)->get();
            break;

            default;
                $retCode = TradeCampaignRetailerCode::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('retailer_code')->pluck('retailer_code');
                $userId = TradeCampaignRetailerCode::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('user_id')->pluck('user_id');
                $retailers = Retailer::whereIn('code', $retCode)->get();
                $users = User::with('rso')->where('role', '!=', 'zm')
                    ->where('role', '!=', 'manager')
                    ->where('role', '!=', 'md')
                    ->where('role', '!=', 'supervisor')
                    ->where('role', '!=', 'retailer')
                    ->where('role', '!=', 'accountant')
                    ->where('role', '!=', 'superadmin')
                    ->whereIn('id', $userId)
                    ->get();
//                dd($users);
        }

        return view('modules.house_code_activation.create', compact('retailers','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HCAStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {

            $data['dd_house'] = Retailer::firstWhere('code', $request->retailer_code)->dd_house_id;
            HouseCodeActivation::create($data);
            return Response::json(['success' => 'New record created successfully.']);

        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseCodeActivation $houseCodeActivation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HouseCodeActivation $hca): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        $retailers = Retailer::all();
        return view('modules.house_code_activation.edit', compact('hca','users','retailers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HCAUpdateRequest $request, HouseCodeActivation $hca): JsonResponse
    {
        $data = $request->validated();

        try {

            $data['dd_house'] = Retailer::firstWhere('code', $request->retailer_code)->dd_house_id;
            $hca->update($data);
            return Response::json(['success' => 'Record updated successfully.']);

        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseCodeActivation $hca): JsonResponse
    {
        try {
            $hca->delete();
            return response()->json(['success' => 'The record has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all house code activation.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            HouseCodeActivation::truncate();
            return response()->json(['success' => 'All record has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * house code activation summary.
     */
    public function summary(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $sum = HouseCodeActivation::getSumOfCurrentMonth();
        $prices = HouseCodeActivation::getPriceOfCurrentMonth();

        return view('modules.house_code_activation.summary', compact('sum','prices'));
    }

    /**
     * house code activation LMTD.
     */
    public function lmtd(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $sum = HouseCodeActivation::getSumOfPreviousMonth();
        $prices = HouseCodeActivation::getPriceOfPreviousMonth();

        return view('modules.house_code_activation.lmtd', compact('sum','prices'));
    }

    /**
     * house code activation export.
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new HouseCodeActivationExport, 'House Code Activation.xlsx');
    }

    /**
     * house code activation last month export.
     */
    public function exportLastMonth(): BinaryFileResponse
    {
        return Excel::download(new HouseCodeActivationLastMonthExport(), 'House Code Activation.xlsx');
    }
}
