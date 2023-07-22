<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Imports\RouteImport;
use App\Models\DdHouse;
use App\Models\Route;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $routes = Route::latest()->get();
        return view('modules.route.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.route.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteStoreRequest $request)
    {
        try {
            Route::create($request->validated());

            Alert::success('Success', 'Route created successfully.');

            return to_route('route.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.route.edit', compact('route','houses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteUpdateRequest $request, Route $route)
    {
        try {
            $route->update($request->validated());

            Alert::success('Success', 'Route updated successfully.');

            return to_route('route.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        try {
            $route->delete();
            return response()->json(['success' => 'Route has been deleted successfully.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all routes.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            Route::query()->delete();
            return response()->json(['success' => 'All route has been deleted successfully.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import route.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new RouteImport(), $request->file('import_route'));

            Alert::success('Success', 'Route imported successfully.');

            return to_route('route.index');

        } catch (ValidationException $e) {
            return to_route('route.create')->with('import_errors', $e->failures());
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
