<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupervisorStoreRequest;
use App\Http\Requests\SupervisorUpdateRequest;
use App\Models\DdHouse;
use App\Models\Supervisor;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $supervisors = Supervisor::latest()->get();
        return view('modules.supervisor.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $userId = Supervisor::whereNotNull('user_id')->pluck('user_id');
        $users = User::where('role', 'supervisor')->whereNotIn('id', $userId)->get();
        return view('modules.supervisor.create', compact('houses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupervisorStoreRequest $request): JsonResponse
    {
        try {
            Supervisor::create($request->validated());

            return response()->json(['success' => 'Supervisor created successfully.']);
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
    public function edit(Supervisor $supervisor): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $users = User::where('role', 'supervisor')->get();
        return view('modules.supervisor.edit', compact('supervisor','houses','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupervisorUpdateRequest $request, Supervisor $supervisor): \Illuminate\Http\RedirectResponse
    {
        try {
            $supervisor->update($request->validated());

            Alert::success('Success', 'Supervisor updated successfully.');

            return to_route('supervisor.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisor $supervisor): JsonResponse
    {
        try {
            $supervisor->delete();
            return response()->json(['success' => 'Supervisor has been deleted successfully.']);
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
            Supervisor::query()->delete();
            return response()->json(['success' => 'All supervisor has been deleted successfully.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }
}
