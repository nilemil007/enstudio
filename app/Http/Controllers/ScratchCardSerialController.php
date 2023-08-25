<?php

namespace App\Http\Controllers;

use App\Jobs\ScratchCardSerialJob;
use App\Models\DdHouse;
use App\Models\ScratchCardSerial;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

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
        $houses = DdHouse::all();
        return view('modules.sc_serial.create',compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $fields = $this->validate($request, [
            'dd_house_id'   => ['required'],
            'product_code'  => ['required'],
            'f_serial'      => ['required','unique:scratch_card_serials,serial'],
            'l_serial'      => ['required','unique:scratch_card_serials,serial'],
            'group'         => ['required'],
        ],[
            'dd_house_id.required'  => 'Please select :attribute.',
            'product_code.required' => 'Please select :attribute.',
            'f_serial.required'     => 'Please enter :attribute.',
            'l_serial.required'     => 'Please enter :attribute.',
            'group.required'        => 'Please select :attribute.',
        ],[
            'dd_house_id'   => 'dd house',
            'product_code'  => 'product code',
            'f_serial'      => 'first serial',
            'l_serial'      => 'last serial',
            'group'         => 'group',
        ]);

        ScratchCardSerialJob::dispatch($fields);

        return Response::json(['success' => 'New scratch card serial number created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ScratchCardSerial $sc_serial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScratchCardSerial $sc_serial): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sc_serial.edit',compact('sc_serial'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ScratchCardSerial $sc_serial
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, ScratchCardSerial $sc_serial): JsonResponse
    {
        $serial = $this->validate($request, [
            'serial' => ['required','unique:scratch_card_serials,serial'],
        ],[
            'serial.required' => 'Please enter :attribute.',
        ],[
            'serial' => 'serial number',
        ]);

        $sc_serial->update($serial);

        return Response::json(['success' => 'Scratch card serial number updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScratchCardSerial $sc_serial): JsonResponse
    {
        $sc_serial->delete();

        return Response::json(['success' => 'Record deleted successfully.']);
    }

    /**
     * Delete all scratch card serial numbers.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            ScratchCardSerial::truncate();
            return response()->json(['success' => 'All record has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }
}
