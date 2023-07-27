<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItopReplaceStoreRequest;
use App\Http\Requests\ItopReplaceUpdateRequest;
use App\Models\ItopReplace;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ItopReplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ( !empty($request->input('start_date')) && !empty($request->input('end_date')) )
        {
            $sdate =  $request->input('start_date');
            $edate =  $request->input('end_date');

            return view('itop-replace.index',[
                'replaces' => ItopReplace::with('user','rso')
                    ->search( $request->search )
                    ->whereBetween('created_at', [$sdate, Carbon::parse($edate)->endOfDay()])
                    ->latest()
                    ->paginate(5),
            ]);
        }else{
            if ( Auth::user()->role == 'superadmin' )
            {
                $replaces = ItopReplace::with('user')
                    ->search( $request->search )
                    ->latest()
                    ->get();
            }else{
                $replaces = ItopReplace::with('user')
                    ->where('user_id', Auth::id())
                    ->search( $request->search )
                    ->latest()
                    ->get();
            }

            return view('modules.itop_replace.index', compact('replaces'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.itop_replace.create',[
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItopReplaceStoreRequest $request): RedirectResponse
    {
        $replace = $request->validated();

        if ( Auth::user()->role != 'superadmin' )
        {
            unset( $replace['serial_number'] );
        }

        if ( $request->filled('user_id') )
        {
            $replace['user_id'] = $request->input('user_id');
        }else{
            $replace['user_id'] = Auth::id();
        }

        if ( ItopReplace::create( $replace ) )
        {
            Alert::success('Success', 'New entry created successfully.');
        }else{
            Alert::error('Error', 'Entry creation failed.');
        }

        return to_route('itop-replace.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItopReplace $itopReplace)
    {
        return 'itop replace show.';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItopReplace $itop_replace): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        return view('modules.itop_replace.edit', compact('itop_replace','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItopReplaceUpdateRequest $request, ItopReplace $itop_replace): RedirectResponse
    {
        $update = $request->validated();

        if ( $request->input('status') == "paid" )
        {
            $update['payment_at'] = Carbon::now();
        }

        if ( $itop_replace->itop_number != $request->itop_number && Auth::user()->role != 'super-admin' )
        {
            unset( $update['itop_number'] );
            $update['tmp_itop_number'] = $request->itop_number;
            $update['remarks'] = 'Unapproved';

//            Event::dispatch( new ItopReplaceEvent( $update, Auth::user() ) );
        }

        if ( $itop_replace->update( $update ) )
        {
            Alert::success('Success', 'Record updated successfully.');
        }else{
            Alert::error('Error', 'Record update failed.');
        }

        return to_route('itop-replace.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItopReplace $itopReplace): JsonResponse
    {
        $itopReplace->delete();

        return response()->json(['success' => 'Itop replace entry has been deleted.']);
    }

    public function deleteAll(): JsonResponse
    {
        try {
            ItopReplace::truncate();
            return response()->json(['success' => 'All itop replace entry has been deleted.']);
        }catch (Exception $exception){
            dd($exception);
        }
    }
}
