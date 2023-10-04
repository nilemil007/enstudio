<?php

namespace App\Http\Controllers;

use App\Http\Requests\DdHouseStoreRequest;
use App\Http\Requests\DdHouseUpdateRequest;
use App\Imports\DdHouseImport;
use App\Models\DdHouse;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DdHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ddHouse = DdHouse::latest()->get();

        return view('modules.dd_house.index', compact('ddHouse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.dd_house.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DdHouseStoreRequest $request): RedirectResponse
    {
        try {
            DdHouse::create($request->validated());
            toastr('DD house created successfully.','success','Success!');
            return to_route('dd-house.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DdHouse $dd_house): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.dd_house.edit', compact('dd_house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DdHouseUpdateRequest $request, DdHouse $dd_house): RedirectResponse
    {
        try {
            $dd_house->update($request->validated());
            toastr('DD house updated successfully.','success','Success!');
            return to_route('dd-house.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DdHouse $dd_house): JsonResponse
    {
        try {
            $dd_house->delete();
            return response()->json(['success' => 'The house has been successfully deleted.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all house.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            DdHouse::query()->delete();
            return response()->json(['success' => 'All dd house has been deleted successfully.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import house.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new DdHouseImport, $request->file('import_house'));
            toastr('DD house imported successfully.','success','Success!');
            return to_route('dd-house.index');

        } catch (ValidationException $e) {
            toastr('DD house imported failed.','error','Error!');
            return to_route('dd-house.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/DD House Sample.xlsx'));
    }
}
