<?php

namespace App\Http\Controllers;

use App\Http\Requests\RsoStoreRequest;
use App\Models\DdHouse;
use App\Models\Rso;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
        $routes = Supervisor::all();
        return view('modules.rso.create', compact('houses','users','supervisors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RsoStoreRequest $request)
    {
        dd($request->validated());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rso $rso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso)
    {
        //
    }
}
