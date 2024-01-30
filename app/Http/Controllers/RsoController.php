<?php

namespace App\Http\Controllers;

use App\Imports\RsoImport;
use App\Models\Rso;
use App\Models\User;
use App\Models\Route;
use App\Models\DdHouse;
use App\Models\Supervisor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RsoStoreRequest;
use App\Http\Requests\RsoUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rsos = Rso::with('user', 'supervisor', 'ddHouse')
            ->select(['id','name','rso_code','itop_number','pool_number','joining_date','status','dd_house_id','supervisor_id'])
            ->latest()
            ->get();
        $trashed = Rso::onlyTrashed()->latest()->get();
        return view('modules.rso.index', compact('rsos','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.rso.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RsoStoreRequest $request): RedirectResponse
    {
        $rso = $request->validated();

        // Rso Signature
        if ($request->hasFile('employee_signature')) {
            $name = 'rso.sign'.$request->employee_signature->hashname();
            Image::make($request->employee_signature)->resize(200,90)->save(public_path('assets/images/rso/documents/'.$name));
            $rso['employee_signature'] = $name;
        }

        // Rso Image
        if ($request->hasFile('rso_image')) {
            $name = 'rso.img'.$request->rso_image->hashname();
            Image::make($request->rso_image)->resize(300,380)->save(public_path('assets/images/rso/documents/'.$name));
            $rso['rso_image'] = $name;
        }

        // Nominee Image
        if ($request->hasFile('nominee_image')) {
            $name = 'nominee.img'.$request->nominee_image->hashname();
            Image::make($request->nominee_image)->resize(300,380)->save(public_path('assets/images/rso/documents/'.$name));
            $rso['nominee_image'] = $name;
        }

        // Nominee Signature
        if ($request->hasFile('nominee_signature')) {
            $name = 'nominee.sign'.$request->nominee_signature->hashname();
            Image::make($request->nominee_signature)->resize(200,90)->save(public_path('assets/images/rso/documents/'.$name));
            $rso['nominee_signature'] = $name;
        }

        // Witness Signature
        if ($request->hasFile('nominee_witness_signature')) {
            $name = 'witness.sign'.$request->nominee_witness_signature->hashname();
            Image::make($request->nominee_witness_signature)->resize(200,90)->save(public_path('assets/images/rso/documents/'.$name));
            $rso['nominee_witness_signature'] = $name;
        }

        $rso['serial_number']   = mt_rand(1000000,9999999);
        $rso['dbjsc']           = mt_rand(10000000,99999999);
        $rso['dbcsc']           = mt_rand(10000000,99999999);
        $rso['dbchc']           = mt_rand(10000000,99999999);
        $rso['mbcd']            = mt_rand(10000000,99999999);

        $id     = Rso::create($rso)->id;
        $newRso = Rso::findOrFail($id);
        $newRso->route()->attach($request->input('routes'));
//        toastr('Rso created successfully.','success','Success');
        return to_route('rso.index')->with('success','Rso created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rso $rso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rso $rso): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.rso.edit', compact('rso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RsoUpdateRequest $request, Rso $rso): RedirectResponse
    {
        $rso->update($request->validated());
        $rso->route()->sync($request->input('routes'));
//        toastr('Rso updated successfully.','success','Success');
        return to_route('rso.index')->with('success','Rso updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso): RedirectResponse
    {
        $rso->delete();
//        toastr('This rso has been temporarily deleted.','success','Success');
        return to_route('rso.index')->with('success','This rso has been temporarily deleted.');
    }

    /**
     * Trash rso.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashedRso = Rso::onlyTrashed()->latest()->paginate(10);
        return view('modules.rso.trash', compact('trashedRso'));
    }

    /**
     * Restore rso.
     */
    public function restore($id): RedirectResponse
    {
        Rso::withTrashed()->findOrFail($id)->restore();
//        toastr('Rso restored successfully.','success','Success');
        return to_route('rso.index')->with('success','Rso restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): RedirectResponse
    {
        // Find a rso to detach from the route.
        $rso = rso::with('route')->withTrashed()->findOrFail($id);

        // All routes associated with the rso are being detached.
        foreach ($rso->route as $route)
        {
            $rso->route()->detach($route->id);
        }

        // Find and permanently delete trashed rso.
        Rso::onlyTrashed()->findOrFail($id)->forceDelete();

        // Notification [permanently deleted rso.]
//        toastr('This rso has been permanently deleted.','success','Success');

        // Back to all users page.
        return to_route('rso.index')->with('success','This rso has been permanently deleted.');
    }

    /**
     * Import rso.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new RsoImport, $request->file('import_rso'));
//            toastr('Rso imported successfully.','success','Success');
            return to_route('rso.index')->with('success','Rso imported successfully.');
        } catch (ValidationException $e) {
//            toastr('Rso imported failed.','error','Error!');
            return to_route('rso.create')->with('import_errors', $e->failures())->with('error','Rso imported failed.');
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/Rso.xlsx'));
    }

    /**
     * Get users, supervisors, routes by dd house.
     */
    public function getUsersSupervisorsRoutes($houseId): JsonResponse
    {
        $userId = Rso::whereNotNull('user_id')->pluck('user_id');
//        $users  = User::where('role','rso')->whereNotIn('id', $userId)->orderBy('name','asc')->get();

        return Response::json([
            'supervisor' => Supervisor::with('user')->where('dd_house_id', $houseId)->where('status', 1)->get(),
            'user' => User::whereHas('ddHouse', function ($query) use ($houseId){
                $query->where('dd_house_id', $houseId);
            })->where('role', 'rso')->whereNotIn('id', $userId)->where('status', 1)->orderBy('name','asc')->get(),
            'route' => Route::where('dd_house_id', $houseId)->where('status', 1)->get(),
        ]);
    }
}
