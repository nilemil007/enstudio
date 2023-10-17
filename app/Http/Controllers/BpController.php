<?php

namespace App\Http\Controllers;

use App\Models\Bp;
use App\Models\User;
use App\Models\DdHouse;
use App\Imports\BpImport;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\BpStoreRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BpUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class BpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bps = Bp::orderBy('dd_house_id', 'ASC')->get();
        return view('modules.bp.index', compact('bps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $userId = Bp::whereNotNull('user_id')->pluck('user_id');
        $users = User::where('role', 'bp')->whereNotIn('id', $userId)->get();
        return view('modules.bp.create', compact('houses','users'));
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
        return 'bp show method';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bp $bp): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $supervisors = Supervisor::where('id', $bp->supervisor_id)->get();
        $users = User::where('role', 'bp')->get();
        return view('modules.bp.edit', compact('houses','supervisors','users','bp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BpUpdateRequest $request, Bp $bp): JsonResponse
    {
        $brandPromoter = $request->validated();

        if ($request->hasFile('documents')) {

            if ( File::exists( public_path('assets/documents/bp/'.basename( $bp->documents ))))
            {
                File::delete( public_path('assets/documents/bp/'.basename( $bp->documents )));
            }

            $documents      = $request->file('documents');
            $documentName   = 'bp'.$documents->hashName();
            $documents->move(public_path('assets/documents/bp'), $documentName);
            $brandPromoter['documents'] = $documentName;
        }

        $bp->update($brandPromoter);
        return Response::json(['success' => 'BP updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bp $bp): JsonResponse
    {
        if ( File::exists( public_path('assets/documents/bp/'.basename( $bp->documents ))))
        {
            File::delete( public_path('assets/documents/bp/'.basename( $bp->documents )));
        }

        $bp->delete();
        return Response::json(['success' => 'BP deleted successfully.']);
    }

    /**
     * Delete all bp.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            File::cleanDirectory(public_path('assets/documents/bp'));
            Bp::truncate();
            return response()->json(['success' => 'All bp has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import bp.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new BpImport, $request->file('import_bp'));
            // toastr('BP imported successfully.','success','Success');
            return to_route('bp.index')->with('success','BP imported successfully.');

        } catch (ValidationException $e) {
            toastr('BP imported failed.','error','Error!');
            return to_route('bp.create')->with('import_errors', $e->failures())->with('error','BP imported failed.');
        }
    }

    /**
     * Get supervisors by dd house
     */
    public function getSupervisorsByDdHouse($house_id): JsonResponse
    {
        return Response::json(['supervisors' => Supervisor::with('user')
            ->where('dd_house_id',$house_id)
            ->where('status', 1)
            ->get()
        ]);
    }

    /**
     * Get user by dd house
     */
    public function getUserByDdHouse($house_id): JsonResponse
    {
        $userId = Bp::whereNotNull('user_id')->pluck('user_id');
        return Response::json(['user' => User::whereNotIn('id', $userId)
            ->where('dd_house',$house_id)
            ->where('role', 'bp')
            ->where('status', 1)
            ->get()
        ]);
    }
}
