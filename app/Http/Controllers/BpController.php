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
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = Bp::onlyTrashed()->latest()->get();
        $bps = Bp::latest()->get();
        return view('modules.bp.index', compact('bps','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $users = User::where('role', 'bp')->get();
        return view('modules.bp.create', compact('houses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BpStoreRequest $request): RedirectResponse
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
        return to_route('bp.index')->with('success','New BP created successfully.');
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
    public function update(BpUpdateRequest $request, Bp $bp): RedirectResponse
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
        return to_route('bp.index')->with('success','BP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bp $bp): JsonResponse
    {
        $bp->delete();
        return Response::json(['success' => 'This BP has been temporarily deleted.']);
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
//            toastr('BP imported failed.','error','Error!');
            return to_route('bp.create')->with('import_errors', $e->failures())->with('error','BP imported failed.');
        }
    }

    /**
     * Trash.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = Bp::onlyTrashed()->latest()->paginate(10);
        return view('modules.bp.trash', compact('trashed'));
    }

    /**
     * Restore.
     */
    public function restore($id): RedirectResponse
    {
        Bp::withTrashed()->findOrFail($id)->restore();
        // toastr('User restored successfully.','success','Success');
        return to_route('bp.index')->with('success','BP restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): JsonResponse
    {
        // If the bp has a document, that document will be deleted.
        if ( File::exists( public_path('assets/documents/bp/'.Bp::onlyTrashed()->firstWhere('id', $id)->documents)) )
        {
            File::delete( public_path('assets/documents/bp/'.Bp::onlyTrashed()->firstWhere('id', $id)->documents));
        }

        // Find and permanently delete trashed bp.
        Bp::onlyTrashed()->findOrFail($id)->forceDelete();

        // Back to all users page.
        return Response::json(['success' => 'This BP has been permanently deleted.']);
    }

    /**
     * Permanently Delete All BP.
     */
    public function permanentlyDeleteAll(): JsonResponse
    {
        try {
            File::cleanDirectory(public_path('assets/documents/bp'));
            Bp::onlyTrashed()->forceDelete();
            return response()->json(['success' => 'All BP has been permanently deleted successfully.']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'All BP not deleted.']);
            dd($exception);
        }
    }

    /**
     * Get supervisors by dd house
     */
    public function getSupervisorsAndUsers($house_id): JsonResponse
    {
        return Response::json([
            'supervisors' => Supervisor::with('user')
            ->where('dd_house_id',$house_id)
            ->where('status', 1)
            ->get(),

            'users' => User::whereHas('ddHouse', function ($query) use ($house_id){
                    $query->where('dd_house_id', $house_id);
                })
                ->where('role', 'bp')
                ->where('status', 1)
                ->get(),
        ]);
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/BP.xlsx'));
    }
}
