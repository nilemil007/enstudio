<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmStoreRequest;
use App\Http\Requests\CmUpdateRequest;
use App\Imports\CmImport;
use App\Models\Cm;
use App\Models\DdHouse;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = Cm::onlyTrashed()->latest()->get();
        $cms = Cm::latest()->get();
        return view('modules.cm.index', compact('cms','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.cm.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CmStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('documents'))
        {
            $documents          = $request->file('documents');
            $documentName       = 'cm'.$documents->hashName();
            $documents->move( public_path('assets/documents/cm'), $documentName );
            $data['documents']  = $documentName;
        }

        Cm::create( $data );

        return to_route('cm.index')->with('success','New CM created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cm $cm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cm $cm): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        $users = User::with('cm')->where('role', 'cm')->get();
        return view('modules.cm.edit', compact('houses','users','cm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CmUpdateRequest $request, Cm $cm): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('documents')) {

            if ( File::exists( public_path('assets/documents/cm/'.basename( $cm->documents ))))
            {
                File::delete( public_path('assets/documents/cm/'.basename( $cm->documents )));
            }

            $documents      = $request->file('documents');
            $documentName   = 'cm'.$documents->hashName();
            $documents->move(public_path('assets/documents/cm'), $documentName);
            $data['documents'] = $documentName;
        }

        $cm->update($data);
        return to_route('cm.index')->with('success','CM updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cm $cm): JsonResponse
    {
        $cm->delete();
        return Response::json(['success' => 'This CM has been temporarily deleted.']);
    }

    /**
     * Trash.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = Cm::onlyTrashed()->latest()->paginate(10);
        return view('modules.cm.trash', compact('trashed'));
    }

    /**
     * Restore.
     */
    public function restore($id): RedirectResponse
    {
        Cm::withTrashed()->findOrFail($id)->restore();
        // toastr('User restored successfully.','success','Success');
        return to_route('cm.index')->with('success','CM restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): JsonResponse
    {
        // If the cm has a document, that document will be deleted.
        if ( File::exists( public_path('assets/documents/cm/'.Cm::onlyTrashed()->firstWhere('id', $id)->documents ) ) )
        {
            File::delete( public_path('assets/documents/cm/'.Cm::onlyTrashed()->firstWhere('id', $id)->documents ) );
        }

        // Find and permanently delete trashed cm.
        Cm::onlyTrashed()->findOrFail($id)->forceDelete();

        // Back to all users page.
        return Response::json(['success' => 'This CM has been permanently deleted.']);
    }

    /**
     * Permanently Delete All CM.
     */
    public function permanentlyDeleteAll(): JsonResponse
    {
        try {
            File::cleanDirectory( public_path('assets/documents/cm' ) );
            Cm::onlyTrashed()->forceDelete();
            return response()->json(['success' => 'All CM has been permanently deleted successfully.']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'All CM not deleted.']);
            dd($exception);
        }
    }

    /**
     * Import bp.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new CmImport(), $request->file('import_cm'));
            // toastr('BP imported successfully.','success','Success');
            return to_route('cm.index')->with('success','CM imported successfully.');

        } catch (ValidationException $e) {
//            toastr('BP imported failed.','error','Error!');
            return to_route('cm.create')->with('import_errors', $e->failures())->with('error','CM imported failed.');
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download( public_path('download/sample/CM.xlsx' ) );
    }

    /**
     * Get users by dd house
     */
    public function getUsers($house_id): JsonResponse
    {
        return Response::json([
            'users' => User::with('cm')
                ->whereHas('ddHouse', function ($query) use ($house_id){
                $query->where('dd_house_id', $house_id);})
                ->where('role', 'cm')
                ->where('status', 1)
                ->get(),
        ]);
    }
}
