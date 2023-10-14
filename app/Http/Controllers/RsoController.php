<?php

namespace App\Http\Controllers;

use App\Imports\RsoImport;
use App\Models\Rso;
use App\Models\User;
use App\Models\Route;
use App\Models\DdHouse;
use App\Models\Supervisor;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RsoStoreRequest;
use App\Http\Requests\RsoUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rsos = Rso::latest()->get();
        return view('modules.rso.index', compact('rsos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $userId = Rso::whereNotNull('user_id')->pluck('user_id');
        $users = User::where('role','rso')->whereNotIn('id', $userId)->orderBy('name','asc')->get();

        return view('modules.rso.create', compact('houses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RsoStoreRequest $request): RedirectResponse
    {
        $id = Rso::create($request->validated())->id;
        $newRso = Rso::findOrFail($id);
        $newRso->route()->attach($request->input('routes'));
        toastr('Rso created successfully.','success','Success');
        return to_route('rso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rso $rso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rso $rso): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $users = User::where('role','rso')->whereHas('ddHouse', function ($query) use ($rso){
            $query->where('dd_house_id', $rso->dd_house_id);
        })->orderBy('name','asc')->get();
        $supervisors = Supervisor::all();
        $routes = Route::all();
        return view('modules.rso.edit', compact('rso','houses','users','supervisors','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RsoUpdateRequest $request, Rso $rso): RedirectResponse
    {
        try {

            $rso->update($request->validated());
            toastr('Rso updated successfully.','success','Success');
            return to_route('rso.index');

        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso): JsonResponse
    {
        try {
            $rso->delete();
            return response()->json(['success' => 'The rso has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all rso.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            Rso::truncate();
            return response()->json(['success' => 'All rso has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import rso.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new RsoImport, $request->file('import_rso'));
            toastr('Rso imported successfully.','success','Success');
            return to_route('rso.index');
        } catch (ValidationException $e) {
            toastr('Rso imported failed.','error','Error!');
            return to_route('rso.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/Rso List.xlsx'));
    }

    /**
     * Get users, supervisors, routes by dd house.
     */
    public function getUsersSupervisorsRoutes($houseId): JsonResponse
    {
        return Response::json([
            'supervisor' => Supervisor::with('user')->where('dd_house_id', $houseId)->where('status', 1)->get(),
            'user' => User::whereHas('ddHouse', function ($query) use ($houseId){
                $query->where('dd_house_id', $houseId);
            })->where('role', 'rso')->where('status', 1)->get(),
            'route' => Route::where('dd_house_id', $houseId)->where('status', 1)->get(),
        ]);
    }
}
