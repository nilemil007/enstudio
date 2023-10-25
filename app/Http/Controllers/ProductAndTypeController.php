<?php

namespace App\Http\Controllers;

use App\Models\ProductAndType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ProductAndTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.product_and_type.index',[
            'productTypes' => ProductAndType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.product_and_type.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'product_type'  => ['required'],
            'product'       => ['required'],
        ],[
            'product_type.required' => 'আপনাকে অবশ্যই :attribute দিতে হবে।',
            'product.required'      => 'আপনাকে অবশ্যই একটি :attribute দিতে হবে।',
        ],[
            'product_type'  => 'প্রোডাক্ট টাইপ',
            'product'       => 'প্রোডাক্ট',
        ]);

        ProductAndType::create($data);

        return to_route('productType.create')->with('success','New entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAndType $productAndType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAndType $productAndType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAndType $productAndType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAndType $productAndType)
    {
        //
    }
}
