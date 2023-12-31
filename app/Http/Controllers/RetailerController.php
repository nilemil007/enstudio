<?php

namespace App\Http\Controllers;

use App\Exports\RetailersExport;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request->input('search');
        $ddHouseId = DB::table('dd_house_user')->where('user_id', Auth::id())->pluck('dd_house_id');

        $retailers = match (Auth::user()->role) {
            'rso' => Retailer::search($search)->latest()->where('rso_id', Rso::firstWhere('user_id', Auth::id())->id)->paginate(10),
            default => Retailer::search($search)->latest()->whereIn('dd_house_id', $ddHouseId)->paginate(10),
        };

        $retailers->appends(['search' => $search]);

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
     * Import retailer.
     */
    public function import(Request $request): JsonResponse|RedirectResponse
    {
        try {
            if (Rso::all()->count() < 1)
            {
                toastr('No RS0 found. Create rso before import retailers.','warning','Warning');
                return to_route('retailer.create');
            }

            Excel::import(new RetailerImport, $request->file('import_retailer'));

            return to_route('retailer.index')->with(['success' => 'Retailer imported successfully.']);

        } catch (ValidationException $e) {
            toastr('No RS0 imported.','error','Error');
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

    /**
     * retailers export.
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new RetailersExport(), 'Retailers.xlsx');
    }
}
