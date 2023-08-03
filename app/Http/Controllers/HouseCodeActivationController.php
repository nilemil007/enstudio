<?php

namespace App\Http\Controllers;

use App\Http\Requests\HCAStoreRequest;
use App\Http\Requests\HCAUpdateRequest;
use App\Models\Activation\HouseCodeActivation;
use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * house code activation summary.
     */
    public function summary(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ddHouse = DdHouse::all();
        $results = HouseCodeActivation::when($request->start_date != null, function (Builder $query) use ($request){
            return $query->whereBetween('activation_date', [$request->start_date, Carbon::parse($request->end_date)->endOfDay()]);
        })->get();
//        dd($result);
        return view('modules.house_code_activation.summary', compact('results','ddHouse'));



//        $ddHouse = DdHouse::all();
//
//        if ( !empty($request->input('start_date')) && !empty($request->input('end_date')) )
//        {
//            $sdate =  $request->input('start_date');
//            $edate =  $request->input('end_date');
//            $hca = HouseCodeActivation::search( $request->search )
//                ->whereBetween('activation_date', [$sdate, Carbon::parse($edate)->endOfDay()])
//                ->get();
//            return view('modules.house_code_activation.summary', compact('hca','ddHouse'));
//        }elseif ($request->dd_house)
//        {
//            $hca = HouseCodeActivation::search( $request->search )->get();
//            return view('modules.house_code_activation.summary', compact('hca','ddHouse'));
//        }else{
//            return view('modules.house_code_activation.summary', compact('ddHouse'));
//        }
    }
}
