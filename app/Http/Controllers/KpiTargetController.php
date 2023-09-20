<?php

namespace App\Http\Controllers;

use App\Models\KpiTarget;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Imports\KpiTargetImport;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class KpiTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $kpiTargets = KpiTarget::paginate(10);
        return view('modules.kpi_target.index', compact('kpiTargets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.kpi_target.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KpiTarget $kpiTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KpiTarget $kpiTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KpiTarget $kpiTarget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KpiTarget $kpiTarget)
    {
        //
    }

        /**
     * Delete all target.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            KpiTarget::query()->delete();
            return response()->json(['success' => 'All KPI target has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import kpi target.
     */
    public function import(Request $request): JsonResponse|RedirectResponse
    {
        try {
            Excel::import(new KpiTargetImport, $request->file('import_kpi_target'));

            return Response::json(['success' => 'KPI target imported successfully.']);

        } catch (ValidationException $e) {
            return to_route('kpi-target.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/KPI Target.xlsx'));
    }
}
