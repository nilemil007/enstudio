<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiftingStoreRequest;
use App\Http\Requests\LiftingUpdateRequest;
use App\Models\DdHouse;
use App\Models\Lifting;
use App\Models\ProductAndType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.lifting.index', [
            'liftings' => Lifting::latest()->paginate(5),
            'trashed' => Lifting::onlyTrashed()->latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $house = DB::table('dd_house_user')->where('user_id', Auth::id())->pluck('dd_house_id');

        return view('modules.sales_stock.lifting.create', [
            'houses'            => DdHouse::all(),
            'productAndType'    => ProductAndType::select('product_type')->groupBy('product_type')->orderBy('product_type','ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LiftingStoreRequest $request): RedirectResponse
    {
        Lifting::create($request->validated());

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
    public function edit(Lifting $lifting): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.lifting.edit', [
            'lifting' => $lifting,
            'houses' => DdHouse::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiftingUpdateRequest $request, Lifting $lifting): RedirectResponse
    {
        $lifting->update($request->validated());

        return to_route('lifting.index')->with('success','Lifting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting): JsonResponse
    {
        $lifting->delete();

        return Response::json(['success' => 'Lifting data moved to trash.']);
    }

    /**
     * Move to trash.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashed = Lifting::onlyTrashed()->latest()->paginate(5);
        return view('modules.sales_stock.lifting.trash', compact('trashed'));
    }

    /**
     * Restore.
     */
    public function restore($id): RedirectResponse
    {
        Lifting::withTrashed()->findOrFail($id)->restore();
        return to_route('lifting.index')->with('success','Lifting restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): JsonResponse
    {
        // Find and permanently delete trashed user.
        Lifting::onlyTrashed()->findOrFail($id)->forceDelete();

        // Back to all users page.
        return Response::json(['success' => 'This record has been permanently deleted.']);
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
    public function getProductByType($type = null): JsonResponse
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
            'productLiftingPrice'  => ProductAndType::firstWhere('product', $product)->lifting_price,
            'price'  => ProductAndType::firstWhere('product', $product)->price,
            ]);
    }

    /**
     * Get itop amount
     */
    public function getItopAmount($bank_deposit, $ddId, $date): JsonResponse
    {
        $othersAmount = Lifting::where('product_type', '!=', 'itopup')
            ->whereDate('lifting_date', $date)
            ->where('dd_house_id', $ddId)
            ->sum('lifting_price');

        $remainingAmount = $bank_deposit - $othersAmount;
        $itopAmount = $remainingAmount / 0.9625;

        return Response::json(['itopup'  => round($itopAmount)]);
    }

    /**
     * Lifting Calculation
     */
    public function calculation(): JsonResponse
    {
        $productData = ProductAndType::firstWhere('product', \request('product'));
        $liftingPrice = $productData->lifting_price;
        $price = $productData->price;
        $amount = \request('qty') * $price;
        $liftingAmount = \request('qty') * $liftingPrice;

        return Response::json([
            'liftingPrice' => $liftingPrice,
            'amount' => $amount,
            'liftingAmount' => $liftingAmount,
        ]);
    }
}
