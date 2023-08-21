<?php

namespace App\Http\Controllers;

use App\Imports\CoreActivationImport;
use App\Models\Activation\CoreActivation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CoreActivationController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $activations = CoreActivation::all();
        return view('modules.core_data.activation.index', compact('activations'));
    }

    public function coreActivationImport(Request $request)
    {
        Excel::import(new CoreActivationImport, $request->file('core_activation_import'));
        dd('import successfully.');
    }
}
