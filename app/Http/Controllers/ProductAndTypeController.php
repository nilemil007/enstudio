<?php

namespace App\Http\Controllers;

use App\Models\ProductAndType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductAndTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.product_and_type.index',[
            'productTypes' => ProductAndType::latest()->get(),
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
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request,[
            'product_type'      => ['required'],
            'product'           => ['required'],
            'price'             => ['required'],
            'lifting_price'     => ['required'],
            'retailer_price'    => ['nullable'],
        ],[
            'product_type.required'     => 'আপনাকে অবশ্যই একটি :attribute দিতে হবে।',
            'product.required'          => 'আপনাকে অবশ্যই একটি :attribute দিতে হবে।',
            'price.required'            => 'আপনাকে অবশ্যই :attribute দিতে হবে।',
            'lifting_price.required'    => 'আপনাকে অবশ্যই :attribute দিতে হবে।',
        ],[
            'product_type'      => 'প্রোডাক্ট টাইপ',
            'product'           => 'প্রোডাক্ট',
            'price'             => 'প্রকৃত মূল্য',
            'lifting_price'     => 'লিফটিং মূল্য',
        ]);

        ProductAndType::create($data);

        return to_route('productType.create')->with('success','New entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAndType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAndType $productType): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.product_and_type.edit', compact('productType'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ProductAndType $productType): RedirectResponse
    {
        $data = $this->validate($request,[
            'product_type'      => ['required'],
            'product'           => ['required'],
            'price'             => ['required'],
            'lifting_price'     => ['required'],
            'retailer_price'    => ['nullable'],
        ],[
            'product_type.required'     => 'আপনাকে অবশ্যই একটি :attribute দিতে হবে।',
            'product.required'          => 'আপনাকে অবশ্যই একটি :attribute দিতে হবে।',
            'price.required'            => 'আপনাকে অবশ্যই :attribute দিতে হবে।',
            'lifting_price.required'    => 'আপনাকে অবশ্যই :attribute দিতে হবে।',
        ],[
            'product_type'      => 'প্রোডাক্ট টাইপ',
            'product'           => 'প্রোডাক্ট',
            'price'             => 'প্রকৃত মূল্য',
            'lifting_price'     => 'লিফটিং মূল্য',
        ]);

        $productType->update($data);

        return to_route('productType.index')->with('success','Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAndType $productType): JsonResponse
    {
        $productType->delete();
        return Response::json(['success' => 'Record deleted successfully.']);
    }
}
