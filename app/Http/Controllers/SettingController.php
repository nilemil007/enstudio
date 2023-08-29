<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.setting.index');
    }

    public function general(Request $request)
    {
        dd($request->all());
    }

    public function sheraPartner(Request $request)
    {

    }
}
