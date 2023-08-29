<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.setting.index', [
            'setting' => Setting::firstWhere('user_id', Auth::id()),
        ]);
    }

    public function general(Request $request)
    {
        Setting::updateOrCreate(['user_id' => Auth::id()],[
            'drc_code' => $request->drc_code,
            'exclude_from_core_act' => $request->exclude_from_core_act,
            'exclude_from_live_act' => $request->exclude_from_live_act,
        ]);

        return redirect()->back();
    }

    public function sheraPartner(Request $request)
    {

    }
}
