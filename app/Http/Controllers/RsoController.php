<?php

namespace App\Http\Controllers;

use App\Models\Rso;
use App\Models\User;
use App\Models\Route;
use App\Models\DdHouse;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RsoStoreRequest;
use App\Http\Requests\RsoUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

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
        $users = User::where('role','rso')->get();
        $supervisors = Supervisor::all();
        $routes = Route::all();
        return view('modules.rso.create', compact('houses','users','supervisors','routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RsoStoreRequest $request)
    {
        try {
            Rso::create($request->validated());

            Alert::success('Success', 'Rso created successfully.');

            return to_route('rso.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
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
    public function edit(Rso $rso)
    {
        $houses = DdHouse::all();
        $users = User::where('role','rso')->orderBy('phone','asc')->get();
        $supervisors = Supervisor::all();
        $routes = Route::all();
        return view('modules.rso.edit', compact('rso','houses','users','supervisors','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RsoUpdateRequest $request, Rso $rso)
    {
        try {
            $rso->update($request->validated());

            Alert::success('Success', 'Rso updated successfully.');

            return to_route('rso.index');
        }catch(ValidationException $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso)
    {
        //
    }
}
