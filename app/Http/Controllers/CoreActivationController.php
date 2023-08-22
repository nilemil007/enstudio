<?php

namespace App\Http\Controllers;

use App\Imports\CoreActivationImport;
use App\Models\Activation\CoreActivation;
use App\Models\Retailer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class CoreActivationController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $activations = CoreActivation::all();
        return view('modules.core_data.activation.index', compact('activations'));
    }

    public function coreActivationImport(Request $request): JsonResponse
    {
        Excel::import(new CoreActivationImport, $request->file('core_activation_import'));
        return Response::json(['success' => 'Core activation imported successfully.']);
    }

    // Core Activation Summary
    public function coreActivationSummary(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $retailerId = CoreActivation::whereNotNull('retailer_id')->pluck('retailer_id');
        $retailerCode = Retailer::groupBy('code')
            ->where('sim_seller','Y')
            ->whereIn('id', $retailerId)
            ->get();
        return view('modules.core_data.activation.summary', compact('retailerCode'));
    }
}
