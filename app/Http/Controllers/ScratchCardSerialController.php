<?php

namespace App\Http\Controllers;

use App\Jobs\ScratchCardSerialJob;
use App\Models\ScratchCardSerial;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ScratchCardSerialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $scSerials = ScratchCardSerial::all();
        return view('modules.sc_serial.index', compact('scSerials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sc_serial.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $serial = $this->validate($request, [
            'f_serial' => ['required','unique:scratch_card_serials,serial'],
            'l_serial' => ['required','unique:scratch_card_serials,serial'],
        ],[
            'f_serial.required' => 'Please enter :attribute.',
            'l_serial.required' => 'Please enter :attribute.',
        ],[
            'f_serial' => 'first serial',
            'l_serial' => 'last serial',
        ]);

        dispatch( new ScratchCardSerialJob( (object)$serial ) );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ScratchCardSerial $scSerial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScratchCardSerial $scSerial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScratchCardSerial $scSerial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScratchCardSerial $scSerial)
    {
        //
    }
}
