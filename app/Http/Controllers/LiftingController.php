<?php

namespace App\Http\Controllers;

use App\Models\DdHouse;
use App\Models\Lifting;
use App\Models\ProductAndType;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.lifting.create', [
            'houses'            => DdHouse::all(),
            'productAndType'    => ProductAndType::select('product_type')->groupBy('product_type')->orderBy('product_type','ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $lifting = $this->validate($request,[
            'dd_house_id'   => ['required'],
            'details'       => ['required'],
            'lifting_date'  => ['required'],
        ]);


        Lifting::create($lifting);

        return to_route('lifting.create')->with('success','Lifting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lifting $lifting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lifting $lifting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lifting $lifting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting)
    {
        //
    }

    /**
     * Move to trash.
     */
    public function trash()
    {
        //
    }

    /**
     * Restore.
     */
    public function restore($id)
    {
        //
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id)
    {
        //
    }

    /**
     * Permanently Delete All.
     */
    public function permanentlyDeleteAll()
    {
        //
    }

    /**
     * Get product's by type
     */
    public function getProductByType($type = null)
    {
        if ($type != 'itopup')
        {
            return Response::json(['products' => ProductAndType::where('product_type', $type)->orderBy('product','ASC')->get()]);
        }

//        return Response::json(['products' => ProductAndType::where('product_type', $type)->orderBy('product','ASC')->get()]);
    }

    /**
     * Get price by product
     */
    public function getPriceByProduct($product = null): JsonResponse
    {
        return Response::json([
            'liftingPrice'  => ProductAndType::firstWhere('product', $product)->lifting_price,
            'faceValue'     => preg_replace('/\D/', '', $product),
            ]);
    }

    /**
     * Get itop amount
     */
    public function getItopAmount($total_amount, $ddId, $date): JsonResponse
    {
        $othersAmount = Lifting::where('product_type', '!=', 'itopup')
            ->whereDate('lifting_date', $date)
            ->where('dd_house_id', $ddId)
            ->sum('price');

        $remainingAmount = $total_amount - $othersAmount;
        $itopAmount = $remainingAmount / 0.9625;

        return Response::json(['itopup'  => round($itopAmount)]);
    }
}
