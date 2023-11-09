<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $house = DB::table('dd_house_user')->where('user_id', Auth::id())->pluck('dd_house_id');

        return view('modules.sales_stock.lifting.index', [
            'liftings' => Lifting::groupBy('dd_house_id')->whereDate('lifting_date', now())->whereIn('dd_house_id', $house)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $house = DB::table('dd_house_user')->where('user_id', Auth::id())->pluck('dd_house_id');

        return view('modules.sales_stock.lifting.create', [
            'liftingHouse'      => Lifting::groupBy('dd_house_id')->whereDate('lifting_date', now())->whereIn('dd_house_id', $house)->get(),
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
            'dd_house_id'           => ['required'],
            'product_type'          => ['required'],
            'product'               => ['nullable'],
            'qty'                   => ['nullable'],
            'price'                 => ['nullable'],
            'lifting_price'         => ['nullable'],
            'product_lifting_price' => ['nullable'],
            'itopup'                => ['nullable'],
            'bank_deposit'          => ['nullable'],
            'lifting_date'          => ['required'],
            'remarks'               => ['required'],
        ]);

        if ($lifting['product_type'] == 'itopup')
        {
            $lifting['product'] = 'itopup';
        }

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
    public function getItopAmount($total_amount, $ddId, $date): JsonResponse
    {
        $othersAmount = Lifting::where('product_type', '!=', 'itopup')
            ->whereDate('lifting_date', $date)
            ->where('dd_house_id', $ddId)
            ->sum('lifting_price');

        $remainingAmount = $total_amount - $othersAmount;
        $itopAmount = $remainingAmount / 0.9625;

        return Response::json(['itopup'  => round($itopAmount)]);
    }
}
