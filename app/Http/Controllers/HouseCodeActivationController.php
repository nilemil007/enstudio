<?php

namespace App\Http\Controllers;

use App\Http\Requests\HCAStoreRequest;
use App\Http\Requests\HCAUpdateRequest;
use App\Models\Activation\HouseCodeActivation;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        $users = User::where('role', '!=', 'superadmin')->get();
        $retailers = Retailer::all();
        return view('modules.house_code_activation.create', compact('users','retailers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HCAStoreRequest $request)
    {
        $data = $request->validated();

        try {

            $data['dd_house'] = Retailer::firstWhere('code', $request->retailer_code)->dd_house;
            HouseCodeActivation::create($data);
            Alert::success('Success', 'New record created successfully.');
            return to_route('hca.index');

        }catch(\Exception $exception) {
            dd($exception);
        }
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
    public function edit(HouseCodeActivation $hca): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        $retailers = Retailer::all();
        return view('modules.house_code_activation.edit', compact('hca','users','retailers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HCAUpdateRequest $request, HouseCodeActivation $hca)
    {
        $data = $request->validated();

        try {

            $data['dd_house'] = Retailer::firstWhere('code', $request->retailer_code)->dd_house;
            $hca->update($data);
            Alert::success('Success', 'Record updated successfully.');
            return to_route('hca.index');

        }catch(\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseCodeActivation $hca)
    {
        try {
            $hca->delete();
            return response()->json(['success' => 'The record has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all house code activation.
     */
    public function deleteAll()
    {
        try {
            HouseCodeActivation::truncate();
            return response()->json(['success' => 'All record has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }
}
