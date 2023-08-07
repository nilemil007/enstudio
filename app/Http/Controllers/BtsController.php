<?php

namespace App\Http\Controllers;

use App\Http\Requests\BtsStoreRequest;
use App\Http\Requests\BtsUpdateRequest;
use App\Imports\BtsImport;
use App\Models\Bts;
use App\Models\DdHouse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BtsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $allBts = Bts::latest()->get();
        return view('modules.bts.index', compact('allBts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.bts.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BtsStoreRequest $request): JsonResponse
    {
        try {
            Bts::create($request->validated());

            return Response::json(['success' => 'New BTS created successfully.']);
        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bts $bt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bts $bt): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.bts.edit', compact('houses','bt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BtsUpdateRequest $request, Bts $bt)
    {
        try {

            $bt->update($request->validated());
            Alert::success('Success', 'BTS information updated successfully.');
            return to_route('bts.index');

        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bts $bt)
    {
        try {
            $bt->delete();
            return response()->json(['success' => 'The BTS has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all bts.
     */
    public function deleteAll()
    {
        try {
            Bts::truncate();
            return response()->json(['success' => 'All BTS has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import bts.
     */
    public function import(Request $request)
    {
        try {
            Excel::import(new BtsImport, $request->file('import_bts'));

            return Response::json(['success' => 'BTS imported successfully.']);

        } catch (ValidationException $e) {
            return to_route('bts.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/BTS List.xlsx'));
    }
}
