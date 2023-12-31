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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HouseCodeActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $startDate      = Carbon::now()->startOfMonth()->toDateString();
        $endDate        = Carbon::now()->endOfMonth()->toDateString();
        $search         = $request->input('search');
        $user           = $request->input('user');
        $retailerCode   = $request->input('retailer_code');
        $activation     = $request->input('activation');
        $price          = $request->input('price');
        $flag           = $request->input('flag');
        $remarks        = $request->input('remarks');

        switch ( Auth::user()->role )
        {
            case ('supervisor');
                $usersId = User::where('dd_house', Auth::user()->dd_house)->pluck('id');
                $houseCodeAct = HouseCodeActivation::where('activation_date', Carbon::now()->toDateString())->whereIn('user_id', $usersId)->paginate(5);
            break;

            case ('bp'):
            case ('tmo'):
            case ('rso');
                $houseCodeAct = HouseCodeActivation::where('user_id', Auth::id())->whereDate('activation_date', Carbon::now()->toDateString())->paginate(5);
            break;

            default;
                $tradeCampaignRetailerCode = TradeCampaignRetailerCode::whereIn('user_id', HouseCodeActivation::whereNotNull('user_id')->pluck('user_id'))->whereBetween('updated_at', [$startDate, $endDate])->get();
                $retailers = Retailer::whereIn('code', HouseCodeActivation::whereNotNull('retailer_code')->pluck('retailer_code'))->get();
                $houseCodeAct = HouseCodeActivation::latest()
//                    ->search($search)
                    ->filter(['user' => $user, 'retailer_code' => $retailerCode, 'activation' => $activation, 'price' => $price, 'flag' => $flag, 'remarks' => $remarks])
                    ->whereBetween('activation_date', [$startDate, $endDate])
                    ->paginate(5);
                $houseCodeAct->appends(['search' => $search]);
        }

        return view('modules.house_code_activation.index', compact('houseCodeAct','tradeCampaignRetailerCode','retailers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
        $tradeCampaignRetailerCode = '';

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
                $tradeCampaignRetailerCode = TradeCampaignRetailerCode::whereBetween('updated_at', [$startDate, $endDate])->get();
        }

        return view('modules.house_code_activation.create', compact('tradeCampaignRetailerCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HCAStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {

            $data['flag']       = TradeCampaignRetailerCode::firstWhere('user_id', $data['user_id'])->flag;
            $data['remarks']    = TradeCampaignRetailerCode::firstWhere('user_id', $data['user_id'])->remarks;
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
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        switch ( Auth::user()->role )
        {
            case('superadmin');
                $tradeCampaignRetailerCode = TradeCampaignRetailerCode::whereBetween('updated_at', [$startDate, $endDate])->get();
                $tcrcRetailerCode = TradeCampaignRetailerCode::whereBetween('updated_at', [$startDate, $endDate])->where('user_id', $hca->user_id)->get();
            break;

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
        }

        return view('modules.house_code_activation.edit', compact('hca','tradeCampaignRetailerCode','tcrcRetailerCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HCAUpdateRequest $request, HouseCodeActivation $hca): JsonResponse
    {
        $data = $request->validated();

        try {

            $data['flag']       = TradeCampaignRetailerCode::firstWhere('user_id', $data['user_id'])->flag;
            $data['remarks']    = TradeCampaignRetailerCode::firstWhere('user_id', $data['user_id'])->remarks;
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
        $lastUpdate = HouseCodeActivation::select('activation_date')->orderBy('activation_date','DESC')->first()->activation_date;

        return view('modules.house_code_activation.summary', compact('sum','prices','lastUpdate'));
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

    /**
     * Get retailer code by user id.
     */
    public function getRetailerCode($user_id): JsonResponse
    {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        return Response::json(['tcrc' => TradeCampaignRetailerCode::whereBetween('updated_at', [$startDate, $endDate])->where('user_id', $user_id)->get()]);
    }
}
