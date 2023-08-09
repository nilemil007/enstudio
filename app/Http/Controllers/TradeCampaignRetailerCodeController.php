<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use App\Models\TradeCampaignRetailerCode;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TradeCampaignRetailerCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tcrc = TradeCampaignRetailerCode::all();
        return view('modules.trade_campaign_retailer_code.index', compact('tcrc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tcrcId = TradeCampaignRetailerCode::whereNotNull('retailer_id')->pluck('retailer_id');
        $retailers = Retailer::whereNotIn('id', $tcrcId)->get();
        return view('modules.trade_campaign_retailer_code.create', compact('retailers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'retailer_id'   => ['required'],
            'flag'          => ['required'],
        ]);

        TradeCampaignRetailerCode::create($request->only('retailer_id','flag'));
        return Response::json(['success' => 'TCRC created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeCampaignRetailerCode $tradeCampaignRetailerCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeCampaignRetailerCode $tradeCampaignRetailerCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeCampaignRetailerCode $tradeCampaignRetailerCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeCampaignRetailerCode $tradeCampaignRetailerCode)
    {
        //
    }
}
