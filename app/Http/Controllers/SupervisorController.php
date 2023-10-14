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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $supervisors = Supervisor::query()->orderBy('dd_house_id','ASC')->get();
        return view('modules.supervisor.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.supervisor.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupervisorStoreRequest $request): RedirectResponse
    {
        try {
            Supervisor::create($request->validated());
            toastr('Supervisor created successfully.','success','Success');
            return to_route('supervisor.index');
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
        $users = User::where('role', 'supervisor')->where('dd_house', $supervisor->dd_house_id)->get();
        return view('modules.supervisor.edit', compact('supervisor','houses','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupervisorUpdateRequest $request, Supervisor $supervisor): RedirectResponse
    {
        try {
            $supervisor->update($request->validated());
            toastr('Supervisor updated successfully.','success','Success');
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

    /**
     * Get users by dd house
     */
    public function getUsersByDdHouse($house_id): JsonResponse
    {
        $userId = Supervisor::whereNotNull('user_id')->pluck('user_id');
        return Response::json(['users' => User::whereNotIn('id', $userId)
            ->whereHas('ddHouse', function ($query) use ($house_id){
                $query->where();
            })
            ->where('role', 'supervisor')
            ->where('status', 1)
            ->get()
        ]);
    }
}
