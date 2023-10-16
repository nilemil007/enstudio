<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetailerStoreRequest;
use App\Http\Requests\RetailerUpdateRequest;
use App\Imports\RetailerImport;
use App\Models\Bts;
use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Route;
use App\Models\Rso;
use App\Models\Supervisor;
use App\Models\User;
use App\Services\RetailerUpdateService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $retailers = Retailer::paginate(10);
        return view('modules.retailer.index', compact('retailers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users          = User::where('role','retailer')->get();
        $rsos           = Rso::orderBy('itop_number','asc')->get();
        $supervisors    = Supervisor::all();
        $houses         = DdHouse::all();
        $routes         = Route::all();
        $btsCode        = Bts::all();
        return view('modules.retailer.create', compact('houses','users','rsos','supervisors','routes','btsCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RetailerStoreRequest $request): JsonResponse
    {
        try {
            $retailer = $request->validated();

            // Store retailer nid
            if ($request->hasFile('nid_upload')) {
                $name = 'retailer.nid'.$request->nid_upload->hashname();
                Image::make($request->image)->resize(324,204)->save(public_path('assets/images/nid/'.$name));
                $retailer['nid_upload'] = $name;
            }

            Retailer::create($retailer);

            return Response::json(['success' => 'Retailer created successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Retailer $retailer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Retailer $retailer): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users          = User::where('role','retailer')->get();
        $rsos           = Rso::orderBy('itop_number','asc')->get();
        $supervisors    = Supervisor::all();
        $houses         = DdHouse::all();
        $routes         = Route::all();
        $btsCode        = Bts::all();
        return view('modules.retailer.edit', compact('retailer','houses','users','rsos','supervisors','routes','btsCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RetailerUpdateRequest $request, Retailer $retailer): JsonResponse
    {
        return ( new RetailerUpdateService() )->update( $request, $retailer );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retailer $retailer): JsonResponse
    {
        try {
            $retailer->delete();
            return response()->json(['success' => 'The retailer has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Delete all retailer.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            Retailer::query()->delete();
            return response()->json(['success' => 'All retailer has been deleted successfully.']);
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    /**
     * Import retailer.
     */
    public function import(Request $request): JsonResponse|RedirectResponse
    {
        try {
            if (Rso::all()->count() < 1)
            {
                Alert::warning('Warning', 'No RS0 found. Create rso before import retailers.');
                return to_route('retailer.create');
            }

            Excel::import(new RetailerImport, $request->file('import_retailer'));

            return to_route('retailer.index')->with(['success' => 'Retailer imported successfully.']);

        } catch (ValidationException $e) {
            return to_route('retailer.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/Retailer_List_Report.xlsx'));
    }
}
