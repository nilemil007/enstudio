<?php

namespace App\Http\Controllers;

use App\Models\Activation\CoreActivation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoreActivationImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class CoreDataImportController extends Controller
{
    // Core Activation
    public function activation(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $activations = CoreActivation::all();
        return view('modules.core_data.activation.activation', compact('activations'));
    }

    /**
     * Import Core Activation.
     */
    public function activationImport(Request $request): JsonResponse|RedirectResponse
    {
        try {
            Excel::import(new CoreActivationImport, $request->file('core_activation_import'));

            return Response::json(['success' => 'Activation imported successfully.']);

        } catch (ValidationException $e) {
            return to_route('core.activation')->with('import_errors', $e->failures());
        }
    }
}
