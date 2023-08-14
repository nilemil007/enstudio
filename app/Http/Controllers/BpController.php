<?php

namespace App\Http\Controllers;

use App\Http\Requests\BpStoreRequest;
use App\Models\Bp;
use App\Models\DdHouse;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bps = Bp::all();
        return view('modules.bp.index', compact('bps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $supervisors = Supervisor::all();
        $users = User::where('role', 'bp')->get();
        return view('modules.bp.create', compact('houses','supervisors','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BpStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('documents'))
        {
            $documents      = $request->file('documents');
            $documentName   = 'bp'.$documents->hashName();
            $documents->move(public_path('assets/documents/bp'), $documentName);
            $data['documents'] = $documentName;
        }

        Bp::create($data);
        return Response::json(['success' => 'New BP created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bp $bp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bp $bp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bp $bp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bp $bp)
    {
        //
    }
}
