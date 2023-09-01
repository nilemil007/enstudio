<?php

namespace App\Http\Controllers;

use App\Models\DdHouse;
use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.setting.index', [
            'setting'   => Setting::firstWhere('user_id', Auth::id()),
            'ddHouses'  => DdHouse::get(),
        ]);
    }

    public function general(Request $request): RedirectResponse
    {
        Setting::updateOrCreate(['user_id' => Auth::id()],[
            'drc_code'              => $request->input('drc_code'),
            'exclude_from_rso_act'  => $request->input('exclude_from_rso_act'),
            'exclude_from_live_act' => $request->input('exclude_from_live_act'),
            'product_code'          => $request->input('product_code'),
            'dd_house'              => $request->input('dd_house'),
        ]);

        return redirect()->back();
    }

    public function sheraPartner(Request $request): RedirectResponse
    {
        Setting::updateOrCreate(['user_id' => Auth::id()],[
            'shera_partner_day'         => $request->input('shera_partner_day'),
            'shera_partner_percentage'  => $request->input('shera_partner_percentage'),
        ]);

        return redirect()->back();
    }
}
