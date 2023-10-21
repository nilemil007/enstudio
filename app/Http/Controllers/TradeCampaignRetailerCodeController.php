<?php

namespace App\Http\Controllers;

use App\Models\Bp;
use App\Models\TradeCampaignRetailerCode;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class TradeCampaignRetailerCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = TradeCampaignRetailerCode::onlyTrashed()->latest()->get();
        $tcrc = TradeCampaignRetailerCode::latest()->get();
        return view('modules.trade_campaign_retailer_code.index', compact('tcrc','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::where('role','!=','superadmin')
            ->where('role','!=','manager')
            ->where('role','!=','zm')
            ->where('role','!=','accountant')
            ->where('role','!=','supervisor')
            ->orderBy('role', 'ASC')
            ->get();
        $bps = Bp::all();
        return view('modules.trade_campaign_retailer_code.create', compact('users','bps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $tcrc = $this->validate($request,[
            'user_id'       => ['required'],
            'retailer_code' => ['required','unique:trade_campaign_retailer_codes,retailer_code','exists:retailers,code'],
            'flag'          => ['required'],
            'remarks'       => ['nullable'],
        ],[
            'user_id.required'          => 'আপনাকে অবশ্যই একজন :attribute নির্বাচন করতে হবে।',
            'retailer_code.required'    => 'আপনাকে অবশ্যই একটি :attribute প্রদান করতে হবে।',
            'retailer_code.unique'      => 'এই :attributeটি পূর্বে প্রদান করা হয়েছে। দয়াকরে এটি পরিবর্তন করুন।',
            'retailer_code.exists'      => 'এই :attributeটি ডাটাবেসে নেই।',
            'flag.required'             => 'আপনাকে অবশ্যই একটি :attribute প্রদান করতে হবে।',
        ],[
            'user_id'       => 'ব্যাবহারকারী',
            'retailer_code' => 'রিটেইলার কোড',
            'flag'          => 'ফ্ল্যাগ',
        ]);

        TradeCampaignRetailerCode::create($tcrc);

        return to_route('tcrc.create')->with('success', 'New TCRC code selected successfully.');
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
        $users = User::where('role','!=','superadmin')
            ->where('role','!=','supervisor')
            ->where('role','!=','manager')
            ->where('role','!=','zm')
            ->where('role','!=','accountant')
            ->orderBy('role', 'ASC')->get();
        return view('modules.trade_campaign_retailer_code.edit', compact('tcrc','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeCampaignRetailerCode $tcrc): RedirectResponse
    {
        $data = $this->validate($request,[
            'user_id'       => ['required'],
            'retailer_code' => ['required','unique:trade_campaign_retailer_codes,retailer_code,'. request()->segment(2)],
            'flag'          => ['required'],
            'remarks'       => ['nullable'],
        ],[
            'user_id.required'          => 'আপনাকে অবশ্যই একজন :attribute নির্বাচন করতে হবে।',
            'retailer_code.required'    => 'আপনাকে অবশ্যই একটি :attribute প্রদান করতে হবে।',
            'retailer_code.unique'      => 'এই :attributeটি পূর্বে প্রদান করা হয়েছে। দয়াকরে এটি পরিবর্তন করুন।',
            'flag.required'             => 'আপনাকে অবশ্যই একটি :attribute প্রদান করতে হবে।',
        ],[
            'user_id'       => 'ব্যাবহারকারী',
            'retailer_code' => 'রিটেইলার কোড',
            'flag'          => 'ফ্ল্যাগ',
        ]);

        $tcrc->update($data);

        return to_route('tcrc.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeCampaignRetailerCode $tcrc)
    {
        try {
            $tcrc->delete();
            return Response::json(['success' => 'This record has been temporarily deleted.']);
        }catch (\Exception $exception){
            dd($exception);
            return to_route('tcrc.index')->with('danger','Record not delete.');
        }
    }

    /**
     * Trash.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = TradeCampaignRetailerCode::onlyTrashed()->latest()->paginate(10);
        return view('modules.trade_campaign_retailer_code.trash', compact('trashed'));
    }

    /**
     * Restore.
     */
    public function restore($id): RedirectResponse
    {
        TradeCampaignRetailerCode::withTrashed()->findOrFail($id)->restore();
        return to_route('tcrc.index')->with('success','Record restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id)
    {
        try {
            // Find and permanently delete trashed user.
            TradeCampaignRetailerCode::onlyTrashed()->findOrFail($id)->forceDelete();

            // Back to index page.
            return Response::json(['success' => 'This record has been permanently deleted.']);
        }catch (\Exception $exception){
            dd($exception);
            return to_route('tcrc.index')->with('danger','Record not delete.');
        }
    }
}
