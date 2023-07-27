<?php

namespace App\Http\Controllers;

use App\Models\Activation\HouseCodeActivation;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HouseCodeActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houseCodeAct = HouseCodeActivation::latest()->get();
        return view('modules.house_code_activation.index', compact('houseCodeAct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::where('role', 'rso')->get();
        $retailers = Retailer::all();
        return view('modules.house_code_activation.create', compact('users','retailers'));
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
    public function show(HouseCodeActivation $houseCodeActivation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HouseCodeActivation $houseCodeActivation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HouseCodeActivation $houseCodeActivation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseCodeActivation $houseCodeActivation)
    {
        //
    }
}
