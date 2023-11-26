<?php

namespace App\Http\Controllers;

use App\Imports\CoreActivationImport;
use App\Models\Activation\CoreActivation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class CoreActivationController extends Controller
{
    // Core Activation View
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $activations = CoreActivation::paginate(10);
        return view('modules.core_data.activation.index', compact('activations'));
    }

    // Core Activation Import
    public function coreActivationImport(Request $request): JsonResponse
    {
        Excel::import(new CoreActivationImport, $request->file('core_activation_import'));

        return Response::json(['success' => 'Core activation imported successfully.']);
    }
}
