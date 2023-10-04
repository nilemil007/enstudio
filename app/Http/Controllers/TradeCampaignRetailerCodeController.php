<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use App\Models\TradeCampaignRetailerCode;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TradeCampaignRetailerCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tcrc = TradeCampaignRetailerCode::latest()->get();
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $tcrc = $this->validate($request,[
            'user_id'       => ['required'],
            'retailer_id'   => ['required','unique:trade_campaign_retailer_codes,retailer_id'],
            'flag'          => ['required'],
        ],[
            'user_id.required'      => 'You must select a :attribute.',
            'retailer_id.required'  => 'You must select a :attribute.',
            'retailer_id.unique'    => 'This :attribute already exist.',
            'flag.required'         => 'You must select a :attribute.',
        ],[
            'user_id'       => 'user',
            'retailer_id'   => 'retailer code',
        ]);

        TradeCampaignRetailerCode::create($tcrc);

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
    public function edit(TradeCampaignRetailerCode $tcrc): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $retailers = Retailer::all();
        return view('modules.trade_campaign_retailer_code.edit', compact('tcrc','retailers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeCampaignRetailerCode $tcrc): JsonResponse
    {
        $data = $request->validate([
            'retailer_id'   => ['required'],
            'flag'          => ['required'],
        ]);

        $tcrc->update($data);
        return Response::json(['success' => 'TCRC updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeCampaignRetailerCode $tcrc): JsonResponse
    {
        try {
            $tcrc->delete();
            return response()->json(['success' => 'TCRC has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all tcrc.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            TradeCampaignRetailerCode::truncate();
            return response()->json(['success' => 'All TCRC has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    public function getUsersByFlag($flag): JsonResponse
    {
        return Response::json(['users' => User::with('rso')->where('role', $flag)->where('status', 1)->get()]);
    }
}
