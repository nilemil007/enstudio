<?php

namespace App\Http\Controllers;

use App\Imports\RsoImport;
use App\Models\Rso;
use App\Models\User;
use App\Models\Route;
use App\Models\DdHouse;
use App\Models\Supervisor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RsoStoreRequest;
use App\Http\Requests\RsoUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rsos       = Rso::latest()->get();
        $trashed    = Rso::onlyTrashed()->latest()->get();
        return view('modules.rso.index', compact('rsos','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $userId = Rso::whereNotNull('user_id')->pluck('user_id');
        $users  = User::where('role','rso')->whereNotIn('id', $userId)->orderBy('name','asc')->get();

        return view('modules.rso.create', compact('houses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RsoStoreRequest $request): RedirectResponse
    {
        $id     = Rso::create($request->validated())->id;
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
        $rso->update($request->validated());
        $rso->route()->sync($request->input('routes'));
        toastr('Rso updated successfully.','success','Success');
        return to_route('rso.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso): RedirectResponse
    {
        $rso->delete();
        toastr('This rso has been temporarily deleted.','success','Success');
        return to_route('rso.index');
    }

    /**
     * Trash rso.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashedRso = Rso::onlyTrashed()->latest()->paginate(10);
        return view('modules.rso.trash', compact('trashedRso'));
    }

    /**
     * Restore rso.
     */
    public function restore($id): RedirectResponse
    {
        Rso::withTrashed()->findOrFail($id)->restore();
        toastr('Rso restored successfully.','success','Success');
        return to_route('rso.index');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): RedirectResponse
    {
        // Find a rso to detach from the route.
        $rso = rso::with('route')->withTrashed()->findOrFail($id);

        // All routes associated with the rso are being detached.
        foreach ($rso->route as $route)
        {
            $rso->route()->detach($route->id);
        }

        // Find and permanently delete trashed rso.
        Rso::onlyTrashed()->findOrFail($id)->forceDelete();

        // Notification [permanently deleted rso.]
        toastr('This rso has been permanently deleted.','success','Success');

        // Back to all users page.
        return to_route('rso.index');
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
        return Response::download(public_path('download/sample/Rso.xlsx'));
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
